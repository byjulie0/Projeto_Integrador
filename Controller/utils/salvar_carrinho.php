<?php
include 'sessao_ativa.php';

if (isset($_GET['id_produto'])) {
    $id_produto = intval($_GET['id_produto']);

    $check = $mysqli->query("SELECT * FROM carrinho WHERE id_cliente = '$id_cliente' AND id_produto = '$id_produto'");
    if ($check->num_rows > 0) {
        $mysqli->query("UPDATE carrinho SET quantidade = quantidade + 1 WHERE id_cliente = '$id_cliente' AND id_produto ='$id_produto'");
    } else {
        $mysqli->query("INSERT INTO carrinho (id_cliente, id_produto, quantidade) VALUES ('$id_cliente', '$id_produto', 1)");
    }
}
header("Location: carrinho.php");
exit;
?>
