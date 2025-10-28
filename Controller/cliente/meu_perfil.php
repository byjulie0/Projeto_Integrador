<?php
include '../utils/autenticado.php';

$sql = "SELECT * FROM cliente WHERE id_cliente = ?";
$query = $con->prepare($sql);
$query->bind_param("i", $_SESSION['id_cliente']);
$query->execute();
$resultado = $query->get_result();
$cliente_atual = $resultado->fetch_assoc();

if (!$cliente_atual) {
  die("Cliente não encontrado!");
}

include '../utils/libras.php';
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

        <div class="visualizar-dados-img-perfil">
          <svg class="avatar-icon" viewBox="0 0 24 24">
            <path
              d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
          </svg>
        </div>
        <div class="visualizar-dados-nome-email">
          <h4 class="visualizar-dados-nome"><?= htmlspecialchars($cliente_atual['cliente_nome']); ?></h4>
          <h5 class="visualizar-dados-email"><?= htmlspecialchars($cliente_atual['email']); ?></h5>
        </div>
      </div>

      <div class="visualizar-dados-geral">
        <h3 class="visualizar-dados-geral-title">Meus Dados</h3>
        <div class="visualizar-dados-grid">
          <p><strong>Nome: </strong> <?= htmlspecialchars($cliente_atual['cliente_nome']); ?></p>
          <p><strong>E-mail: </strong> <?= htmlspecialchars($cliente_atual['email']); ?></p>
          <p><strong>Telefone: </strong> <?= htmlspecialchars($cliente_atual['telefone']); ?></p>
          <p><strong>Data de Nascimento: </strong> <?= date('d/m/Y', strtotime($cliente_atual['data_nasc'])); ?></p>
        </div>
      </div>

      <div class="visualizar-dados-area-botoes">
        <a href="meu_perfil_senha.php">
          <?php
          $texto = "Editar meu dados";
          include 'botao_verde_cliente.php';
          ?>
        </a>
        
        <a href="logout.php">
          <?php include 'botao_logout.php'; ?>
        </a>

      </div>
    </div>
  </main>
</body>

</html>

<?php
include 'footer_cliente.php';
?>