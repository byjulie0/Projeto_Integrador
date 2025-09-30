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
    <link rel="stylesheet" href="/Projeto_Integrador/view/public/css/cliente/pg_recuperar_senha.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="esqueci_senha_card_email_body">

    <main class="esqueci_senha_card_email_main">
        <section class="esqueci_senha_card_email_section">
            <a href="#" onclick="window.history.back(); return false;" class="esqueci_senha_card_email_seta_voltar">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <div class="esqueci_senha_card_email">
                <div class="esqueci_senha_card_email_content">
                    <h1>Esqueceu a Senha</h1>
                    <h3>Digite seu e-mail para enviarmos o código e gerar uma nova senha</h3>
                    <form action="recuperar_senha_login2.php" class="esqueci_senha_card_email_formulario" method="GET">
                        <input type="email" name="esqueci_senha_card_email_digitar" placeholder="E-mail" required>
                        <?php
                        $texto = "Enviar"; 
                        include 'botao_cliente.php';
                        ?>
                    </form>
                </div>
            </div>
        </section>
    </main>

</body>
</html>

<?php

include 'footer_cliente.php';

?>