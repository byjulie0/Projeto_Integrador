<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'gerar_notificacao.php';
include 'autenticado.php';

if ($usuario_nao_logado) {
    include '../overlays/pop_up_login.php';
    exit;
}

$sql = "SELECT c.id_carrinho, c.quantidade, p.id_produto, p.prod_nome, p.valor, p.quant_estoque
        FROM carrinho c
        JOIN produto p ON c.id_produto = p.id_produto
        WHERE c.id_cliente = ?";

$query = $con->prepare($sql);
$query->bind_param("i", $id_cliente);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    try {
        $con->begin_transaction();

        $itens_data = [];
        while ($item = $result->fetch_assoc()) {
            $itens_data[] = $item;
        }

        // Cria pedido
        $sql = "INSERT INTO pedido (id_cliente, status_pedido) VALUES (?, 'Pendente')";
        $query = $con->prepare($sql);
        $query->bind_param("i", $id_cliente);
        
        if (!$query->execute()) {
            throw new Exception("Erro ao criar pedido: " . $query->error);
        }
        
        $id_pedido = $query->insert_id;
        $query->close();

        // Insere itens e atualiza estoque
        foreach ($itens_data as $item) {
            // Insere item no pedido
            $sql = "INSERT INTO item (id_pedido, id_produto, qtd_produto) VALUES (?, ?, ?)";
            $query = $con->prepare($sql);
            $query->bind_param("iii", $id_pedido, $item['id_produto'], $item['quantidade']);
            
            if (!$query->execute()) {
                throw new Exception("Erro ao adicionar item ao pedido: " . $query->error);
            }
            $query->close();

            // Atualiza estoque
            $sql = "UPDATE produto SET quant_estoque = quant_estoque - ? WHERE id_produto = ?";
            $query = $con->prepare($sql);
            $query->bind_param("ii", $item['quantidade'], $item['id_produto']);
            
            if (!$query->execute()) {
                throw new Exception("Erro ao atualizar estoque: " . $query->error);
            }
            $query->close();

            // Verifica se estoque zerou e remove de carrinhos/favoritos
            $sql = "SELECT quant_estoque, sexo, id_categoria FROM produto WHERE id_produto = ?";
            $query = $con->prepare($sql);
            $query->bind_param("i", $item['id_produto']);
            $query->execute();
            $stock_result = $query->get_result();
            $stock_data = $stock_result->fetch_assoc();
            $query->close();

            if ($stock_data['quant_estoque'] <= 0) {
                // Remove de todos os carrinhos
                $sql = "DELETE FROM carrinho WHERE id_produto = ?";
                $query = $con->prepare($sql);
                $query->bind_param("i", $item['id_produto']);
                $query->execute();
                $query->close();

                // Remove de favoritos
                $sql = "DELETE FROM favorito WHERE id_produto = ?";
                $query = $con->prepare($sql);
                $query->bind_param("i", $item['id_produto']);
                $query->execute();
                $query->close();

                // Inativa produto
                $sql = "UPDATE produto SET produto_ativo = 0 WHERE id_produto = ?";
                $query = $con->prepare($sql);
                $query->bind_param("i", $item['id_produto']);
                $query->execute();
                $query->close();

                // Notificação adm inativo
                $produto_id = $item['id_produto'];
                $nome_produto = $item['prod_nome'];
                $mensagem = "O estoque do produto: {$nome_produto} ,chegou a zero e foi desativado!";
                $categoria = "Estoque";

                $notificacao_adm_sucesso = Criar_notificacao_adm($con, $produto_id, $mensagem, $categoria);
        
                if ($notificacao_adm_sucesso) {
                    error_log("Notificação para o ADM criada com sucesso!");
                } else {
                    error_log("Falha ao criar notificação para o ADM");
                }
            } 
            elseif($stock_data['quant_estoque'] > 0 && $stock_data['quant_estoque'] <= 5 && ($stock_data['id_categoria'] == 4 || $stock_data['sexo'] == null)){

                $produto_id = $item['id_produto'];
                $nome_produto = $item['prod_nome'];
                $mensagem = "O estoque do produto: {$nome_produto} ,possui {$stock_data['quant_estoque']} unidades restantes, reposição necessaria!";
                $categoria = "Estoque";
                $notificacao_adm_sucesso = Criar_notificacao_adm($con, $produto_id, $mensagem, $categoria);
        
                if ($notificacao_adm_sucesso) {
                    error_log("Notificação para o ADM criada com sucesso!");
                } else {
                    error_log("Falha ao criar notificação para o ADM");
                }
            }
        }

        $sql = "DELETE FROM carrinho WHERE id_cliente = ?";
        $query = $con->prepare($sql);
        $query->bind_param("i", $id_cliente);
        
        if (!$query->execute()) {
            throw new Exception("Erro ao limpar carrinho: " . $query->error);
        }
        $query->close();
        
        $con->commit();

        // Salva mensagem de sucesso na sessão
        $_SESSION['titulo'] = 'Seu pedido na JohnRooster foi criado!';
        $_SESSION['popup_message'] = 'Clique no botão do WhatsApp e converse com um atendente mais detalhes. Você pode consultar a situação do seu pedido na página de histórico. Código do pedido: #' . $id_pedido ;

        // MANTER o parâmetro sucess para identificar que é um pop-up de sucesso
        header("Location: ../cliente/carrinho.php?error&sucess&t=" . time());
        exit;

    } catch (Exception $e) {
        $con->rollback();
        
        // Salva mensagem de erro na sessão
        $_SESSION['titulo'] = 'Não foi possivel gerar pedido!';
        $_SESSION['popup_message'] = 'Erro ao criar pedido: ' . $e->getMessage();
        
        header("Location: ../cliente/carrinho.php?error&t=" . time());
        exit;
    }
} else {
    // Carrinho vazio
    $_SESSION['titulo'] = 'Seu carrinho está vazio!';
    $_SESSION['popup_message'] = 'Adicione produtos antes de finalizar o pedido.';
    
    header("Location: ../cliente/carrinho.php?error&t=" . time());
    exit;
}
?>