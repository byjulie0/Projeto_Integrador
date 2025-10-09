<?php
session_start();
include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $query = "SELECT id_cliente, cliente_nome, email, senha, cpf_cnpj, data_nasc, telefone, user_ativo FROM cliente WHERE email = '{$email}' ";


    $result = mysqli_query($con, $query);

    $row = mysqli_num_rows($result);

    if ($row > 0) {
        $retorno = mysqli_fetch_assoc($result);
    } else {
        echo 'Login invalido';
        header("location: ../cliente/login.php");
        exit();
    }

    if (password_verify($password, $retorno['senha'])) {

        $_SESSION["id_cliente"] = $retorno['id_cliente'];
        $_SESSION["cliente_nome"] = $retorno['cliente_nome'];
        $_SESSION["email"] = $retorno['email'];
        $_SESSION["cpf_cnpj"] = $retorno['cpf_cnpj'];
        $_SESSION["data_nasc"] = $retorno['data_nasc'];
        $_SESSION["telefone"] = $retorno['telefone'];
        $_SESSION["user_ativo"] = $retorno['user_ativo'];

        header("location: ../cliente/pg_inicial_cliente.php");
        exit();
    } else {
        echo 'Login invalido';
        header("location: ../cliente/login.php");
    }
}
?>