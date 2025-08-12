<!-- Maria Helena -->
<?php
include 'menu_pg_inicial.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Meu Perfil - Visualizar Dados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../../view/public/css/cliente/meu_perfil.css">
</head>

<body class="body-visualizar-dados">
  <main class="main-visualizar-dados">
    <h2 class="visualizar-dados-title">
      <a class="a-style" href="meu_perfil_senha.php">
        <i class="bi bi-chevron-left"></i> Meu Perfil
      </a>
    </h2>

    <div class="visualizar-dados-card">
      <div class="visualizar-dados-header">
        <div class="visualizar-dados-img-perfil-div">
          <i class="bi bi-person-circle"></i>
        </div>
        <div class="visualizar-dados-nome-email">
          <h4 class="visualizar-dados-nome">Fulano da Silva Soares</h4>
          <h5 class="visualizar-dados-email">sample123@gmail.com</h5>
        </div>
      </div>

      <div class="visualizar-dados-geral">
        <h3 class="visualizar-dados-geral-title">Meus Dados</h3>
        <div class="visualizar-dados-grid">
          <p><i class="bi bi-person"></i> <strong>Nome:</strong> Fulano da Silva Soares</p>
          <p><i class="bi bi-telephone"></i> <strong>Telefone:</strong> +55 67 XXXXX-XXXX</p>
          <p><i class="bi bi-envelope"></i> <strong>E-mail:</strong> sample123@gmail.com</p>
          <p><i class="bi bi-geo-alt"></i> <strong>Endereço:</strong> Rua General Exemplo do Exemplo, 24 - Bairro Exemplo, Campo Grande-MS</p>
          <p><i class="bi bi-calendar"></i> <strong>Data de Nascimento:</strong> XX/XX/XXXX</p>
        </div>
      </div>

      <div class="visualizar-dados-area-botoes">
        <a href="meu_perfil_senha.php">
          <button class="visualizar-dados-editar">Editar meus dados</button>
        </a>
        <a href="/Projeto_Integrador/controller/cliente/logout.php">
          <button class="visualizar-dados-logout">Logout</button>
        </a>
      </div>
    </div>
  </main>
</body>

</html>

<?php
include 'footer_cliente.php';
?>
