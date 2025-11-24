<?php
include __DIR__ . "/../../model/DB/conexao.php";

if (!$con) {
    echo json_encode(["success" => false, "erro" => "sem_conexao"]);
    exit;
}

if (!isset($_POST['id_cliente'])) {
    echo json_encode(["success" => false, "erro" => "id_nao_enviado"]);
    exit;
}

$id = intval($_POST['id_cliente']);

$query = "SELECT user_ativo FROM cliente WHERE id_cliente = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($ativo);
$stmt->fetch();
$stmt->close();

if (!isset($ativo)) {
    echo json_encode(["success" => false, "erro" => "cliente_nao_existe"]);
    exit;
}

$novoStatus = $ativo == 0 ? 1 : 0;

$update = $con->prepare("UPDATE cliente SET user_ativo = ? WHERE id_cliente = ?");
$update->bind_param("ii", $novoStatus, $id);
$success = $update->execute();
$update->close();

header('Content-Type: application/json');
echo json_encode([
    "success" => $success,
    "novo_status" => $novoStatus
]);
