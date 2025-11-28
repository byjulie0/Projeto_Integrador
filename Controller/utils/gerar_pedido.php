<?php
session_start();
include 'autenticado.php';

if ($usuario_nao_logado) {
    include '../overlays/pop_up_login.php';
    exit;
}

$sql = "SELECT c.id_carrinho, c.quantidade, p.id_produto, p.prod_nome, p.valor, p.quant_estoque
        FROM carrinho c
        JOIN produto p ON c.id_produto = p.id_produto
        WHERE c.id_cliente = ? AND p.produto_ativo = 1";

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

            // Atualiza estoque manualmente
            $sql = "UPDATE produto SET quant_estoque = quant_estoque - ? WHERE id_produto = ?";
            $query = $con->prepare($sql);
            $query->bind_param("ii", $item['quantidade'], $item['id_produto']);
            
            if (!$query->execute()) {
                throw new Exception("Erro ao atualizar estoque: " . $query->error);
            }
            $query->close();

            // Verifica se estoque zerou e remove de carrinhos/favoritos
            $sql = "SELECT quant_estoque FROM produto WHERE id_produto = ?";
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
            }
        }

        // Limpa carrinho do cliente
        $sql = "DELETE FROM carrinho WHERE id_cliente = ?";
        $query = $con->prepare($sql);
        $query->bind_param("i", $id_cliente);
        
        if (!$query->execute()) {
            throw new Exception("Erro ao limpar carrinho: " . $query->error);
        }
        $query->close();

        $con->commit();
        header("Location: ../cliente/carrinho.php?sucess=1");
        exit;

    } catch (Exception $e) {
        $con->rollback();
        error_log("ERRO PEDIDO: " . $e->getMessage());
        header("Location: ../cliente/carrinho.php?error=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    header("Location: ../cliente/carrinho.php?error=carrinho_vazio");
    exit;
}
?>