<?php
session_start();
include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>alert('Método não permitido!'); window.location.href='../../Controller/adm/login.php';</script>";
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($email) || empty($password)) {
    echo "<script>alert('Preencha todos os campos!'); window.location.href='../../Controller/adm/login.php';</script>";
    exit;
}

$sql = "SELECT id_adm, adm_nome, email, telefone, senha, cnpj, funcao
        FROM adm
        WHERE email = ? AND funcao = 'ADM'
        LIMIT 1";

$query = $con->prepare($sql);
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();

if ($row = $result->fetch_assoc()) {
    if ($password === $row['senha']) {
        $_SESSION['id_adm'] = $row['id_adm'];
        $_SESSION['adm_nome'] = $row['adm_nome'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['telefone'] = $row['telefone'];
        $_SESSION['cnpj'] = $row['cnpj'];
        $_SESSION['funcao'] = $row['funcao'];
        $_SESSION['tipo_usuario'] = 'ADM';

        echo "<script>alert('Login realizado com sucesso!'); window.location.href='../../Controller/adm/pg_inicial_adm.php';</script>";
        exit;
    } else {
        echo "<script>alert('Senha incorreta!'); window.location.href='../../Controller/adm/login.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Administrador não encontrado!'); window.location.href='../../Controller/adm/login.php';</script>";
    exit;
}
?>