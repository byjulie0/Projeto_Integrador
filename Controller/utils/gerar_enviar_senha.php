<?php
require '../../model/composer/vendor/autoload.php';
include '../../model/DB/conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$emailUsuario = $_POST["esqueci_senha_card_email_digitar"];

$novaSenha = substr(md5(uniqid(rand(), true)), 0, 8);     

$stmt_test=$con->prepare("SELECT * FROM adm WHERE email = ?");
$stmt_test->bind_param("s",$emailUsuario);
$stmt_test->execute();
$stmt_test->store_result();
$num_linhas = $stmt_test->num_rows;

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

if ($num_linhas > 0) {


    $stmt_adm = $con->prepare("UPDATE adm SET senha = ? WHERE email = ?");
    $stmt_adm->bind_param("ss", $senha_hash, $emailUsuario);
    $stmt_adm->execute();


} else {


    $stmt_cli = $con->prepare("UPDATE cliente SET senha = ? WHERE email = ?");
    $stmt_cli->bind_param("ss", $senha_hash, $emailUsuario);
    $stmt_cli->execute();


}
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
    $mail->Subject = 'Sua senha temporaria';
    $mail->Body = "
        <h2>Recuperação de Acesso</h2>
        <p>Uma nova senha temporária foi gerada para sua conta:</p>
        <p><b style='font-size:18px;'>$novaSenha</b></p>
        <p>Por segurança, altere sua senha ao fazer login.</p>
    ";
    $mail->AltBody = "Olá, Uma nova senha temporária foi gerada para sua conta: $novaSenha";
    $mail->send();

    header("Location: ../cliente/recuperar_senha_login1.php?status=sucesso");
    exit();

} catch (Exception $e) {
    // echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    header("Location: ../cliente/recuperar_senha_login1.php?status=erro");
    exit();
}
