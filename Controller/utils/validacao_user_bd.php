<?php
session_start();
include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe dados do formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Preparar consulta segura para evitar SQL Injection
    $stmt = "SELECT * FROM cliente WHERE email = '{$email}';";
    // echo $stmt;
    $result = mysqli_query($con,$stmt);
    $row = mysqli_num_rows($result);
    // echo $row;

    if ($row>0){
        
        // $query = "select * from user";

        $retorno = mysqli_fetch_array($result);
        // echo $retorno["email"];
        // echo $retorno["senha"];

        if ($retorno["senha"] == $password)
        {
            $_SESSION["email"] = $email;
            header("Location: ../cliente/pg_inicial_cliente.php");
        }
        else{
            echo  "senha invalida ";
        }
    }

    if (empty($senhaDigitada)) {
        echo "Por favor, insira a senha.";
        exit;
    }

    $stmt = $con->prepare("SELECT senha FROM cliente WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

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

    $stmt->close();
}
?>
