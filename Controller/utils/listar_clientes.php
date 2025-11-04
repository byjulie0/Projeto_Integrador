<?php
include '../utils/autenticado_adm.php';

$sql = "SELECT id_cliente, cliente_nome, cpf_cnpj, data_nasc, user_ativo FROM cliente";
$result = $con->query($sql);

$cliente = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cliente[] = $row;
    }
}
?>
