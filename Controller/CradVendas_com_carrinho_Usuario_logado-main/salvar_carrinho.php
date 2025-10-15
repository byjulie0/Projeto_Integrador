<?php
include "db.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


$user_id = $_SESSION['user_id']; //pega o ID do usuário logado

if (isset($_GET['id'])) {
    $produto_id = intval($_GET['id']);

    $check = $mysqli->query("SELECT * FROM carrinho WHERE user_id='$user_id' AND produto_id='$produto_id'");
    if ($check->num_rows > 0) {
        $mysqli->query("UPDATE carrinho SET quantidade = quantidade + 1 WHERE user_id='$user_id' AND produto_id='$produto_id'");
    } else {
        $mysqli->query("INSERT INTO carrinho (user_id, produto_id, quantidade) VALUES ('$user_id', '$produto_id', 1)");
    }
}
header("Location: carrinho.php");
exit;
?>
