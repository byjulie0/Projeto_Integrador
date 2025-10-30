<?php
include '../../model/DB/conexao.php';

$pedido_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($pedido_id === 0) {
    echo "<script>alert('ID do pedido inválido!'); window.location.href='verificar_administrar_pedido.php';</script>";
    exit;
}

try {
    // Inicia transação
    $con->begin_transaction();

    // Atualiza o status do pedido
    $sql_update = "UPDATE pedido SET status_pedido = 'Cancelado' WHERE id_pedido = ?";
    $stmt = $con->prepare($sql_update);
    $stmt->bind_param("i", $pedido_id);
    $stmt->execute();

    // Devolve estoque dos produtos relacionados a esse pedido
    $sql_itens = "SELECT id_produto, qtd_produto FROM item WHERE id_pedido = ?";
    $stmt2 = $con->prepare($sql_itens);
    $stmt2->bind_param("i", $pedido_id);
    $stmt2->execute();
    $result = $stmt2->get_result();

    while ($row = $result->fetch_assoc()) {
        $updateEstoque = "UPDATE produto SET quant_estoque = quant_estoque + ? WHERE id_produto = ?";
        $stmt3 = $con->prepare($updateEstoque);
        $stmt3->bind_param("ii", $row['qtd_produto'], $row['id_produto']);
        $stmt3->execute();
    }

    $con->commit();
    echo "<script>alert('Pedido cancelado com sucesso!'); window.location.href='verificar_administrar_pedido.php';</script>";
} catch (Exception $e) {
    $con->rollback();
    echo "<script>alert('Erro ao cancelar pedido: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
}
?>