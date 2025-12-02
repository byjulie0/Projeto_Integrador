<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../../model/DB/conexao.php';

// Verificar se o usuário está logado
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../cliente/pg_inicial_cliente.php');
    exit;
}

$id_cliente = isset($_POST['id_cliente']) ? intval($_POST['id_cliente']) : null;
$id_produto = isset($_POST['id_produto']) ? intval($_POST['id_produto']) : null;
$ehfavorito = isset($_POST['eh_favorito']) ? intval($_POST['eh_favorito']) : null;

if ($id_produto == null) {
    $_SESSION['titulo'] = 'Produto não encontrado!';
    $_SESSION['popup_message'] = 'Não foi possível encontrar esse produto no catalogo.';
    $_SESSION['type'] = 'error';
    header("Location: ../cliente/detalhes_produto.php?id_produto=" . $id_produto);
    exit;

} else if ($id_cliente == null) {
    include '../overlays/pop_up_login.php';
    exit;
}

try {
    $con->begin_transaction();

    if ($ehfavorito == 1) {
        // Remove dos favoritos
        $sql = "DELETE FROM favorito WHERE id_cliente = ? AND id_produto = ?";
        $query = $con->prepare($sql);
        $query->bind_param('ii', $id_cliente, $id_produto);
        $query->execute();
        $query->close();

        $_SESSION['titulo'] = 'Removido dos favoritos!';
        $_SESSION['popup_message'] = 'O produto foi removido da sua lista de favoritos.';
        $_SESSION['type'] = 'success';
    } else {
        // Adiciona aos favoritos
        $sql = "INSERT INTO favorito (id_cliente, id_produto) VALUES (?, ?)";
        $query = $con->prepare($sql);
        $query->bind_param('ii', $id_cliente, $id_produto);
        $query->execute();
        $query->close();

        $_SESSION['titulo'] = 'Adicionado aos favoritos!';
        $_SESSION['popup_message'] = 'O produto foi adicionado à sua lista de favoritos.';
        $_SESSION['type'] = 'success';
    }

    $con->commit();

    // SEMPRE redireciona de volta para detalhes_produto.php
    header("Location: ../cliente/detalhes_produto.php?id_produto=" . $id_produto);
    exit;

} catch (Exception $e) {
    $con->rollback();
    $_SESSION['titulo'] = 'Erro!';
    $_SESSION['popup_message'] = 'Não foi possível atualizar os favoritos.';
    $_SESSION['type'] = 'error';

    header("Location: ../cliente/detalhes_produto.php?id_produto=" . $id_produto);
    exit;
}
?>