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
    <script defer src="../../View/js/pop_up_redefinir_senha.js"></script>
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
</head>

<body class="body_redefinir_senha_login">

    <section class="rede_senha_section">
        <a href="recuperar_senha_codigo.php" class="recuperar_senha_codigo_seta_voltar">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <nav class="rede_senha_nav">
            <div class="recuperar_senha_rede_formulario">
                <h1>Redefinir senha</h1>
                <h3>Escolha sua nova senha</h3>
                <form action="" class="form_rede_senha" id="formRedefinirSenha">
                    <input type="password" minlength="8" required placeholder="Nova senha" id="novaSenha">
                    <input type="password" minlength="8" required placeholder="Confirmar nova senha"
                        id="confirmarSenha">
                    <?php
                    $texto = "Enviar"; // Defina o texto do botão aqui
                    include 'botao_cliente.php';
                    ?>
                </form>
            </div>
        </nav>
    </section>

    <div class="popup-overlay" id="popupSucesso">
        <div class="popup-content">
            <h3 class="popup-text">Senha redefinida com sucesso!</h3>
            <button class="popup-button" id="btnLogin">Login</button>
        </div>
    </div>

</body>

</html>

<?php
include 'footer_cliente.php';
?>