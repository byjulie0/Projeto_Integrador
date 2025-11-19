<?php
include "autenticado.php";
include "../../model/DB/conexao.php";

if (!isset($_GET['id'])) {
    header("Location: ../cliente/historico_pedidos.php");
    exit;
}

$id_pedido = intval($_GET['id']);

$sqlItens = "SELECT id_produto, qtd_produto 
             FROM item 
             WHERE id_pedido = $id_pedido";
$resultItens = $con->query($sqlItens);

while ($item = $resultItens->fetch_assoc()) {
    $id_produto = $item['id_produto'];
    $quantidade = $item['qtd_produto'];

    $sqlUpdateEstoque = "UPDATE produto 
                         SET quant_estoque = quant_estoque + $quantidade
                         WHERE id_produto = $id_produto";
    $con->query($sqlUpdateEstoque);
}

$sqlCancel = "UPDATE pedido 
              SET status_pedido = 'Cancelado'
              WHERE id_pedido = $id_pedido";
$con->query($sqlCancel);

header("Location: ../cliente/historico_pedidos.php?cancelado=1");
exit;

?>