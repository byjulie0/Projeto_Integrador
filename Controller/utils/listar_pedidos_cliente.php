<?php
include "../../model/DB/conexao.php";

$sql = "SELECT pedido.data_pedido, 
        pedido.id_pedido, 
        item.qtd_produto, 
        produto.valor, 
        pedido.status_pedido 
        FROM pedido 
        inner join item on item.pedido_id_pedido = pedido.id_pedido 
        inner join produto on item.produto_id_produto = produto.id_produto
        ORDER BY data_pedido DESC;";

$resultado = $con->query($sql);

$pedidos = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $pedidos[] = $row;
    }
}
?>