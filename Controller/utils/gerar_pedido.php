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

$query = $con->prepare($sql);
$query->bind_param("i", $id_cliente);
$query->execute();
$result = $query->get_result();

if ($result && $result->num_rows > 0) {
    try {
        $con->begin_transaction();

        // Verifica estoque antes de criar pedido
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

        // Cria pedido
        $sql = "INSERT INTO pedido (id_cliente, status_pedido) VALUES (?, 'Pendente')";
        $query = $con->prepare($sql);
        $query->bind_param("i", $id_cliente);
        
        if (!$query->execute()) {
            throw new Exception("Erro ao criar pedido: " . $query->error);
        }
        
        $id_pedido = $query->insert_id;
        $query->close();

        // Insere itens - A TRIGGER cuida do estoque automaticamente
        foreach ($itens_data as $item) {
            $sql = "INSERT INTO item (id_pedido, id_produto, qtd_produto) VALUES (?, ?, ?)";
            $query = $con->prepare($sql);
            $query->bind_param("iii", $id_pedido, $item['id_produto'], $item['quantidade']);
            
            if (!$query->execute()) {
                throw new Exception("Erro ao adicionar item ao pedido: " . $query->error);
            }
            $query->close();
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
        header("Location: ../cliente/carrinho.php");
        exit;

    } catch (Exception $e) {
        $con->rollback();
        header("Location: ../cliente/carrinho.php");
        exit;
    }
} else {
    header("Location: ../cliente/carrinho.php");
    exit;
}

// Fecha conexões
if (isset($query)) $query->close();
$con->close();
?>