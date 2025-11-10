<?php
include 'sessao_ativa.php';

if (!isset($_SESSION['id_cliente'])) {
    echo json_encode(['status' => 'error', 'message' => 'nao_fez_login']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_produto = $_POST['id_produto'] ?? null;
    $id_cliente = $_SESSION['id_cliente'] ?? null;
    
    if (!$id_cliente || !$id_produto) {
        echo json_encode(['status' => 'error', 'message' => 'dados_incompletos']);
        exit;
    }

    // Verifica se já é favorito
    $sql_check = "SELECT * FROM favoritos WHERE id_cliente = ? AND id_produto = ?";
    $check_query = $con->prepare($sql_check);
    $check_query->bind_param("ii", $id_cliente, $id_produto);
    $check_query->execute();
    $check_result = $check_query->get_result();
    
    if ($check_result->num_rows > 0) {
        // Já está favoritado → remove
        $sql_delete = "DELETE FROM favoritos WHERE id_cliente = ? AND id_produto = ?";
        $delete_query = $con->prepare($sql_delete);
        $delete_query->bind_param("ii", $id_cliente, $id_produto);
        $delete_query->execute();
        $delete_query->close();

        echo json_encode(['status' => 'removed']);
    } else {
        // Ainda não → adiciona
        $sql_insert = "INSERT INTO favoritos (id_produto, id_cliente) VALUES (?, ?)";
        $insert_query = $con->prepare($sql_insert);
        $insert_query->bind_param("ii", $id_produto, $id_cliente);
        $insert_query->execute();
        $insert_query->close();

        echo json_encode(['status' => 'added']);
    }

    $check_query->close();
    exit;
}

$con->close();
?>
