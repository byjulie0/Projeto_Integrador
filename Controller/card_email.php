<!-- Denyel -->
<?php
include 'menu_recuperar_senha.php';
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a senha</title>
    <link rel="stylesheet" href="..\view\public\css\cliente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="esqueci_senha_card_email_body">

    <main class="esqueci_senha_card_email_main">
        <a href="login.php" class="esqueci_senha_card_email_seta_voltar">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <div class="esqueci_senha_card_email">
            <div class="esqueci_senha_card_email_content">
                <h1>Esqueceu a Senha</h1>
                <h3>Digite seu e-mail para enviarmos o código e gerar uma nova senha</h3>
                <form action="" class="esqueci_senha_card_email_formulario">
                    <input type="email" name="esqueci_senha_card_email_digitar" type="submit" placeholder="E-mail" required>
                    <div class="esqueci_senha_card_email_linha_divisao"></div>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </main>

</body>
</html>

<?php

include 'footer_cliente.php';

?>