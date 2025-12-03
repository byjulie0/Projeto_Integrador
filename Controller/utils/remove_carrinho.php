<?php 
include '../../model/DB/conexao.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se existe o ID
$id_carrinho = isset($_GET['id_carrinho']) ? intval($_GET['id_carrinho']) : 0;

if ($id_carrinho === 0) {
    $_SESSION['titulo'] = 'Erro!';
    $_SESSION['popup_message'] = 'Item não identificado.';
    $_SESSION['type'] = 'error_res';
    header("Location: ../cliente/carrinho.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_cliente = $_SESSION["id_cliente"];

    try {
        // Prepara a remoção
        $sql = "DELETE FROM carrinho WHERE id_carrinho = ? AND id_cliente = ?";
        $query = $con->prepare($sql);
        $query->bind_param("ii", $id_carrinho, $id_cliente);
        
        if ($query->execute()) {
            // Verifica se alguma linha foi realmente apagada
            if ($query->affected_rows > 0) {
                $_SESSION['titulo'] = 'Item removido!';
                $_SESSION['popup_message'] = 'O item foi removido do seu carrinho com sucesso.';
                $_SESSION['type'] = 'success_res';
            } else {
                // Caso o item não exista ou não seja desse cliente
                $_SESSION['titulo'] = 'Atenção!';
                $_SESSION['popup_message'] = 'Este item já foi removido ou não existe.';
                $_SESSION['type'] = 'error_res';
            }
        } else {
            throw new Exception("Erro na execução do SQL.");
        }
        
        $query->close();
        
    } catch (Exception $e) {
        $_SESSION['titulo'] = 'Erro ao remover!';
        $_SESSION['popup_message'] = 'Não foi possível remover o item. Tente novamente.';
        $_SESSION['type'] = 'error_res';
    }

    $con->close();
    header("Location: ../cliente/carrinho.php");
    exit;
}
?>