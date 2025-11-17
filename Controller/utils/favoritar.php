<?php

include '../utils/autenticado.php';
if ($usuario_nao_logado) {
    include '../overlays/pop_up_login.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_produto = $_GET['id_produto'] ?? null;
    $id_cliente = $_SESSION['id_cliente'] ?? null;

    if ($id_cliente && $id_produto) {
        // Verifica se o produto já está favoritado por este cliente
        $sql = "SELECT 1 FROM favorito WHERE id_cliente = ? AND id_produto = ? LIMIT 1";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ii", $id_cliente, $id_produto);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $ja_favoritado = $result->num_rows > 0;
        $stmt->close();

        if ($ja_favoritado) {
            // Remove dos favoritos
            $sql = "DELETE FROM favorito WHERE id_cliente = ? AND id_produto = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('ii', $id_cliente, $id_produto);
            $stmt->execute();
            $stmt->close();
        } else {
            // Adiciona aos favoritos
            $sql = "INSERT INTO favorito (id_cliente, id_produto) VALUES (?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('ii', $id_cliente, $id_produto);
            $stmt->execute();
            $stmt->close();
        }
    }

    header("Location: ../cliente/pg_favoritos.php");
    exit;
}

$con->close();
?>