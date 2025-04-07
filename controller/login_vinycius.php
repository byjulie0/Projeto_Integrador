<?php 
include '../controller/cabecalho-vinycius.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - John Rooster</title>
    <link rel="stylesheet" href="../view/public/css/cabecalho.css">
    <link rel="stylesheet" href="../view/public/css/login.css">
</head>
<body>
    <main class="container-geral-login">
        <div class="login-box-vinycius">
            <div class="info-login-vinycius">
                <img class="img-login" src="../view/public/imagens/logo_john_login.png" alt="John Rooster Logo">
                <p class="text-login-vinycius">
                    Aqui você encontra bovinos, galináceos, equinos e diversos produtos para o ramo agropecuário, tudo com qualidade e confiança para o seu negócio.
                </p>
            </div>

            <div class="login-form-vinycius">
                <h2>Login</h2>
                <form action="login.php" method="POST">
                    <input type="text" name="username" placeholder="Nome do usuário/Email" class="input-login-vinycius" required>
                    <input type="password" name="password" placeholder="Senha" class="input-login-vinycius" required>
                    <button type="submit" class="button-vinycius">LOGIN</button>
                    <a href="#">Esqueci minha senha</a><br>
                    <a href="#">Não tem conta? Cadastre-se</a>
                </form>
            </div>
        </div>
    </main>
   
        <?php
        include '../controller/footer_cliente.php'
        ?>
    
</body>
</html>
