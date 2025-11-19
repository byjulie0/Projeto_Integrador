<?php
session_start();
include 'gerar_notificacao.php';
include 'autenticado.php';

$sql = "SELECT c.id_carrinho, c.quantidade, p.id_produto, p.prod_nome, p.path_img, p.descricao, p.valor
        FROM carrinho c
        JOIN produto p ON c.id_produto = p.id_produto
        WHERE c.id_cliente='$id_cliente' AND p.produto_ativo = 1 AND p.quant_estoque != 0";

$result = $con->query($sql);

if ($result && $result->num_rows > 0) {
    try {
        // Inicia transação
        $con->begin_transaction();

        // Cria o pedido
        $sql = "INSERT INTO pedido (id_cliente) VALUES (?)";
        $query = $con->prepare($sql);
        $query->bind_param("i", $id_cliente);
        $query->execute();

        $id_pedido = $query->insert_id;
        $query->close();

        // Adiciona os itens ao pedido
        while ($itens = $result->fetch_assoc()) {
            $qtd_produto = $itens['quantidade'];
            $id_prod = $itens['id_produto'];
            
            $sql_itens = "INSERT INTO item (id_pedido, id_produto, qtd_produto) VALUES (?, ?, ?)";
            $query_item = $con->prepare($sql_itens);
            $query_item->bind_param("iii", $id_pedido, $id_prod, $qtd_produto);
            $query_item->execute();
            $query_item->close();
        }
        

        // Commit da transação
        $con->commit();

        // Salva o ID do pedido para limpar carrinho depois do redirecionamento
        $_SESSION['pedido_criado_id'] = $id_pedido;
        
        // Salva mensagem de sucesso na sessão
        $_SESSION['popup_type'] = 'sucesso';
        $_SESSION['popup_message'] = 'Pedido criado com sucesso! Número do pedido: #' . $id_pedido;


        // criar notificação inicio

            $usuario_id= $id_cliente;
            $produto_id= $id_pedido;
            $mensagem="Pedido criado com sucesso! Número do pedido: #{$id_pedido}";
            $categoria="Pedidos";

            if (Criar_notificacao($con, $usuario_id, $produto_id, $mensagem, $categoria)) {
                echo "Notificação enviada com sucesso!";
            }
            else {
                echo "Erro ao enviar notificação.";
            }
            
        // criar  notificação fim



        
        // Redireciona de volta para o carrinho para mostrar o pop-up
        header("Location: ../cliente/carrinho.php?pedido_sucesso=1");
        exit;

    } catch (Exception $e) {
        // Rollback em caso de erro
        $con->rollback();
        
        // Salva mensagem de erro na sessão
        $_SESSION['popup_type'] = 'erro';
        $_SESSION['popup_message'] = 'Erro ao criar pedido: ' . $e->getMessage();
        
        header("Location: ../cliente/carrinho.php");
        exit;
    }
} else {
    // Carrinho vazio
    $_SESSION['popup_type'] = 'erro';
    $_SESSION['popup_message'] = 'Seu carrinho está vazio! Adicione produtos antes de finalizar o pedido.';
    
    header("Location: ../cliente/carrinho.php");
    exit;
}
?>