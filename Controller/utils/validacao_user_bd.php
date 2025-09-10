<?php
session_start();
include '../../model/DB/conexao.php'; // arquivo com a conexão ao banco

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar consulta segura para evitar SQL Injection
    $stmt = "SELECT * FROM user WHERE user_nome = '{$username}';";
    echo $stmt;
    $result = mysqli_query($con,$stmt);
    $row = mysqli_num_rows($result);
    echo $row;

    if ($row>0){
        
        $query = "select * from user";

        $retorno = mysqli_fetch_array($result);
        echo $retorno["user_nome"];
        echo $retorno["senha"];

        if ($retorno["senha"] == $password)
        {
            $_SESSION["username"] = $username;
            $_SESSION["funcao"] = $retorno["funcao"];

            header("Location: ../cliente/pg_inicial_cliente.php");
        }
        else{
            echo  "senha invalida ";
        }
    }
    
}
?>