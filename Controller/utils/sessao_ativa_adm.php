<?php
include '../../model/DB/conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $password = trim($_POST['password']);

    // --- Início Recaptcha ---
    $recaptcha_secret = getenv('RECAPTCHA_SECRET') ?: '6LdyqOUrAAAAAF1olqup_tnkbPYxEHydWJkhAgHO';
    $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

    if (empty($recaptcha_response)) {
        header('Location: ../adm/login.php?error=recaptcha falhou');
        exit;
    }

    $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $ch = curl_init($verifyUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $verification = json_decode($response, true);

    if (!isset($verification['success']) || $verification['success'] !== true) {
        header('Location: ../adm/login.php?error=recaptcha falhou');
        exit;
    }
    // --- Fim Recaptcha ---

    // Consulta SQL
    $query = "SELECT id_adm, adm_nome, email, telefone, senha, cnpj, funcao FROM adm WHERE email = '{$email}' AND funcao = 'ADM'";
    $result = mysqli_query($con, $query);

    // Verifica se encontrou o usuário
    if ($result && mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($result);

        // Verifica a senha
        if ($password === $result['senha']) {
            // Login com SUCESSO
            $_SESSION["id_adm"] = $result['id_adm'];
            $_SESSION["adm_nome"] = $result['adm_nome'];
            $_SESSION["email"] = $result['email'];
            $_SESSION["telefone"] = $result['telefone'];
            $_SESSION["cnpj"] = $result['cnpj'];
            $_SESSION["funcao"] = $result['funcao'];
            
            header("Location: ../adm/pg_inicial_adm.php");
            exit();
        } else {
            // Senha incorreta
            header("Location: ../adm/login.php?error=email ou senha errados");
            exit();
        }
    } else {
        // Usuário não encontrado no banco
        header("Location: ../adm/login.php?error=email ou senha errados");
        exit();
    }
}
?>