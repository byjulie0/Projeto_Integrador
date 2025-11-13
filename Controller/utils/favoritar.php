<?php
include '../../model/DB/conexao.php';
header('Content-Type: application/json');

if (!isset($_SESSION['id_cliente'])) {
    echo json_encode(['status' => 'nao_logado']);
    exit;
}

$id_cliente = $_SESSION['id_cliente'];
$id_produto = $_POST['id_produto'] ?? null;

if (!$id_produto) {
    echo json_encode(['status' => 'erro']);
    exit;
}

// verifica se já favoritou
$sql = "SELECT 1 FROM favorito WHERE id_cliente = ? AND id_produto = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('ii', $id_cliente, $id_produto);
$stmt->execute();
$result = $stmt->get_result();

if  {
    // adiciona
    $sql = "INSERT INTO favorito (id_cliente, id_produto) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ii', $id_cliente, $id_produto);
    $stmt->execute();
    echo json_encode(['status' => 'adicionado']);
}

