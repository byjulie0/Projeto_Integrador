<?php
session_start();
include '../../model/DB/conexao.php'; 
mysqli_report(MYSQLI_REPORT_OFF);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        echo "Preencha usuário e senha.";
        exit();
    }

    if ($stmt = $con->prepare("SELECT cliente_nome, senha FROM cliente WHERE cliente_nome = ?")) {

        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['senha'])) {
                $_SESSION['username'] = $username;
                header("Location: ../cliente/pg_inicial_cliente.php");
                exit();
            } else {
                echo "Senha inválida.";
            }
        } else {
            echo "Usuário não encontrado.";
        }

        $stmt->close();

    } else {
        error_log("Erro: " . $con->error); 
        echo "Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.";
    }

    $con->close();
}
?>
