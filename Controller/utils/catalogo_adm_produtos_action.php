<?php
require_once(__DIR__ . "/../../model/DB/conexao.php");

$status = $_GET['status'] ?? 'ativos';

if ($status === 'inativados') {
    $filtroStatus = "p.produto_ativo = 0";
} else {
    $filtroStatus = "p.produto_ativo = 1";
}



?>