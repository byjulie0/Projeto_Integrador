<?php
$sql = "SELECT
        id_pedido,
        data_pedido,
        status,
        qtd
        FROM pedido
        ORDER BY data_pedido DESC";

$resultado = $con->query($sql);

$pedidos = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $pedidos[] = $row;
    }
}
?>