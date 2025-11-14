<?php

include '../utils/autenticado.php';
if ($usuario_nao_logado) {
    include '../overlays/pop_up_login.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_produto = $_GET['id_produto'] ?? null;
    $id_cliente = $_SESSION['id_cliente'] ?? null;

    $ja_favoritado = false;

    // Verifica se o produto já está favoritado por este cliente
    if ($id_cliente && $id_produto) {
        $sql = "SELECT 1 FROM favorito WHERE id_cliente = ? AND id_produto = ? LIMIT 1";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ii", $id_cliente, $id_produto);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $ja_favoritado = true;
        }

        $stmt->close();
    }


    if (!$ja_favoritado) {
        // adiciona
        $sql = "INSERT INTO favorito (id_cliente, id_produto) VALUES (?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ii', $id_cliente, $id_produto);
        $stmt->execute();
        $stmt->close();
        //echo "FAVORITOU!";
     

    } else {
        $sql = "DELETE FROM favorito WHERE id_cliente = ? AND id_produto = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ii', $id_cliente, $id_produto);
        $stmt->execute();
        $stmt->close();
       // echo "DESFAVORITOU!";
    
    }

    header("Location: ../cliente/pg_favoritos.php");
    exit;
}

$con->close();
?>