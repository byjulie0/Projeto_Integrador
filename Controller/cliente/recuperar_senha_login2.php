<!-- Denyel -->
<?php
include 'menu_recuperar_senha.php';
?>
<?php
$email = htmlspecialchars($_GET['esqueci_senha_card_email_digitar']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/pg_recuperar_senha.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="recuperar_senha_codigo_body">

    <main class="recuperar_senha_codigo_main">
        <section class="recuperar_senha_codigo_section">
            <div class="recuperar_senha_codigo">
                <div class="recuperar_senha_codigo_content">
                    <h1>Código</h1>
                    <p>Insira o código de 6 digitos que lhe enviamos</p>
                    <form action="recuperar_senha_login3.php?email=<?php echo urlencode($email);?>" class="recuperar_senha_codigo_formulario">
                        <input type="text" inputmode="numeric" pattern="[A-aZ-z0-9]+" maxlength="8" required>
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
        </section>
    </main>

</body>

</html>

<?php
include 'footer_cliente.php';
?>