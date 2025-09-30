<?php
include '../../model/DB/conexao.php';

$email = mysqli_real_escape_string($conn,$_POST["email_recuperar_senha"]);
$novasenha = mysqli_real_escape_string($conn,$_POST["nova_senha_recuperar_senha"]);
$confirmarsenha = mysqli_real_escape_string($conn,$_POST["conf_senha_recuperar_senha"]);


if ($novasenha == $confirmarsenha){


    $query2="SELECT senha FROM cliente WHERE email = '{$email}'";
    $verif=mysqli_query($conn, $query2);
    $linha = mysqli_fetch_assoc($verif);
    $senha_antiga = $linha['senha'];

    if ($novasenha == $senha_antiga){
        header("location:recuperar_senha_login3.php");
    }
    else{
    $query = "UPDATE login SET senha = '{$novasenha}' WHERE email = '{$email}'";
    mysqli_query($conn, $query);
    // echo "senha atualizada";
    header("location: ../cliente/pg_login.php");
    exit();
}
}
else{
    echo"erro na atualização";
}
?>