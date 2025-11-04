<?php
include 'autenticado.php';

$sql = "SELECT c.id_carrinho, c.quantidade, p.id_produto, p.prod_nome, p.path_img, p.descricao, p.valor
        FROM carrinho c
        JOIN produto p ON c.id_produto = p.id_produto
        WHERE c.id_cliente='$id_cliente' AND p.produto_ativo = 1";

$result = $con->query($sql);


if ($result && $result->num_rows > 0) {

    $sql = "INSERT INTO pedido (id_cliente) VALUES (?)";
    $query = $con->prepare($sql);
    $query->bind_param("i", $id_cliente);
    $query->execute();

    $id_pedido = $query->insert_id;
    $query->close();

    while ($itens = $result->fetch_assoc()){

        $qtd_produto = $itens['quantidade'];
        $id_prod = $itens['id_produto'];
        $sql_itens = "INSERT INTO item (id_pedido, id_produto, qtd_produto) VALUES (?, ?, $qtd_produto)";
        $query_item = $con->prepare($sql_itens);
        $query_item->bind_param("ii", $id_pedido, $id_prod);
        $query_item->execute();
        $query_item->close();
    }
    header("Location: ../cliente/pg_inicial_cliente.php?sucesso=pedido_criado");
    exit;
}