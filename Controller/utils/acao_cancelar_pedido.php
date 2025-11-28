<?php
include '../../model/DB/conexao.php';

$id_pedido = isset($_GET['id_pedido']) ? intval($_GET['id_pedido']) : 0;

if ($id_pedido === 0) {
    echo "<script>alert('ID do pedido inválido!');  window.history.back();</script>";
    exit;
}

try {
    $con->begin_transaction();

    // Devolve estoque dos produtos relacionados a esse pedido
    $sql = "SELECT id_produto, qtd_produto FROM item WHERE id_pedido = ?";
    $query = $con->prepare($sql);
    $query->bind_param("i", $id_pedido);
    $query->execute();
    $result = $query->get_result();

    while ($row = $result->fetch_assoc()) {
        // Devolve o estoque
        $sql = "UPDATE produto SET quant_estoque = quant_estoque + ? WHERE id_produto = ?";
        $query = $con->prepare($sql);
        $query->bind_param("ii", $row['qtd_produto'], $row['id_produto']);
        $query->execute();
        // Reativa o produto se o estoque ficou positivo
        $sql = "UPDATE produto SET produto_ativo = 1 WHERE id_produto = ? AND quant_estoque > 0";
        $query = $con->prepare($sql);
        $query->bind_param("i", $row['id_produto']);
        $query->execute();
    }

    // Atualiza o status do pedido - A TRIGGER vai criar a notificação
    $sql = "UPDATE pedido SET status_pedido = 'Cancelado' WHERE id_pedido = ?";
    $query = $con->prepare($sql);
    $query->bind_param("i", $id_pedido);
    $query->execute();

    $con->commit();
    // notifica adm:
    echo "<script>alert('Pedido cancelado com sucesso!'); window.location.href='../adm/verificar_administrar_pedido.php';</script>";
} catch (Exception $e) {
    $con->rollback();
    echo "<script>alert('Erro ao cancelar pedido: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
}
?>