<?php include '../cliente/menu_login.php';?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - John Rooster</title>
    <link rel="stylesheet" href="../../view/public/css/adm/login.css">
    <script src="../../view/js/cliente/login_olho_ocultar_senha.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <main class="container_geral_login_adm">
        <div class="login_area">
            <div class="info_login_adm">
                <img class="img_login" src="../../view/public/imagens/logo_john_login.png" alt="John Rooster Logo">
                <p class="text_login_adm">
                    Aqui você encontra bovinos, galináceos, equinos e diversos produtos para o ramo agropecuário, tudo
                    com qualidade e confiança para o seu negócio.
                </p>
            </div>

            <div class="login_form_adm">
                <h2>Login</h2>
                <form class="form_login" action="../../Controller/utils/valida_login_adm.php" method="POST">
                    <input type="email" name="email" placeholder="E-mail do ADM" class="input_login_adm1" required>

                    <div class="senha_container">
                        <input type="password" name="password" id="senha" placeholder="Senha" class="input_login_adm2" required>
                        <span class="toggle_senha" onclick="toggleSenha()">
                            <i id="icone_senha" class="fa-solid fa-eye"></i>
                        </span>
                    </div>

                    <button type="submit" class="button_adm">LOGIN</button>

                    <a href="../cliente/recuperar_senha_login1.php">Esqueci minha senha</a>
                    <a href="../cliente/login.php">Área do cliente</a>
                </form>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
<<<<<<< HEAD
</html>
=======

</html>
>>>>>>> cd885a5c4a6c18392fb60c8d1c908b0b579f3a2b
