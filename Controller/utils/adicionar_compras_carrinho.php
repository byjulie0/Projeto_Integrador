<?php
$msgErro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente  = $_POST['id_cliente'] ?? null;
    $id_produto  = $_POST['id_produto'] ?? null;
    $quantidade  = 1;
    $selecionado = 1;

    if ($id_cliente && $id_produto) {
        $sql = "INSERT INTO carrinho (id_produto, quantidade, selecionado, id_cliente) 
                VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("iiii", $id_produto, $quantidade, $selecionado, $id_cliente);

        if ($stmt->execute()) {
            header("Location: carrinho.php?id_cliente=" . $id_cliente);
            exit;
        } else {
            $msgErro = "Erro ao adicionar no carrinho: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $msgErro = "Erro: Cliente e Produto são obrigatórios.";
    }
}

$con->close();
?>