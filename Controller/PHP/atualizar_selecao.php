<?php
require_once '../conexao.php';

$id_item = $_POST['id_item'] ?? 0;
$selecionado = isset($_POST['selecionado']) && $_POST['selecionado'] == 1 ? 1 : 0;

if ($id_item > 0) {
    $sql = "UPDATE carrinho SET selecionado = :selecionado WHERE id_item = :id_item";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':selecionado' => $selecionado,
        ':id_item' => $id_item
    ]);
    echo json_encode(['status' => 'ok']);
} else {
    echo json_encode(['status' => 'erro', 'msg' => 'ID inválido']);
}
?>
