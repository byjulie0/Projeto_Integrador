
<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../Controller/cliente/pg_cadastro.php?error=metodo');
    exit;
}
$recaptcha_secret = getenv('RECAPTCHA_SECRET') ?: '6LdIlOArAAAAAFvXhEakEwdsM9ZiX0H-RtF7xguk';
$recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

if (empty($recaptcha_response)){
    header('Location: ../../Controller/cliente/pg_cadastro.php?error=recaptcha_missing');
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
    header('Location: ../../Controller/cliente/login.php');
    echo '<script>mostrarPopup("sucesso", "Cadastro realizado com sucesso!");</script>';
    exit; 
}else{
    header('Location: ../../Controller/cliente/pg_cadastro.php?error=recaptcha_failed');
    echo '<script>mostrarPopup("erro", "Falha ao realizar o cadadstro!");</script>';
    exit;

}



