<?php
include '../../model/DB/conexao.php';

$busca = isset($_POST['busca']) ? $con->real_escape_string($_POST['busca']) : '';

$sql = "SELECT id_cliente, cliente_nome, cpf_cnpj, data_nasc, user_ativo FROM cliente";

if (!empty($busca)) {
    $sql .= " WHERE cliente_nome LIKE '%$busca%' OR cpf_cnpj LIKE '%$busca%'";
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
