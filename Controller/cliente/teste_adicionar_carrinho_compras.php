<?php
include '../../model/DB/conexao.php';

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

// Recebendo dados do formulário
$id_cliente  = $_POST['id_cliente'] ?? null;
$id_produto  = $_POST['id_produto'] ?? null;
$quantidade  = $_POST['quantidade'] ?? 1;
$selecionado = isset($_POST['selecionado']) ? 1 : 0;

// Validação simples
if (!$id_cliente || !$id_produto) {
    die("Erro: Cliente e Produto são obrigatórios.");
}

// Preparar a query
$sql = "INSERT INTO carrinho (id_produto, quantidade, selecionado, id_cliente) 
        VALUES (?, ?, ?, ?)";

$stmt = $con->prepare($sql);

if ($stmt === false) {
    die("Erro na preparação da query: " . $con->error);
}

$stmt->bind_param("iiii", $id_produto, $quantidade, $selecionado, $id_cliente);

if ($stmt->execute()) {
    echo "Produto adicionado ao carrinho com sucesso!<br>";
    echo "<a href='index.html'>Voltar</a>";
} else {
    echo "Erro ao adicionar no carrinho: " . $stmt->error;
}

$stmt->close();
$con->close();

?>