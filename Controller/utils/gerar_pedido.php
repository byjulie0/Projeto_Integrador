<?php
session_start();
include 'autenticado.php';
include 'gerar_notificacao.php';

if ($usuario_nao_logado) {
    include '../overlays/pop_up_login.php';
    exit;
}

$sql = "SELECT c.id_carrinho, c.quantidade, p.id_produto, p.prod_nome, p.valor, p.quant_estoque
        FROM carrinho c
        JOIN produto p ON c.id_produto = p.id_produto
        WHERE c.id_cliente = ? AND p.produto_ativo = 1";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    try {
        $con->begin_transaction();
        error_log("Transação iniciada");

        $estoque_suficiente = true;
        $produtos_sem_estoque = [];
        $itens_data = [];
        
        while ($item = $result->fetch_assoc()) {
            $itens_data[] = $item;
            if ($item['quantidade'] > $item['quant_estoque']) {
                $estoque_suficiente = false;
                $produtos_sem_estoque[] = $item['prod_nome'];
            }
        }
        
        if (!$estoque_suficiente) {
            throw new Exception("Estoque insuficiente para: " . implode(", ", $produtos_sem_estoque));
        }

        // Cria o pedido
        $sql_pedido = "INSERT INTO pedido (id_cliente, status_pedido) VALUES (?, 'Pendente')";
        $stmt_pedido = $con->prepare($sql_pedido);
        $stmt_pedido->bind_param("i", $id_cliente);
        
        if (!$stmt_pedido->execute()) {
            throw new Exception("Erro ao criar pedido: " . $stmt_pedido->error);
        }
        
        $id_pedido = $stmt_pedido->insert_id;
        $stmt_pedido->close();
        
        error_log("Pedido criado com ID: " . $id_pedido);

        // Adiciona os itens ao pedido e atualiza estoque
        foreach ($itens_data as $item) {
            // Insere item no pedido
            $sql_item = "INSERT INTO item (id_pedido, id_produto, qtd_produto) VALUES (?, ?, ?)";
            $stmt_item = $con->prepare($sql_item);
            $stmt_item->bind_param("iii", $id_pedido, $item['id_produto'], $item['quantidade']);
            
            if (!$stmt_item->execute()) {
                throw new Exception("Erro ao adicionar item ao pedido: " . $stmt_item->error);
            }
            $stmt_item->close();

            // Atualiza estoque
            $sql_estoque = "UPDATE produto SET quant_estoque = quant_estoque - ? WHERE id_produto = ?";
            $stmt_estoque = $con->prepare($sql_estoque);
            $stmt_estoque->bind_param("ii", $item['quantidade'], $item['id_produto']);

            
            if (!$stmt_estoque->execute()) {
                throw new Exception("Erro ao atualizar estoque: " . $stmt_estoque->error);
            }

            $id_verif_prod = $item['id_produto'];
            $sql_verif_estoq = "SELECT quant_estoque,sexo FROM produto WHERE id_produto = $id_verif_prod";
            $qtd_estoque= $con->query($sql_verif_estoq);

            // notificação adm baixo estoque inicio
            if($qtd_estoque['quant_estoque'] > 0 && $qtd_estoque['quant_estoque'] <= 5 && $qtd_estoque['sexo'] == "Não se aplica" || $qtd_estoque['sexo'] == null){

                $produto_id= $id_verif_prod;
                $nome_produto = $item['prod_nome'];
                $mensagem="O estoque do produto: {$nome_produto} ,possui {$item['quant_estoque']} unidades restantes, reposição necessaria!";
                $categoria="Estoque";
                $notificacao_adm_sucesso = Criar_notificacao_adm($con, $produto_id, $mensagem, $categoria);
        
                if ($notificacao_adm_sucesso) {
                    error_log("Notificação para o ADM criada com sucesso!");
                } else {
                    error_log("Falha ao criar notificação para o ADM");
                }

            }
            // notificação adm baixo estoque fim
            elseif ($qtd_estoque['quant_estoque'] == 0){

                $sql_inativo = "UPDATE produto SET produto_ativo = 0 WHERE id_produto = ?";
                $query_inativo = $con->prepare($sql_inativo);
                $query_inativo->bind_param("i",$id_prod);

                //notificação adm inativo inicio

                $produto_id= $id_verif_prod;
                $nome_produto = $item['prod_nome'];
                $mensagem="O estoque do produto: {$nome_produto} ,chegou a zero e foi desativado!";
                $categoria="Estoque";

                $notificacao_adm_sucesso = Criar_notificacao_adm($con, $produto_id, $mensagem, $categoria);
        
                if ($notificacao_adm_sucesso) {
                    error_log("Notificação para o ADM criada com sucesso!");
                } else {
                    error_log("Falha ao criar notificação para o ADM");
                }

                //notificação adm inativo fim

                if (!$query_inativo->execute()) {
                    throw new Exception("Erro ao inativar produto: " . $query_inativo->error);}


            $stmt_estoque->close();}
        }

        // Limpa carrinho
        $sql_limpar_carrinho = "DELETE FROM carrinho WHERE id_cliente = ?";
        $stmt_limpar = $con->prepare($sql_limpar_carrinho);
        $stmt_limpar->bind_param("i", $id_cliente);
        
        if (!$stmt_limpar->execute()) {
            throw new Exception("Erro ao limpar carrinho: " . $stmt_limpar->error);
        }
        $stmt_limpar->close();

        // COMMIT - tudo deu certo
        $con->commit();
        error_log("Transação commitada com sucesso");

        // AGORA cria a notificação (fora da transação)
        $mensagem = "Pedido criado com sucesso! Número do pedido: #{$id_pedido}";
        $categoria = "Pedidos";
        
        error_log("Tentando criar notificação...");
        $notificacao_sucesso = Criar_notificacao($con, $id_cliente, $id_pedido, $mensagem, $categoria);
        
        if ($notificacao_sucesso) {
            error_log("Notificação criada com sucesso!");
        } else {
            error_log("Falha ao criar notificação, mas o pedido foi criado.");
        }

        // Também cria notificação para ADM
        // $mensagem_adm = "Novo pedido recebido! Número: #{$id_pedido}";
        // // Supondo que o ADM principal tenha ID 1 - ajuste conforme sua lógica
        // $adm_id = 1;
        // Criar_notificacao_adm($con, $adm_id, $id_pedido, $mensagem_adm, "Novos Pedidos");

        // Salva mensagem de sucesso
        $_SESSION['popup_type'] = 'sucesso';
        $_SESSION['popup_message'] = $mensagem;
        
        error_log("Redirecionando para carrinho com mensagem de sucesso");
        header("Location: ../cliente/carrinho.php");
        exit;

    } catch (Exception $e) {
        // Rollback em caso de erro
        $con->rollback();

        $_SESSION['popup_message'] = 'Erro ao criar pedido: ' . $e->getMessage();
        header("Location: ../cliente/carrinho.php");
        exit;
    }
} else {
    // Carrinho vazio
    error_log("Carrinho vazio - redirecionando com erro");
    $_SESSION['popup_type'] = 'erro';
    $_SESSION['popup_message'] = 'Seu carrinho está vazio!';
    
    header("Location: ../cliente/carrinho.php");
    exit;
}

// Fecha conexões
if (isset($stmt)) $stmt->close();
$con->close();
?>