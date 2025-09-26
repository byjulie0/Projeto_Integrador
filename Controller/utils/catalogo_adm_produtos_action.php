<?php
require_once(__DIR__ . "/../../model/DB/conexao.php");
$status = $_GET['status'] ?? 'ativos';


if ($status === 'inativados') {
    $query = "SELECT * FROM produto WHERE produto_ativo = 0";
} else {
    $query = "SELECT * FROM produto WHERE produto_ativo = 1";
}

$result = mysqli_query($con, $query);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($con));
}

$produtos = [];

while ($row = mysqli_fetch_assoc($result)) {
    $produtos[] = $row;
}


?>