<?php
session_start();
include "../../model/DB/conexao.php";

if (!isset($_POST['id_pedido'])) {
    die("ID do pedido não enviado.");
}

$id_pedido = $_POST['id_pedido'];
$id_cliente = $_SESSION['id_cliente'];

$sql = "UPDATE pedido 
        SET status_pedido = 'Cancelado' 
        WHERE id_pedido = ? AND id_cliente = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $id_pedido, $id_cliente);
$stmt->execute();

header("Location: ../cliente/historico_pedidos.php");
exit;

?>