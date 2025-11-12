<?php
session_start();
include 'autenticado.php';

// Verifica se existe um pedido criado para limpar o carrinho
if (isset($_SESSION['pedido_criado_id'])) {
    
    // Limpa o carrinho do cliente
    $sql_limpar = "DELETE FROM carrinho WHERE id_cliente = ?";
    $query_limpar = $con->prepare($sql_limpar);
    $query_limpar->bind_param("i", $id_cliente);
    $query_limpar->execute();
    $query_limpar->close();
    
    // Remove a flag de pedido criado
    unset($_SESSION['pedido_criado_id']);
}

// Redireciona para histórico de pedidos
header("Location: ../cliente/historico_pedidos.php");
exit;
?>