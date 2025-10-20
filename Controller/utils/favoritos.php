<?php
session_start();
require_once '../../model/DB/conexao.php';

if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit;
}

$id_cliente = $_SESSION['id_cliente'];
$id_produto = $_POST['id_produto'] ?? null;

if ($id_produto) {
    // Verifica se o produto já está nos favoritos
    $sql = "SELECT * FROM favorito WHERE cliente_id_cliente = ? AND produto_id_produto = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_cliente, $id_produto]);

    if ($stmt->rowCount() > 0) {
        // Remove dos favoritos
        $sql = "DELETE FROM favorito WHERE cliente_id_cliente = ? AND produto_id_produto = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_cliente, $id_produto]);
        $msg = "Produto removido dos favoritos!";
    } else {
        // Adiciona aos favoritos
        $sql = "INSERT INTO favorito (cliente_id_cliente, produto_id_produto) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_cliente, $id_produto]);
        $msg = "Produto adicionado aos favoritos!";
    }

    header("Location: detalhes_produto.php?id=$id_produto&msg=" . urlencode($msg));
    exit;
}
?>

