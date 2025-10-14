<?php
require_once(__DIR__ . "/../../model/DB/conexao.php");

if (isset($_POST['toggle_produto'])) {
    $id = intval($_POST['id_produto']);
    $statusAtual = intval($_POST['status_atual']);
    $novoStatus = $statusAtual ? 0 : 1;

    mysqli_query($con, "UPDATE produto SET produto_ativo = $novoStatus WHERE id_produto = $id");

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>

