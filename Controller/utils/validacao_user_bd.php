<?php
session_start();
include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    // MODIFIQUEI: Selecionando mais campos para debug
    $stmt = $con->prepare("SELECT senha, LENGTH(senha) as senha_length FROM cliente WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // DEBUG: Mostra informações da senha
        echo "Senha no BD: " . $row['senha'] . "<br>";
        echo "Tamanho da senha: " . $row['senha_length'] . "<br>";
        echo "Senha digitada: " . $password . "<br>";
        
        // Tenta verificar com password_verify
        if (password_verify($password, $row['senha'])) {
            echo "Senha VÁLIDA com password_verify!";
            // header("Location: ../../Controller/cliente/meu_perfil_editar.php");
            // exit;
        } else {
            echo "Senha INVÁLIDA com password_verify.<br>";
            
            // Verifica se é texto simples
            if ($password === $row['senha']) {
                echo "Mas a senha está em TEXTO SIMPLES no BD!";
            }
        }
    }
    $stmt->close();
}
?>