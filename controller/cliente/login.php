<?php 
include 'menu_login.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - John Rooster</title>
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
    <script src="../../view/JS/login_olho_ocultar_senha.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
</style>
</head>
<body>
    <main class="container_geral_login">
        <div class="login_box_vinycius">
            <div class="info_login_vinycius">
                <img class="img_login" src="../../view/public/imagens/logo_john_login.png" alt="John Rooster Logo">
                <p class="text_login_vinycius">
                    Aqui você encontra bovinos, galináceos, equinos e diversos produtos para o ramo agropecuário, tudo com qualidade e confiança para o seu negócio.
                </p>
            </div>

            <div class="login_form_vinycius">
                <h2>Login</h2>
                <form class="form_login" action="login.php" method="POST">
                    <input type="text" name="username" placeholder="Nome de usuário" class="input_login_vinycius1" required>
                    
                    <div class="senha_container">
                        <input type="password" name="password" id="senha" placeholder="Senha" class="input_login_vinycius2" required>
                        <span class="toggle_senha" onclick="toggleSenha()">
                            <i id="icone_senha" class="fa-solid fa-eye"></i>
                        </span>
                    </div>

                    <button type="button" class="button_vinycius" onclick="window.location.href='pg_inicial_cliente.php'">LOGIN</button>
                    <a href="card_email.php">Esqueci minha senha</a>
                    <span class="texto1">Não tem conta?<a href="pg_cadastro.php" class="texto1">Cadastre-se</a>
                </span>
                </form>
            </div>
        </div>
    </main>
    <?php include 'footer_cliente.php'; ?>

</body>
</html>