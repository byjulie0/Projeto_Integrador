<?php
include 'menu_recuperar_senha.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a senha</title>
    <link rel="stylesheet" href="/Projeto_Integrador/View/Public/css/cliente/pg_recuperar_senha.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="esqueci_senha_card_email_body">

    <main class="esqueci_senha_card_email_main">
        <section class="esqueci_senha_card_email_section">
            <div class="esqueci_senha_card_email">
                <div class="esqueci_senha_card_email_content">
                    <h1>Esqueceu a Senha</h1>
                    <p>Digite seu e-mail para enviarmos o código e gerar uma nova senha</p>
                    <form action="../utils/gerar_enviar_senha.php" class="esqueci_senha_card_email_formulario" method="POST">
                        <input type="email" name="esqueci_senha_card_email_digitar" placeholder="E-mail" required>
                        <div class="botoes_div">
                            <?php
                            $texto = "Enviar"; 
                            include 'botao_verde_cliente.php';
                            ?>
                            <a href="#" onclick="window.history.back(); return false;">
                            <?php
                            $texto = "Cancelar"; 
                            include 'botao_vermelho_cliente.php';
                            ?>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </section>
    </main>

</body>

</html>

<?php

include 'footer_cliente.php';

?>