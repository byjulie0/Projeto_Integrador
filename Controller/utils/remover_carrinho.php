<?php
include 'sessao_ativa.php';

if (isset($_GET['id_carrinho'])) {
    $id_carrinho = intval($_GET['id_carrinho']);
    $mysqli->query("DELETE FROM carrinho WHERE id_carrinho = $id_carrinho AND id_cliente ='$id_cliente'");
}
else{
    echo 'Não foi possivel deletar item.';
}
header("Location: carrinho.php");
exit;
?>
