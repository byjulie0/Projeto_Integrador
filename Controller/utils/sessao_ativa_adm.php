<?php
include '../../model/DB/conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    //Recaptcha
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../adm/login.php?error=nao_fez_login');
        exit;
    }
    $recaptcha_secret = getenv('RECAPTCHA_SECRET') ?: '6LdyqOUrAAAAAF1olqup_tnkbPYxEHydWJkhAgHO';
    $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

    if (empty($recaptcha_response)) {
        header('Location: ../adm/login.php?error=recaptcha_missing');
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

    if (isset($verification['success']) && $verification['success'] === true) {
        echo '<script>mostrarPopup("sucesso", "Sucesso na validação do reCAPTCHA !");</script>';
    } else {
        echo '<script>mostrarPopup("erro", "Validação reCAPTCHA falhou!");</script>';
        exit;
    }
    //recaptcha

    $query = "SELECT id_adm, adm_nome, email, telefone, senha, cnpj, funcao FROM adm WHERE email = '{$email}' and funcao = 'ADM' ";

    $result = mysqli_query($con, $query);

    $row = mysqli_num_rows($result);

    if ($row > 0) {
        $retorno = mysqli_fetch_assoc($result);
    } else {
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
        header("Location: ../adm/relatorios_visualizar.php");
        exit();
    } else {
        $_SESSION['erro'] = 1;
        // include '../overlays/pop_up_erro.php';
        header("Location: ../adm/login.php?error=senha_invalida");


        exit();
    }
}
?>