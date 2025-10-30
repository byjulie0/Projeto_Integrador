<?php
include '../../model/DB/conexao.php';

$pedido_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($pedido_id === 0) {
    echo "<script>alert('ID do pedido inválido!'); window.location.href='verificar_administrar_pedido.php';</script>";
    exit;
}

try {
    $sql = "UPDATE pedido SET status_pedido = 'Concluído' WHERE id_pedido = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $pedido_id);
    $stmt->execute();

    echo "<script>alert('Pedido concluído com sucesso!'); window.location.href='verificar_administrar_pedido.php';</script>";
} catch (Exception $e) {
    echo "<script>alert('Erro ao concluir pedido: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
}
?>