<?php
session_start();
include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>alert('Método não permitido!'); window.location.href='../../Controller/adm/login.php';</script>";
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($email) || empty($password)) {
    echo "<script>alert('Preencha todos os campos!'); window.location.href='../../Controller/adm/login.php';</script>";
    exit;
}
//Recaptcha
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../adm/login.php?error=metodo');
    exit;
}
$recaptcha_secret = getenv('RECAPTCHA_SECRET') ?: '6LdyqOUrAAAAAF1olqup_tnkbPYxEHydWJkhAgHO';
$recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

if (empty($recaptcha_response)){
    header('Location: ../adm/login.php?error=recaptcha_missing');
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
    header('Location: ../adm/login.php?error=recaptcha_failed');
    echo '<script>mostrarPopup("erro", "Validação reCAPTCHA falhou!");</script>';
    exit;

}
//recaptcha


$sql = "SELECT id_adm, adm_nome, email, telefone, senha, cnpj, funcao
        FROM adm
        WHERE email = ? AND funcao = 'ADM'
        LIMIT 1";


$query = $con->prepare($sql);
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();

if ($row = $result->fetch_assoc()) {
    if ($password === $row['senha']) {
        $_SESSION['id_adm'] = $row['id_adm'];
        $_SESSION['adm_nome'] = $row['adm_nome'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['telefone'] = $row['telefone'];
        $_SESSION['cnpj'] = $row['cnpj'];
        $_SESSION['funcao'] = $row['funcao'];
        $_SESSION['tipo_usuario'] = 'ADM';

        echo "<script>alert('Login realizado com sucesso!'); window.location.href='../../Controller/adm/pg_inicial_adm.php';</script>";
        exit;
    } else {
        echo "<script>alert('Senha incorreta!'); window.location.href='../../Controller/adm/login.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Administrador não encontrado!'); window.location.href='../../Controller/adm/login.php';</script>";
    exit;
}


?>