<?php
include 'sessao_ativa.php';
$msgErro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_SESSION['id_cliente'] ?? null;
    $id_produto = $_POST['id_produto'] ?? null;
    $quantidade = 1;
    $selecionado = 1;

    if (!$id_cliente || !$id_produto) {
        die("Dados incompletos!");
    } else {
        $query = "INSERT INTO carrinho (id_produto, quantidade, selecionado, id_cliente)
                VALUES (?, ?, ?, ?)";
        $result = $con->prepare($query);
        $result->bind_param("iiii", $id_produto, $quantidade, $selecionado, $id_cliente);
        
        if ($result->execute()) {
            header("Location: carrinho.php");
            exit;
        } else {
            $msgErro = "Erro ao adicionar no carrinho: " . $result->error;
        }
        
        $result->close();
    }
}

$con->close();
?>