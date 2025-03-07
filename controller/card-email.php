<?php
include 'menu-pg-inicial.php';
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a senha</title>
    <link rel="stylesheet" href="..\view\public\css\card-email.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="esqueci_senha-card_email-body">

    <main>
        <div class="esqueci_senha-card_email-seta_voltar">
            <a href="" class="esqueci_senha-card_email-enchaminhar">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
        <div class="esqueci_senha-card_email">
            <div class="esqueci_senha-card_email-content">
                <h1>Esqueceu a Senha</h1>
                <h3>Digite seu e-mail para enviarmos o código e gerar uma nova senha</h3>
                <form action="" class="esqueci_senha-card_email-formulario">
                    <input type="email" name="esqueci_senha-card_email-digitar" type="submit" placeholder="E-mail">
                    <div class="esqueci_senha-card_email-linha_divisao"></div>
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