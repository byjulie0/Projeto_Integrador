<?php
// include '../../model/DB/conexao.php';

// Conexão com banco de dados (ajuste conforme seu ambiente)
$host = "localhost";
$user = "root";
$pass = "";
$db   = "teste_carrinho"; // coloque o nome do seu banco

$con = new mysqli($host, $user, $pass, $db);

// Verificar conexão
if ($con->connect_error) {
    die("Erro na conexão: " . $con->connect_error);
}

// Dados do formulário

$id_cliente  = $_POST['id_cliente'] ?? null;
$id_produto  = $_POST['id_produto'] ?? null;
$quantidade  = 1; // sempre 1
$selecionado = 1; 

if (!$id_cliente || !$id_produto) {
    die("Erro: Cliente e Produto são obrigatórios.");
}

$sql = "INSERT INTO carrinho (id_produto, quantidade, selecionado, id_cliente) 
        VALUES (?, ?, ?, ?)";

$stmt = $con->prepare($sql);
$stmt->bind_param("iiii", $id_produto, $quantidade, $selecionado, $id_cliente);

if ($stmt->execute()) {
    header("Location: carrinho.php?id_cliente=" . $id_cliente);
    exit;
} else {
    echo "Erro ao adicionar no carrinho: " . $stmt->error;
}

$stmt->close();
$con->close();

?>