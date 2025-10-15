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
    $check_stmt = $con->prepare($check_query);
    $check_stmt->bind_param("ii", $id_cliente, $id_produto);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        // Atualiza quantidade se já existe
        $update_query = "UPDATE carrinho SET quantidade = quantidade + 1 WHERE id_cliente = ? AND id_produto = ?";
        $update_stmt = $con->prepare($update_query);
        $update_stmt->bind_param("ii", $id_cliente, $id_produto);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        // Insere novo item no carrinho
        $insert_query = "INSERT INTO carrinho (id_produto, quantidade, selecionado, id_cliente) VALUES (?, 1, 1, ?)";
        $insert_stmt = $con->prepare($insert_query);
        $insert_stmt->bind_param("ii", $id_produto, $id_cliente);
        $insert_stmt->execute();
        $insert_stmt->close();
    }
    
    $check_stmt->close();
    
    header("Location: carrinho.php");
    exit;
}

$con->close();
?>