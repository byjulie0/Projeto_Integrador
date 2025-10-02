<?php

//   Verifica o reCAPTCHA com o Google
//   Retorna true se válido, false caso contrário
 
function verify_recaptcha($token) {
    // Secret Key do Google (pega do ambiente ou fallback)
    $recaptcha_secret = getenv('RECAPTCHA_SECRET') ?: '6Lc2Z9wrAAAAANVCpF0OuokXx1kvr9MSBb7GpFwT';

    if (empty($token)) {
        return false;
    }

    $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret'   => $recaptcha_secret,
        'response' => $token,
        'remoteip' => $_SERVER['REMOTE_ADDR'] ?? null
    ];

    // Inicializa cURL
    $ch = curl_init($verifyUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    curl_close($ch);

    if (!$response) {
        return false;
    }

    $verification = json_decode($response, true);

    return isset($verification['success']) && $verification['success'] === true;
}
