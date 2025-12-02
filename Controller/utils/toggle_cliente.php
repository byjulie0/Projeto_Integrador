<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../../model/DB/conexao.php';

$id_cliente = isset($_POST['id_cliente']) ? intval($_POST['id_cliente']) : 0;

if ($id_cliente === 0) {
    $_SESSION['titulo'] = 'Cliente não encontrado!';
    $_SESSION['popup_message'] = 'Não foi possível alterar o status do cliente.';
    $_SESSION['type'] = 'error';
    header("Location: ../adm/gerenciar_clientes.php");
    exit;
}

try {
    $con->begin_transaction();

    // Primeiro, busca o status atual do cliente
    $sql = "SELECT user_ativo FROM cliente WHERE id_cliente = ?";
    $query = $con->prepare($sql);
    $query->bind_param("i", $id_cliente);
    $query->execute();
    $query->bind_result($ativo);
    $query->fetch();
    $query->close();

    if (!isset($ativo)) {
        throw new Exception("Cliente não encontrado no banco de dados.");
    }

    // Define o novo status (alterna entre 0 e 1)
    $novoStatus = $ativo == 0 ? 1 : 0;

    // Atualiza o status do cliente
    $update = $con->prepare("UPDATE cliente SET user_ativo = ? WHERE id_cliente = ?");
    $update->bind_param("ii", $novoStatus, $id_cliente);
    $update->execute();

    if ($update->affected_rows > 0) {

        $sql = "SELECT cliente_nome FROM cliente WHERE id_cliente = ?";
        $query = $con->prepare($sql);
        $query->bind_param("i", $id_cliente);
        $query->execute();
        $query->bind_result($nome);
        $query->fetch();
        $query->close();

        if ($novoStatus == 1) {

            // Cliente ATIVADO
            $_SESSION['titulo'] = 'Cliente ativado com sucesso!';
            $_SESSION['popup_message'] = $nome.' foi reativada/o no sistema.';
            $_SESSION['type'] = 'success';

        } else {
            // Cliente INATIVADO

            $_SESSION['titulo'] = 'Cliente inativado com sucesso!';
            $_SESSION['popup_message'] = $nome.' foi inativado no sistema.';
            $_SESSION['type'] = 'success';
        }
    } else {
        throw new Exception("Nenhuma alteração foi realizada.");
    }

    $update->close();
    $con->commit();

    // Redireciona de volta para a página de relatórios
    header("Location: ../adm/gerenciar_clientes.php");
    exit;

} catch (Exception $e) {
    $con->rollback();
    $_SESSION['titulo'] = 'Erro ao alterar status!';
    $_SESSION['popup_message'] = 'Não foi possível alterar o status do cliente: ' . $e->getMessage();
    $_SESSION['type'] = 'error';
    
    header("Location: ../adm/gerenciar_clientes.php");
    exit;
}
?>