<!-- Lara -->
<?php
include 'menu_recuperar_senha.php';
?>
<?php
$email_recuperar_senha = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script defer src="../../View/js/pop_up_redefinir_senha.js"></script>
    <link rel="stylesheet" href="../../view/public/css/cliente/pg_recuperar_senha.css">
</head>

<body class="body_redefinir_senha_login">

    <section class="rede_senha_section">
        <a href="#" onclick="window.history.back(); return false;" class="recuperar_senha_codigo_seta_voltar">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <nav class="rede_senha_nav">
            <div class="recuperar_senha_rede_formulario">
                <h1>Redefinir senha</h1>
                <p>Escolha sua nova senha</p>
                <form action="../utils/recuperar_senha_action.php" class="form_rede_senha" id="formRedefinirSenha" method="POST">
                    <input type="hidden" name="email_recuperar_senha" value="<?php echo $email_recuperar_senha; ?>">
                    <input type="password" minlength="8" required placeholder="Nova senha" id="novaSenha">
                    <input type="password" minlength="8" required placeholder="Confirmar nova senha"
                        id="confirmarSenha">
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