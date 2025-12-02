<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../../model/DB/conexao.php';

$id_produto = isset($_POST['id_produto']) ? intval($_POST['id_produto']) : 0;
$status_atual = $_POST['produto_ativo'];

if ($id_produto === 0) {
    $_SESSION['titulo'] = 'Produto não encontrado!';
    $_SESSION['popup_message'] = 'Não foi possivel inativar esse produto, tente novamente.';
    $_SESSION['type'] = 'error';
    header("Location: ../adm/catalogo_produtos.php");
    exit;
}

try {
    $con->begin_transaction();

    if ($status_atual == 1) { // INATIVANDO o produto

        $sql = "UPDATE produto SET produto_ativo = 0 WHERE id_produto = ?";
        $query = $con->prepare($sql);
        $query->bind_param("i", $id_produto);
        $query->execute();

        // Remove de todos os carrinhos
        $sql = "DELETE FROM carrinho WHERE id_produto = ?";
        $query = $con->prepare($sql);
        $query->bind_param("i", $id_produto);
        $query->execute();

        // Remove de todos os favoritos
        $sql = "DELETE FROM favorito WHERE id_produto = ?";
        $query = $con->prepare($sql);
        $query->bind_param("i", $id_produto);
        $query->execute();
        
        $_SESSION['titulo'] = 'Produto inativado com sucesso!';
        $_SESSION['popup_message'] = 'O produto foi retirado do catalogo, para fazer com que volte a aparecer, será necessário ativar.';
        $_SESSION['type'] = 'success';

    } else if ($status_atual == 0) { // ATIVANDO o produto

        // Verificando se a quantidade do produto é > 0
        $sql_check = "SELECT quant_estoque FROM produto WHERE id_produto = ? AND quant_estoque > 0";
        $query = $con->prepare($sql_check);
        $query->bind_param("i", $id_produto);
        $query->execute();
        $query = $query->get_result();

        if ($query->num_rows == 0) {

            $_SESSION['titulo'] = 'Não foi possivel ativar este produto!';
            $_SESSION['popup_message'] = 'Não é possivel adicionar um produto sem estoque ao catalogo, para fazer com que volte a aparecer, será necessário aumentar o estoque.';
            $_SESSION['type'] = 'error';

        } else {

            $sql = "UPDATE produto SET produto_ativo = 1 WHERE id_produto = ?";
            $query = $con->prepare($sql);
            $query->bind_param("i", $id_produto);
            $query->execute();
            $_SESSION['titulo'] = 'Produto ativado com sucesso!';
            $_SESSION['popup_message'] = 'O produto foi readicionado ao catalogo, para fazer com que seja tirado, será necessário inativar.';
            $_SESSION['type'] = 'success';
        }
    }

    $con->commit();
    header("Location: ../adm/catalogo_produtos.php");
    exit;

} catch (Exception $e) {
    $con->rollback();
    header("Location: ../adm/catalogo_produtos.php");
    exit;
}
?>