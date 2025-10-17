<?php
include 'sessao_ativa.php';

if (!isset($_SESSION['id_cliente'])) {
    header("Location: ../cliente/detalhes_produto.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_produto = $_GET['id_produto'] ?? null;
    $id_cliente = $_SESSION['id_cliente'] ?? null;
    
    if (!$id_cliente || !$id_produto) {
        header("Location: ../cliente/detalhes_produto.php?erro=dados_incompletos");
        exit;
    }

    // Verifica se o produto já está no carrinho
    $check_query = "SELECT * FROM carrinho WHERE id_cliente = ? AND id_produto = ?";
    $check_query = $con->prepare($check_query);
    $check_query->bind_param("ii", $id_cliente, $id_produto);
    $check_query->execute();
    $check_result = $check_query->get_result();
    
    if ($check_result->num_rows > 0) {
        // Atualiza quantidade se já existe
        $update_query = "UPDATE carrinho SET quantidade = quantidade + 1 WHERE id_cliente = ? AND id_produto = ?";
        $update_query = $con->prepare($update_query);
        $update_query->bind_param("ii", $id_cliente, $id_produto);
        $update_query->execute();
        $update_query->close();
    } else {
        // Insere novo item no carrinho
        $insert_query = "INSERT INTO carrinho (id_produto, quantidade, selecionado, id_cliente) VALUES (?, 1, 1, ?)";
        $insert_query = $con->prepare($insert_query);
        $insert_query->bind_param("ii", $id_produto, $id_cliente);
        $insert_query->execute();
        $insert_query->close();
    }
    
    $check_query->close();
    
    header("Location: ../cliente/carrinho.php");
    exit;
}

$con->close();
?>