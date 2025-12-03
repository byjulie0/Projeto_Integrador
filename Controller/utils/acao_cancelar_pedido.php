<?php
include '../../model/DB/conexao.php';

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
    $con->begin_transaction();

    // Devolve estoque dos produtos relacionados a esse pedido
    $sql = "SELECT id_produto, qtd_produto FROM item WHERE id_pedido = ?";
    $query = $con->prepare($sql);
    $query->bind_param("i", $id_pedido);
    $query->execute();
    $result = $query->get_result();

    while ($row = $result->fetch_assoc()) {
        // Devolve o estoque
        $sql = "UPDATE produto SET quant_estoque = quant_estoque + ? WHERE id_produto = ?";
        $query = $con->prepare($sql);
        $query->bind_param("ii", $row['qtd_produto'], $row['id_produto']);
        $query->execute();
        // Reativa o produto se o estoque ficou positivo
        $sql = "UPDATE produto SET produto_ativo = 1 WHERE id_produto = ? AND quant_estoque > 0";
        $query = $con->prepare($sql);
        $query->bind_param("i", $row['id_produto']);
        $query->execute();
    }

    // Atualiza o status do pedido - A TRIGGER vai criar a notificação
    $sql = "UPDATE pedido SET status_pedido = 'Cancelado' WHERE id_pedido = ?";
    $query = $con->prepare($sql);
    $query->bind_param("i", $id_pedido);
    $query->execute();

    $con->commit();

    $_SESSION['titulo'] = 'Pedido cancelado com sucesso!';
    $_SESSION['popup_message'] = 'Este pedido foi cancelado e o cliente foi avisado.';
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