<?php
include 'sessao_ativa_adm.php';
$adm_nao_logado = !isset($_SESSION['id_adm']);
$id_adm = isset($_SESSION["id_adm"]) ? $_SESSION["id_adm"] : null;
?>