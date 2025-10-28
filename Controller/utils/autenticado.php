<?php
include 'sessao_ativa.php';

if (!isset(($_SESSION['id_cliente']))){
    header("Location: ../cliente/login.php?error=nao_fez_login");
    exit;
}
$id_cliente = $_SESSION["id_cliente"];
?>