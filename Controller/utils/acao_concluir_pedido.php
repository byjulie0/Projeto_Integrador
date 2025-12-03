<?php
include '../../model/DB/conexao.php';
include 'gerar_notificacao.php';


$id_pedido = isset($_GET['id_pedido']) ? intval($_GET['id_pedido']) : null;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($id_pedido == null) {
    $_SESSION['titulo'] = 'Pedido não encontrado!';
    $_SESSION['popup_message'] = 'Não foi possível encontrar esse pedido no catalogo.';
    $_SESSION['type'] = 'error';

    header("Location: ../adm/verificar_administrar_pedido.php");
    exit;
}

try {
    $sql = "UPDATE pedido SET status_pedido = 'Concluído' WHERE id_pedido = ?";
    $query = $con->prepare($sql);
    $query->bind_param("i", $id_pedido);
    $query->execute();
    $con->commit();

    $_SESSION['titulo'] = 'Pedido concluído com sucesso!';
    $_SESSION['popup_message'] = 'Não se esqueça de garantir que o pedido chegue ao cliente.';
    $_SESSION['type'] = 'success';

    header("Location: ../adm/verificar_pedido_infos.php?id_pedido=". $id_pedido);
    exit;
    
} catch (Exception $e) {
    $con->rollback();

    $_SESSION['titulo'] = 'Erro ao concluir o pedido!';
    $_SESSION['popup_message'] = 'Não foi possivel concluir o pedido'. $e;
    $_SESSION['type'] = 'error';

    header("Location: ../adm/verificar_pedido_infos.php?id_pedido=". $id_pedido);
    exit;
}
?>