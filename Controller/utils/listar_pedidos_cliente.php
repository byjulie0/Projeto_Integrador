<?php
include "../../model/DB/conexao.php";
session_start();

$id_cliente = $_SESSION['id_cliente'];

$sql = "SELECT 
        pedido.id_pedido,
        pedido.data_pedido,
        pedido.status_pedido,
        SUM(item.qtd_produto * produto.valor) AS valor_total,
        SUM(item.qtd_produto) AS total_itens
        FROM pedido
        INNER JOIN item ON item.id_pedido = pedido.id_pedido
        INNER JOIN produto ON item.id_produto = produto.id_produto
        GROUP BY pedido.id_pedido
        WHERE pedido.cliente_id_cliente = ?
        ORDER BY pedido.data_pedido DESC;";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$resultado = $stmt->get_result();

$pedidos = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $pedidos[] = $row;
    }
}
?>