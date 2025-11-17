<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'sessao_ativa.php';

$usuario_nao_logado = !isset($_SESSION['id_cliente']);
$id_cliente = isset($_SESSION["id_cliente"]) ? $_SESSION["id_cliente"] : null;
?>