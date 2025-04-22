<!-- Julie -->
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
<body class="esqueci_a_senha_popup">

    <main>
        <div class="esqueci_a_senha_popup_setinha">
            <a href="" class="esqueci_senha-card_popup_setinha_voltar">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>

        <div class="esqueci_senha_card_popup">
            <div class="esqueci_senha_popup_content">
                <h3 class="esqueci_senha_popup_texto">Senha redefinida com sucesso!</h3>
                <div class="esqueci_senha_popup_linha"></div>
                <button type="submit" class="esqueci_senha_popup_botao">Enviar</button>
            </div>
        </div>
    </main>

</body>
</html>

<?php

include 'footer_cliente.php';

?>