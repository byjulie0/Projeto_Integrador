<?php
include '../../model/DB/conexao.php';

// Verificar se é ADM
session_start();
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'adm') {
    header("Location: ../adm/login.php?error=acesso_negado");
    exit;
}

$id_produto = isset($_POST['id_produto']) ? intval($_POST['id_produto']) : 0;
$novo_estado = isset($_POST['produto_ativo']) ? intval($_POST['produto_ativo']) : 0;

if ($id_produto === 0) {
    header("Location: ../adm/gerenciar_produtos.php?error=id_invalido");
    exit;
}

try {
    $con->begin_transaction();

    if ($novo_estado == 0) {
        // INATIVANDO o produto
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
        
    } else {
        // ATIVANDO o produto
        $sql = "UPDATE produto SET produto_ativo = 1 WHERE id_produto = ?";
        $query = $con->prepare($sql);
        $query->bind_param("i", $id_produto);
        $query->execute();
    }

    $con->commit();
    header("Location: ../adm/gerenciar_produtos.php?success=produto_atualizado");
    exit;
    
} catch (Exception $e) {
    $con->rollback();
    header("Location: ../adm/gerenciar_produtos.php?error=erro_atualizacao");
    exit;
}
?>
