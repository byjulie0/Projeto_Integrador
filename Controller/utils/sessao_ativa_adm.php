<?php
session_start();
include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    echo $email;
    echo $password;

    $query = "SELECT id_adm, adm_nome, email, telefone, senha, cnpj, funcao FROM adm WHERE email = '{$email}' and funcao = 'ADM' ";

    $result = mysqli_query($con, $query);

    $row = mysqli_num_rows($result);

    if ($row > 0) {
        $retorno = mysqli_fetch_assoc($result);
    } else {
        echo 'Login invalido';
        header("Location: ../adm/login.php");
        exit();
    }

    if ($password === $retorno['senha']) {

        $_SESSION["id_adm"] = $retorno['id_adm'];
        $_SESSION["adm_nome"] = $retorno['adm_nome'];
        $_SESSION["email"] = $retorno['email'];
        $_SESSION["telefone"] = $retorno['telefone'];
        $_SESSION["cnpj"] = $retorno['cnpj'];
        $_SESSION["funcao"] = $retorno['funcao'];
        header("Location: ../adm/pg_inicial_adm.php");
        exit();
    } else {
        echo 'Login invalido';
        header("Location: ../adm/login.php");
        exit();
    }
}
?>