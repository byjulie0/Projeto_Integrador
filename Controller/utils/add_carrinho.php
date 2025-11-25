<?php
include '../utils/autenticado.php';

if ($usuario_nao_logado) {
    include '../overlays/pop_up_login.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $id_produto = $_GET['id_produto'] ?? null;
    $id_cliente = $_SESSION['id_cliente'] ?? null;

    $sql = "SELECT quant_estoque FROM produto WHERE id_produto = ?";
    $query = $con->prepare($sql);
    $query->bind_param("i", $id_produto);
    $query->execute();

    $result = $query->get_result();
    $result = $result->fetch_assoc();
    $estoque_atual = $result['quant_estoque'] ?? 0;
    $query->close();

    // Consulta para ver se existe o item no carrinho
    $sql = "SELECT quantidade FROM carrinho WHERE id_cliente = ? AND id_produto = ?";
    $query = $con->prepare($sql);
    $query->bind_param("ii", $id_cliente, $id_produto);
    $query->execute();
    $result = $query->get_result();

    // Se existe o item, adiciona + 1
    if ($result->num_rows > 0) {

        $result = $result->fetch_assoc();
        $qtde_cart = $result['quantidade'];
        $query->close();

        // 1 é para quando a pessoa quer adicionar o produto mais 1 vez no carrinho
        //  mas aquele produto já está com o limite maximo
        if (($qtde_cart + 1) > $estoque_atual) {

            header("Location: ../cliente/detalhes_produto.php?id_produto=" . $id_produto . "&erro_estoque=1");
            exit;
        }

        // Se ainda tem como adicionar, adiciona
        $sql = "UPDATE carrinho SET quantidade = quantidade + 1 WHERE id_cliente = ? AND id_produto = ?";
        $query = $con->prepare($sql_update);
        $query->bind_param("ii", $id_cliente, $id_produto);
        $query->execute();
        $query->close();

    } else {

        // 2 é para quando a pessoa quer adicionar um item que aparece nos favoritos
        //  mas o estoque acabou
        if ($estoque_atual < 1) {

            header("Location: ../cliente/detalhes_produto.php?id_produto=" . $id_produto . "&erro_estoque=2");
            exit;
        }

        // Se o produto não está no carrinho e ele tem estoque, adiciona ao carrinho
        $sql = "INSERT INTO carrinho (id_produto, quantidade, selecionado, id_cliente) VALUES (?, 1, 1, ?)";
        $query = $con->prepare($sql_insert);
        $query->bind_param("ii", $id_produto, $id_cliente);
        $query->execute();
        $query->close();
    }

    header("Location: ../cliente/carrinho.php");
    exit;
}

$con->close();
?>