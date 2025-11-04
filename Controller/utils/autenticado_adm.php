<?php
include 'sessao_ativa_adm.php';
if (!isset($_SESSION['id_adm']) || $_SESSION['funcao'] !== 'ADM') {
    header("Location: ../adm/login.php?error=Acesso_negado");
    exit;
}
$id_adm = $_SESSION["id_adm"];
?>