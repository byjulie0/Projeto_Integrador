<?php
session_start();
include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senhaDigitada = trim($_POST['senha'] ?? '');
    $email = $_SESSION['email'] ?? '';

    if (!$email) {
        echo "Usuário não está logado.";
        exit;
    }

    if (empty($senhaDigitada)) {
        echo "Por favor, insira a senha.";
        exit;
    }

    $query = $con->prepare("SELECT senha FROM cliente WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($senhaDigitada, $row['senha'])) {
            header("Location: ../../Controller/cliente/meu_perfil_editar.php");
            exit;
        } else {
            echo "Senha inválida.";
            exit;
        }
    } else {
        echo "Usuário não encontrado.";
        exit;
    }

}
$query->close();
?>
