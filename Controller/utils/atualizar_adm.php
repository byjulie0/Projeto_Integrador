<?php
include '../../model/DB/conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string(mysql: $con, string: $_POST['nome']);
    $email = mysqli_real_escape_string(mysql: $con, string: $_POST['email']);
    $telefone = mysqli_real_escape_string(mysql: $con, string: $_POST['telefone']);
    $cnpj = mysqli_real_escape_string(mysql: $con, string: $_POST['cnpj']);

    $query = "UPDATE adm
              SET adm_nome = '{$nome}', email = '{$email}', telefone = '{$telefone}'
              WHERE cnpj = '{$cnpj}'";

    $result = mysqli_query(mysql: $con, query: $query);
    $con->close();
}
header(header: "Location: ../adm/meu_perfil.php");
exit;
?>
