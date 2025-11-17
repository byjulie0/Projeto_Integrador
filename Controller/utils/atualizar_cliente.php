<?php
include '../../model/DB/conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_SESSION['id_cliente'];

    $nome = mysqli_real_escape_string($con, $_POST['cliente_nome']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $telefone = mysqli_real_escape_string($con, $_POST['telefone']);
    $data_nasc = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['data_nasc'])));

    $query = "UPDATE cliente
            SET cliente_nome = '{$nome}', email = '{$email}', telefone = '{$telefone}', data_nasc = '{$data_nasc}'
            WHERE id_cliente = '{$id_cliente}'";

    $result = mysqli_query($con, $query);
    $con->close();
}
header(header: "Location: ../cliente/meu_perfil.php");
exit;
?>