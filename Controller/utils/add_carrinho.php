<?php
$msgErro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST['id_cliente'] ?? null;
    $id_produto = $_POST['id_produto'] ?? null;
    $quantidade = 1;
    $selecionado = 1;

    if ($id_cliente && $id_produto) {
        $query = "INSERT INTO carrinho (id_produto, quantidade, selecionado, id_cliente)
                VALUES (?, ?, ?, ?)";
        $result = $con->prepare($query);
        $result->bind_param("iiii", $id_produto, $quantidade, $selecionado, $id_cliente);

        if ($result->execute()) {
            header("Location: carrinho.php?id_cliente=" . $id_cliente);
            exit;
        } else {
            $msgErro = "Erro ao adicionar no carrinho: " . $result->error;
        }

        $result->close();
    } else {
        $msgErro = "Erro: Cliente e Produto são obrigatórios.";
    }
}

$con->close();
?>