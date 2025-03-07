<?php
include '../controller/menu-pg-inicial.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../view/public/css/cliente.css">
</head>
<body>
    <div class="container">
        <div class="info">
            <img src="../view/public/imagens/logo_john_rooster.png" alt="John Rooster Logo">
            <p>Aqui você encontra bovinos, galináceos, equinos e diversos produtos para o ramo agropecuário, tudo com qualidade e confiança para o seu negócio.</p>
        </div>
        <div class="login-form">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Nome do usuário/Email" class="input-small" required>
                <input type="password" name="password" placeholder="Senha" class="input-small" required>
                <button type="submit" class="button-small">LOGIN</button>
                <a href="#">Esqueci minha senha</a><br>
                
                <a href="#">Não tem conta? Cadastre-se</a>
            </form>
        </div>
    </div>
    <footer>
    <?php
        include '../controller/footer_cliente.php';
    ?>
    </footer>
</body>
</html>