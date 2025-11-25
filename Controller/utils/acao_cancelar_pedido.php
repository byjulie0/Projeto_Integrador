<?php
include '../../model/DB/conexao.php';
include 'gerar_notificacao.php';

$id_pedido = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_pedido === 0) {
    echo "<script>alert('ID do pedido inválido!'); window.location.href='../adm/verificar_administrar_pedido.php';</script>";
    exit;
}

try {
    $con->begin_transaction();

    // Atualiza status - A TRIGGER cuida do estoque automaticamente
    $sql = "UPDATE pedido SET status_pedido = 'Cancelado' WHERE id_pedido = ?";
    $query = $con->prepare($sql);
    $query->bind_param("i", $id_pedido);
    $query->execute();

    $con->commit();
    echo "<script>alert('Pedido cancelado com sucesso!'); window.location.href='../adm/verificar_administrar_pedido.php';</script>";
} catch (Exception $e) {
    $con->rollback();
    echo "<script>alert('Erro ao cancelar pedido: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
}
?>