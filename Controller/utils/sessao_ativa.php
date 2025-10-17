<?php
session_start();
include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    //Recaptcha
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../cliente/login.php?error=metodo');
        exit;
    }
    $recaptcha_secret = getenv('RECAPTCHA_SECRET') ?: '6LdyqOUrAAAAAF1olqup_tnkbPYxEHydWJkhAgHO';
    $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

    if (empty($recaptcha_response)){
        header('Location: ../cliente/login.php?error=recaptcha_missing');
        exit;

    }

    $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret'   => $recaptcha_secret,
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
    }else{
        header('Location: ../../Controller/cliente/pg_cadastro.php?error=recaptcha_failed');
        echo '<script>mostrarPopup("erro", "Validação reCAPTCHA falhou!");</script>';
        exit;

    }
    //recaptcha

    $query = "SELECT id_cliente, cliente_nome, email, senha, cpf_cnpj, data_nasc, telefone, user_ativo FROM cliente WHERE email = '{$email}' ";


    $result = mysqli_query($con, $query);

    $row = mysqli_num_rows($result);

    if ($row > 0) {
        $retorno = mysqli_fetch_assoc($result);
    } else {
        echo 'Login invalido';
        header("location: ../cliente/login.php");
        exit();
    }

    

    if (password_verify($password, $retorno['senha'])) {

        $_SESSION["id_cliente"] = $retorno['id_cliente'];
        $_SESSION["cliente_nome"] = $retorno['cliente_nome'];
        $_SESSION["email"] = $retorno['email'];
        $_SESSION["cpf_cnpj"] = $retorno['cpf_cnpj'];
        $_SESSION["data_nasc"] = $retorno['data_nasc'];
        $_SESSION["telefone"] = $retorno['telefone'];
        $_SESSION["user_ativo"] = $retorno['user_ativo'];

        header("location: ../cliente/pg_inicial_cliente.php");
        exit();
    } else {
        echo 'Login invalido';
        header("location: ../cliente/login.php");
    }
}





?>