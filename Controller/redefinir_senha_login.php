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
    <link rel="stylesheet" href="..\view\public\css\cliente.css">
</head>
<body class="recuperar_senha_codigo_body">

    <section class="rede_senha_section ">
        <a href="recuperar_senha_codigo.php" class="recuperar_senha_codigo_seta_voltar">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <nav class="rede_senha_nav">
            <div class="rede_senha_container">
                <h1 class="h1_rede_senha">Redefinir senha</h1>

                <h3 class="h3_rede_senha">Escolha sua nova senha </h3>
                <form action="" class="form_rede_senha">

                    <input class="inputsenha1" type="password" inputmode="numeric" pattern="[0-9]" maxlength="8" required placeholder="Nova senha">

                    <input class="inputsenha2" type="password" inputmode="numeric" pattern="[0-9]" maxlength="8" required placeholder="Confirmar nova senha">
                    
                    <div class="rede_senha_linha"></div>

                    <button type="submit">Redefinir</button>
                </form>
            </div>
        </nav>

    </section>

</body>
</html>

<?php
include 'footer_cliente.php';
?>