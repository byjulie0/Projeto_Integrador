<?php
include 'conexao.php';

if (!isset($_SESSION['id_cliente'])) {
    // Salva a URL atual para redirecionar depois do login
    $_SESSION['redirect_after_login'] = $_SERVER['HTTP_REFERER'] ?? '../cliente/index.php';
    header("Location: ../cliente/login.php?error=precisa_login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_produto = $_GET['id_produto'] ?? null;
    $id_cliente = $_SESSION['id_cliente'];
    
    if (!$id_produto) {
        header("Location: ../cliente/index.php?error=produto_invalido");
        exit;
    }

    try {
        // Verifica se o produto já está favoritado
        $sql_check = "SELECT * FROM favoritos WHERE id_cliente = ? AND id_produto = ?";
        $check_query = $con->prepare($sql_check);
        $check_query->bind_param("ii", $id_cliente, $id_produto);
        $check_query->execute();
        $check_result = $check_query->get_result();
        
        if ($check_result->num_rows > 0) {
            // Remove dos favoritos
            $sql_delete = "DELETE FROM favoritos WHERE id_cliente = ? AND id_produto = ?";
            $delete_query = $con->prepare($sql_delete);
            $delete_query->bind_param("ii", $id_cliente, $id_produto);
            $delete_query->execute();
            $delete_query->close();

            $acao = 'removido';
        } else {
            // Adiciona aos favoritos
            $sql_insert = "INSERT INTO favoritos (id_produto, id_cliente) VALUES (?, ?)";
            $insert_query = $con->prepare($sql_insert);
            $insert_query->bind_param("ii", $id_produto, $id_cliente);
            $insert_query->execute();
            $insert_query->close();

            $acao = 'adicionado';
        }

        $check_query->close();
        
        // Redireciona de volta para a página do produto
        header("Location: ../cliente/detalhes_produto.php?id_produto=$id_produto&favorito=$acao");
        exit;
        
    } catch (Exception $e) {
        header("Location: ../cliente/detalhes_produto.php?id_produto=$id_produto&error=erro_favorito");
        exit;
    }
}

$con->close();
?>