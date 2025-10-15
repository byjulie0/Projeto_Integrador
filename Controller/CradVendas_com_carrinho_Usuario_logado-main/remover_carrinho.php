<?php
include "db.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;}
$user_id = (int) $_SESSION['user_id']; // pega o ID do usuário logado


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $mysqli->query("DELETE FROM carrinho WHERE id=$id AND user_id='$user_id'");
}
header("Location: carrinho.php");
exit;
?>
