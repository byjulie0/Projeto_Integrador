<?php
session_start();
include '../../model/DB/conexao.php';


if (!isset($_SESSION['id_cliente'])) {
    die("Erro: Usuário não está logado.");
}

$id_cliente = $_SESSION['id_cliente'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha_atual     = $_POST['senha_atual'] ?? '';
    $nova_senha      = $_POST['nova_senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';


    if (empty($senha_atual) || empty($nova_senha) || empty($confirmar_senha)) {
        die("Erro: Preencha todos os campos.");
    }

 
    $query = "SELECT senha FROM cliente WHERE id_cliente = '$id_cliente'";
    $result = mysqli_query($con, $query);

    if (!$result || mysqli_num_rows($result) === 0) {
        die("Erro: Usuário não encontrado.");
    }

    $dados = mysqli_fetch_assoc($result);
    $senha_hash_banco = $dados['senha'];


    if (!password_verify($senha_atual, $senha_hash_banco)) {
        die("Erro: Senha atual incorreta.");
    }

    if ($nova_senha !== $confirmar_senha) {
        die("Erro: As senhas não coincidem.");
    }

    if (strlen($nova_senha) < 6) {
        die("Erro: A nova senha precisa ter pelo menos 6 caracteres.");
    }


    $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

    $update = "UPDATE cliente SET senha = '$nova_senha_hash' WHERE id_cliente = '$id_cliente'";
    $resultado_update = mysqli_query($con, $update);

    if (!$resultado_update) {
        die("Erro ao atualizar senha: " . mysqli_error($con));
    }


    $_SESSION['mensagem_sucesso'] = "Senha atualizada com sucesso!";
    header("Location: ../../Controller/cliente/meu_perfil.php");
    exit();
}
?>
