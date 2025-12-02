<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../../model/DB/conexao.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['id_cliente'])) {
    $_SESSION['titulo'] = 'Faça login primeiro!';
    $_SESSION['popup_message'] = 'É necessário estar logado para gerenciar favoritos.';
    $_SESSION['type'] = 'error';
    header("Location: ../cliente/login.php");
    exit;
}

$id_cliente = $_SESSION['id_cliente'];
$id_produto = isset($_POST['id_produto']) ? intval($_POST['id_produto']) : 0;

if ($id_produto === 0) {
    $_SESSION['titulo'] = 'Produto não encontrado!';
    $_SESSION['popup_message'] = 'Não foi possível remover este produto dos favoritos.';
    $_SESSION['type'] = 'error';
    header("Location: ../cliente/pg_favoritos.php");
    exit;
}

try {
    // REMOVER dos favoritos
    $sql = "DELETE FROM favorito WHERE id_cliente = ? AND id_produto = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ii', $id_cliente, $id_produto);
    $stmt->execute();
    
    $_SESSION['titulo'] = 'Removido dos favoritos!';
    $_SESSION['popup_message'] = 'O produto foi removido da sua lista de favoritos.';
    $_SESSION['type'] = 'success';
    
    header("Location: ../cliente/pg_favoritos.php");
    exit;
    
} catch (Exception $e) {
    $_SESSION['titulo'] = 'Erro!';
    $_SESSION['popup_message'] = 'Não foi possível remover dos favoritos.';
    $_SESSION['type'] = 'error';
    
    header("Location: ../cliente/pg_favoritos.php");
    exit;
}
?>