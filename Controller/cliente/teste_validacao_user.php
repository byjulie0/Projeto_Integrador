<?php
include '../../model/DB/conexao.php'; // sua conexão $con

// Recebendo dados do formulário
$user_nome = $_POST['user_nome'] ?? '';
$senha = $_POST['senha'] ?? '';

// Preparar a consulta
$sql = "SELECT * FROM user WHERE BINARY user_nome=? AND BINARY senha=?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da query: " . $con->error);
}

// Vincular parâmetros
$stmt->bind_param("ss", $user_nome, $senha);

// Executar
$stmt->execute();

// Obter resultado
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Usuário encontrado!";
} else {
    echo "Usuário não encontrado.";
}

$stmt->close();
$con->close();
?>
