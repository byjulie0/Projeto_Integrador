<?php
include '../utils/autenticado.php';
if ($usuario_nao_logado) {
    include '../overlays/pop_up_login.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_produto = $_GET['id_produto'] ?? null;
    $id_cliente = $_SESSION['id_cliente'] ?? null;

    $sql_estoque = "SELECT quant_estoque FROM produto WHERE id_produto = ?";
    $estoque_query = $con->prepare($sql_estoque);
    $estoque_query->bind_param("i", $id_produto);
    $estoque_query->execute();
    $estoque_result = $estoque_query->get_result();
    $estoque_data = $estoque_result->fetch_assoc();
    $quantidade_em_estoque = $estoque_data['quant_estoque'] ?? 0;
    $estoque_query->close();

    $sql_check_carrinho = "SELECT quantidade FROM carrinho WHERE id_cliente = ? AND id_produto = ?";
    $check_carrinho_query = $con->prepare($sql_check_carrinho);
    $check_carrinho_query->bind_param("ii", $id_cliente, $id_produto);
    $check_carrinho_query->execute();
    $check_carrinho_result = $check_carrinho_query->get_result();

    if ($check_carrinho_result->num_rows > 0) {
        $carrinho_data = $check_carrinho_result->fetch_assoc();
        $quantidade_no_carrinho = $carrinho_data['quantidade'];
        $check_carrinho_query->close();
        // 2 é para quando a pessoa quer adicionar o produto mais 1 vez no carrinho, mas aquele produto já está com o limite maximo
        if (($quantidade_no_carrinho + 1) > $quantidade_em_estoque) {
            header("Location: ../cliente/detalhes_produto.php?id_produto=" . $id_produto . "&erro_estoque=2");
            exit;
        }

        $sql_update = "UPDATE carrinho SET quantidade = quantidade + 1 WHERE id_cliente = ? AND id_produto = ?";
        $update_query = $con->prepare($sql_update);
        $update_query->bind_param("ii", $id_cliente, $id_produto);
        $update_query->execute();
        $update_query->close();

    } else {
        if ($quantidade_em_estoque < 1) {
            // 1 é para quando a pessoa quer adicionar um item que aparece nos favoritos mas o estoque acabou
            header("Location: ../cliente/detalhes_produto.php?id_produto=" . $id_produto . "&erro_estoque=1");
            exit;
        }

        $sql_insert = "INSERT INTO carrinho (id_produto, quantidade, selecionado, id_cliente) VALUES (?, 1, 1, ?)";
        $insert_query = $con->prepare($sql_insert);
        $insert_query->bind_param("ii", $id_produto, $id_cliente);
        $insert_query->execute();
        $insert_query->close();
    }

    header("Location: ../cliente/carrinho.php");
    exit;
}

$con->close();
?>