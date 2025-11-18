<?php
session_start();
include "../../model/DB/conexao.php";

if (!isset($_GET['id'])) {
    header("Location: pedidos_cliente.php");
    exit;
}

$id_pedido = intval($_GET['id']);

// 1. Buscar todos os itens do pedido
$sqlItens = "SELECT produto_id_produto, qtd_produto 
             FROM item 
             WHERE pedido_id_pedido = $id_pedido";
$resultItens = $con->query($sqlItens);

// 2. Para cada item → devolver estoque
while ($item = $resultItens->fetch_assoc()) {
    $id_produto = $item['produto_id_produto'];
    $quantidade = $item['qtd_produto'];

    $sqlUpdateEstoque = "UPDATE produto 
                         SET quant_estoque = quant_estoque + $quantidade
                         WHERE id_produto = $id_produto";
    $con->query($sqlUpdateEstoque);
}

// 3. Atualizar status do pedido para Cancelado
$sqlCancel = "UPDATE pedido 
              SET status_pedido = 'Cancelado'
              WHERE id_pedido = $id_pedido";
$con->query($sqlCancel);

// 4. Redirecionar de volta para a lista
header("Location: pedidos_cliente.php?cancelado=1");
exit;

?>