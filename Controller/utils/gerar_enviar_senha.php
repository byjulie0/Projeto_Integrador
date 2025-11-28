<?php
// Conexão com o banco
include '../../model/DB/conexao.php';

// PHPMailer manual
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Acesso inválido!");
}


if (!isset($_POST['esqueci_senha_card_email_digitar']) || empty($_POST['esqueci_senha_card_email_digitar'])) {
    die("Erro: e-mail não informado.");
}

$emailUsuario = $_POST['esqueci_senha_card_email_digitar'];


$novaSenha = substr(md5(uniqid(rand(), true)), 0, 8);
$senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

$stmt = $con->prepare("UPDATE cliente SET senha = ? WHERE email = ?");
$stmt->bind_param("ss", $senhaHash, $emailUsuario);
$stmt->execute();

if ($stmt->affected_rows > 0) {

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'johnrooster.contato@gmail.com';      
        $mail->Password   = 'esrt lgbv flxl swti';        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('johnrooster.contato@gmail.com', 'Suporte');
        $mail->addAddress($emailUsuario);

        $mail->isHTML(true);
        $mail->Subject = 'Recuperacao de senha';
        $mail->Body    = "<h2>Recuperação de senha</h2>
                          <p>Sua nova senha temporária é: <b>$novaSenha</b></p>
                          <p>Altere a senha após o login.</p>";
        $mail->AltBody = "Sua nova senha temporária: $novaSenha";

        $mail->send();

        header("Location: ../cliente/login.php");
        exit();

    } catch (Exception $e) {
        header("Location: ../cliente/login.php");
        exit();
    }

} else {
    header("Location: ../cliente/login.php");
    exit();
}
