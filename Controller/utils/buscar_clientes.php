<?php
include '../../model/DB/conexao.php';

$busca = isset($_POST['busca']) ? $con->real_escape_string($_POST['busca']) : '';
$inativos = isset($_POST['inativos']) ? (int)$_POST['inativos'] : 0;

$sql = "SELECT id_cliente, cliente_nome, cpf_cnpj, data_nasc, user_ativo FROM cliente";

$where = [];

if ($inativos === 0) {
    $where[] = "user_ativo = 1";
}


if (!empty($busca)) {
    $busca_esc = $con->real_escape_string($busca);
    $where[] = "(cliente_nome LIKE '%$busca_esc%' OR cpf_cnpj LIKE '%$busca_esc%')";
}

if (count($where) > 0) {
    $sql .= " WHERE " . implode(' AND ', $where);
}

$result = $con->query($sql);

$clientes = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($clientes);
?>
