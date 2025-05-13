<!-- Denyel -->
<?php
include 'menu_recuperar_senha.php';
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha</title>
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="recuperar_senha_codigo_body">

    <main class="recuperar_senha_codigo_main">
        <section class="recuperar_senha_codigo_section">
            <a href="card_email.php" class="recuperar_senha_codigo_seta_voltar">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <div class="recuperar_senha_codigo">
                <div class="recuperar_senha_codigo_content">
                    <h1>Código</h1>
                    <h3>Insira o código de 6 digitos que lhe enviamos</h3>
                    <form action="redefinir_senha_login.php" class="recuperar_senha_codigo_formulario">
                        <input type="text" inputmode="numeric" pattern="[A-aZ-z0-9]+" maxlength="8" required>
                        <div class="recuperar_senha_codigo_linha_divisao"></div>
                        <button type="submit">Enviar</button>
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