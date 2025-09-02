<?php
session_start();
include '../../model/DB/conexao.php'; // arquivo com a conexão ao banco

/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
            header("Location: ../cliente/pg_inicial_cliente.php");
        }
        else{
            echo  "senha invalida ";
        }
    }
    
}*/
/*codigo atualizado para tabela clientes */

session_start();
include '../../model/DB/conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $stmt = "SELECT * FROM cliente WHERE cliente_nome = '{$username}' OR email = '{$username}';";
    echo $stmt; 

    $result = mysqli_query($con, $stmt);
    $row = mysqli_num_rows($result);
    echo $row; 

    if ($row > 0) {
        $retorno = mysqli_fetch_array($result);
        echo $retorno["cliente_nome"];
        echo $retorno["senha"];

        
        if ($retorno["senha"] == $password) {
            $_SESSION["cliente_nome"] = $retorno["cliente_nome"];
            $_SESSION["cliente_id"] = $retorno["id_cliente"];
            $_SESSION["tipo_user"] = $retorno["tipo_user_idtipo_user"];

            header("Location: ../cliente/pg_inicial_cliente.php");
            exit();
        } else {
            echo "Senha inválida.";
        }
    } else {
        echo "Cliente não encontrado.";
    }
}



/* verifica se o user está com a sessão logada no site */ 

session_start();


if (!isset($_SESSION['username'])) {
    
    header("Location: login.php");
    exit(); 
}




?>