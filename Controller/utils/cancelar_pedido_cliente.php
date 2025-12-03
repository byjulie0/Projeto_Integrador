<?php
include "autenticado.php"; // Já deve conter a conexão $con e verificação de login

$id_pedido = isset($_GET['id_pedido']) ? intval($_GET['id_pedido']) : 0;

// Garante que a sessão esteja iniciada para passar as mensagens
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Validação do ID
if ($id_pedido === 0) {
    $_SESSION['titulo'] = 'Erro no Pedido!';
    $_SESSION['popup_message'] = 'ID do pedido inválido ou não encontrado.';
    $_SESSION['type'] = 'error';

    header("Location: ../cliente/historico_pedidos.php");
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

    // 2. Sucesso - Mensagem para o Pop-up
    $_SESSION['titulo'] = 'Pedido Cancelado!';
    $_SESSION['popup_message'] = 'Seu pedido foi cancelado com sucesso e o estoque foi reposto.';
    $_SESSION['type'] = 'success'; // Isso fará o ícone verde aparecer (se configurado no pop-up de erro)

    header("Location: ../cliente/historico_pedidos.php");
    exit;

} catch (Exception $e) {
    $con->rollback();

    // 3. Erro - Mensagem para o Pop-up
    $_SESSION['titulo'] = 'Erro ao cancelar!';
    $_SESSION['popup_message'] = 'Não foi possível cancelar o pedido. Erro técnico: ' . $e->getMessage(); // Cuidado ao exibir erro técnico para cliente final, pode simplificar a mensagem se preferir
    $_SESSION['type'] = 'error';

    header("Location: ../cliente/historico_pedidos.php");
    exit;
}
?>