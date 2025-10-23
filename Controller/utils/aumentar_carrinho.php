<?php
include 'sessao_ativa.php';

if (!isset($_SESSION['id_cliente'])) {
    header("Location: ../cliente/login.php");
    exit;
}
$id_cliente = $_SESSION['id_cliente'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_carrinho = (int) $_GET['id_carrinho'];

    $sql_check = "SELECT  c.*, p.quant_estoque, p.produto_ativo FROM carrinho c JOIN produto p ON c.id_produto = p.id_produto WHERE c.id_cliente = ? AND c.id_carrinho = ? AND p.produto_ativo = 1";
    $check_query = $con->prepare($sql_check);
    $check_query->bind_param("ii", $id_cliente, $id_carrinho);
    $check_query->execute();
    $check_result = $check_query->get_result();

    if ($check_result->num_rows > 0) {
        
        $item = $check_result->fetch_assoc();

        if ($item['quantidade'] < $item['quant_estoque']){
            $sql_update = "UPDATE carrinho SET quantidade = quantidade + 1 WHERE id_cliente = ? AND id_carrinho = ?";
            $update_query = $con->prepare($sql_update);
            $update_query->bind_param("ii", $id_cliente, $id_carrinho);
            
            if ($update_query->execute()) {
                header("Location: ../cliente/carrinho.php?sucesso=quantidade_aumentada");
            } else {
                header("Location: ../cliente/carrinho.php?erro=update_falhou");
            }

            $update_query->close();
        } else {
            header("Location: ../cliente/carrinho.php?erro=quantidade_maxima");
        }
    } else {
        header("Location: ../cliente/carrinho.php?erro=item_nao_encontrado");
    }
    $check_query->close();
    exit;
}
$con->close();
?>