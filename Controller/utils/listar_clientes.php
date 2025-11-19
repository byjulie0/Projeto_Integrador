<?php
include '../../model/DB/conexao.php';
$status = isset($_GET['status']) ? $_GET['status'] : 'todos';

$where = [];

if ($status === 'ativos') {
    $where[] = "user_ativo = 1";
} elseif ($status === 'inativos') {
    $where[] = "user_ativo = 0";
}

$sql = "SELECT id_cliente, cliente_nome, cpf_cnpj, data_nasc, user_ativo FROM cliente";

if (count($where) > 0) {
    $sql .= " WHERE " . implode(' AND ', $where);
}

$result = $con->query($sql);

$cliente = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cliente[] = $row;
    }
}
?>
