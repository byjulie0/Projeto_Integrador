<?php
$status = $_GET['status'] ?? null;

if ($status === 'inativos') {
    $filtroStatus = "p.produto_ativo = 0";
} elseif ($status === 'ativos') {
    $filtroStatus = "p.produto_ativo = 1";
} elseif ($status == 'todos') {
    $filtroStatus = "";
} else {
    $filtroStatus = "p.produto_ativo = 1";
}
