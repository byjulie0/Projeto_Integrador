<!-- Lara -->
<?php
include 'menu_recuperar_senha.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="..\View\public\css\cliente.css">
    <link rel="stylesheet" href="View\js\pop_up_redefinir_senha.js">
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
</head>
<body class="recuperar_senha_codigo_body">

    <section class="rede_senha_section">
        <a href="recuperar_senha_codigo.php" class="recuperar_senha_codigo_seta_voltar">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <nav class="rede_senha_nav">
            <div class="recuperar_senha_rede_formulario">
                <h1>Redefinir senha</h1>
                <h3>Escolha sua nova senha </h3>
                <form action="" class="form_rede_senha" id="formRedefinirSenha">
                    <input type="password" pattern="[A-Za-z0-9@#$%&*]" minlength="8" required placeholder="Nova senha" id="novaSenha">
                    <input type="password" pattern="[A-Za-z0-9@#$%&*]" minlength="8" required placeholder="Confirmar nova senha" id="confirmarSenha">
                    <hr class="linha_login">
                    <button type="submit" id="btnEnviar">Enviar</button>
                </form>
            </div>
        </nav>
    </section>

    <!-- Popup de sucesso -->
    <div class="popup-overlay" id="popupSucesso">
        <div class="popup-content">
            <h3 class="popup-text">Senha redefinida com sucesso!</h3>
            <hr class="popup-line">
            <button class="popup-button" id="btnLogin">Login</button>
        </div>
    </div>

</body>
</html>

<?php
include 'footer_cliente.php';
?>