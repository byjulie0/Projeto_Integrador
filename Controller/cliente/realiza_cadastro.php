<?php
session_start();

$host = "192.168.22.9";
$usuario = "turma143p1";
$senha = "sucesso@143";
$bd = "143p1";

$con = new mysqli($host, $usuario, $senha, $bd);

if ($con->connect_errno) {
    die("Falha na Conexão: (" . $con->connect_errno . ") " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'] ?? '';
    $cpf_cnpj = $_POST['cpf_cnpj'] ?? '';
    $email = $_POST['email'] ?? '';
    $data_nasc = $_POST['data_nascimento'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $senha_confirmar = $_POST['senha-confirmar'] ?? '';

    if ($senha !== $senha_confirmar) {
        die("As senhas não coincidem.");
    }

    if (strlen($senha) < 6) {
        die("A senha precisa ter no mínimo 6 caracteres.");
    }

    $stmt = $con->prepare("INSERT INTO cliente (cliente_nome, cpf_cnpj, email, data_nasc, telefone, senha, user_ativo) VALUES (?, ?, ?, ?, ?, ?, 1)");

    if (!$stmt) {
        die("Erro na preparação da query: " . $con->error);
    }

    $stmt->bind_param("ssssss", $nome, $cpf_cnpj, $email, $data_nasc, $telefone, $senha_hash);

    if ($stmt->execute()) {
        $_SESSION['mensagem_sucesso'] = "Usuário cadastrado com sucesso!";
        header("Location: login.php");
        exit();
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>
