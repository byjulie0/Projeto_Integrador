<?php
require '../../model/composer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$emailUsuario = 'usuario@exemplo.com';

$novaSenha = substr(md5(uniqid(rand(), true)), 0, 8);     

$stmt = $con->prepare("UPDATE cliente SET senha = ? WHERE email = ?");
$stmt->bind_param("ss", $novaSenha, $emailUsuario);
$stmt->execute();


$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // por onde o email sera enviado EX:(smtp.outlook.com, smtp.mail.yahoo.com)
    $mail->SMTPAuth = true;
    $mail->Username = 'email_origem@gmail.com'; //E-mail do remetente
    $mail->Password = 'SUA_APP_PASSWORD'; // senha gerada através de https://myaccount.google.com/apppasswords
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;


    $mail->setFrom('email_origem@gmail.com', 'John Rooster security'); // 1-email remetente, 2-nome que aparecera ao lado do email
    $mail->addAddress($emailUsuario); // email destinatario


    $mail->isHTML(true);
    $mail->Subject = 'Sua senha temporária';
    $mail->Body = "
        <h2>Recuperação de Acesso</h2>
        <p>Uma nova senha temporária foi gerada para sua conta:</p>
        <p><b style='font-size:18px;'>$senhaTemporaria</b></p>
        <p>Por segurança, altere sua senha ao fazer login.</p>
    ";
    $mail->AltBody = "Olá, Uma nova senha temporária foi gerada para sua conta: $senhaTemporaria";


    $mail->send();
    echo 'Senha temporária enviada com sucesso!';
} catch (Exception $e) {
    echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
}