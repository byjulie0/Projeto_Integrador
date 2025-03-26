<!-- Denyel -->
<?php
include 'menu-pg-inicial.php';
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha</title>
    <link rel="stylesheet" href="..\view\public\css\cliente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="recuperar_senha_codigo-body">

    <main class="recuperar_senha_codigo-main">
        <div class="recuperar_senha_codigo-seta_voltar">
            <a href="" class="recuperar_senha_codigo-enchaminhar">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
        <div class="recuperar_senha_codigo">
            <div class="recuperar_senha_codigo-content">
                <h1>Código</h1>
                <h3>Insira o código de 6 digitos que lhe enviamos</h3>
                <form action="" class="recuperar_senha_codigo-formulario">
                    <input type="email" inputmode="numeric" pattern="[0-9]" maxlength="6" required>
                    <div class="recuperar_senha_codigo-linha_divisao"></div>
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