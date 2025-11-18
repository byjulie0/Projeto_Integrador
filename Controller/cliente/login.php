<?php
include 'menu_login.php';
include '../utils/libras.php'
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - John Rooster </title>
  <script src="../../view/js/cliente/login_olho_ocultar_senha.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link rel="stylesheet" href="../../view/public/css/cliente/pg_login.css">
</head>

<body>
  <main class="container_geral_login">

    <div class="login_box_vinycius">
      <div class="info_login_vinycius">
         <a href="pg_inicial_cliente.php"><img class="img_login" src="../../view/public/imagens/logo_john_login.png" alt="John Rooster Logo" ></a>
        <p class="text_login_vinycius">
          Aqui você encontra bovinos, galináceos, equinos e diversos produtos para o ramo agropecuário, tudo
          com qualidade e confiança para o seu negócio.
        </p>
      </div>

      <div class="login_form_vinycius">
        <h2>Login</h2>
        <form class="form_login" action="../utils/sessao_ativa.php" method="POST" id="myForm">

          <input type="text" name="email" placeholder="E-mail" class="input_login_vinycius1" required>
          <div class="senha_container">
            <input type="password" name="password" id="senha" placeholder="Senha" class="input_login_vinycius2"
              required>
            <span class="toggle_senha" onclick="toggleSenha()">
              <i id="icone_senha" class="fa-solid fa-eye"></i>
            </span>
          </div>
          <div class="g-recaptcha" data-sitekey="6LdyqOUrAAAAAGCnu7xdDfJ4QovvUsJMRuOgUvOa" ></div>

          <div class="btn-submit-login">
            <?php
            $texto = "Login";
            include '../cliente/botao_verde_cliente.php';
            ?>
          </div>

          <?php if (isset($erro))
            echo '<p style="color:red;">' . $erro . '</p>'; ?>

          <div class="info-login">
            <a href="recuperar_senha.php" class="esqueci_senha_login">Esqueci minha senha</a>
            <div class="texto1-span">Não tem conta? <a href="pg_cadastro.php">Cadastre-se</a></div>
            <a class="login-adm" href="../adm/login.php">Área administrativa</a>
          </div>
        </form>
      </div>

    </div>
  </main>
  <?php include 'footer_cliente.php'; ?>
</body>

</html>