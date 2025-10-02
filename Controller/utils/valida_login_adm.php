<?php
session_start();
include '../../model/DB/conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        echo "<script>alert('Preencha todos os campos!'); window.location.href='../../Controller/adm/login.php';</script>";
        exit;
    }

    $sql = "SELECT id_adm, adm_nome, email, senha, funcao 
            FROM adm 
            WHERE email = ? LIMIT 1";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($password === $row['senha']) { 
            $_SESSION['id_adm']   = $row['id_adm'];
            $_SESSION['adm_nome'] = $row['adm_nome'];
            $_SESSION['funcao']   = $row['funcao'];
            $_SESSION['tipo_usuario']= 'ADM'; 



            header("Location: ../../Controller/adm/pg_inicial_adm.php");
            exit;
        } else {
            echo "<script>alert('Senha incorreta!'); window.location.href='../../Controller/adm/login.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Administrador não encontrado!'); window.location.href='../../Controller/adm/login.php';</script>";
        exit;
    }
}
?>
