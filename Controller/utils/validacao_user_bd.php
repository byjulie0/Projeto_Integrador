<?php
session_start();
include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $query = "select * from cliente where email = '{$email}' ";


    $result = mysqli_query($con, $query);

    $row = mysqli_num_rows($result);

    if ($row > 0) {
        $retorno = mysqli_fetch_array($result);
    } else {
        // echo 'Login invalido'; //criar um alerta ALGUM DADO ERRADO
        header("location: ../cliente/login.php");
        exit();
    }

    if (password_verify($password, $retorno['senha'])) {

        $_SESSION["nome"] = $retorno['cliente_nome'];
        $_SESSION["email"] = $retorno['email'];


        header("location: ../cliente/pg_inicial_cliente.php");
        exit();
    } else {
        // echo 'Login invalido'; //criar um alerta
        header("location: ../cliente/login.php");

    }
}




?>