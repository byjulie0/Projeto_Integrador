<?php
include '../../model/DB/conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome     = mysqli_real_escape_string($con, $_POST['adm_nome']);
    $email    = mysqli_real_escape_string($con, $_POST['email']);
    $telefone = mysqli_real_escape_string($con, $_POST['telefone']);
    $cnpj     = mysqli_real_escape_string($con, $_POST['cnpj']); // precisa existir no formulário

    $query = "UPDATE adm
              SET adm_nome = '$nome', email = '$email', telefone = '$telefone'
              WHERE cnpj = '$cnpj'";

    mysqli_query($con, $query);

    $con->close();
}

header("Location: ../adm/meu_perfil.php");
exit;
?>
