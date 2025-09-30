
<?php
include '../../Controller/utils/validacao_login.php';
include '../../model/DB/conexao.php';
include 'menu_pg_inicial.php';

$email_user = $_SESSION['email'];


try {
    $stmt = $con->prepare("SELECT cliente_nome, email, telefone, cidade, data_nasc FROM cliente WHERE email = ?");
    $stmt->bind_param("s", $email_user);
    $stmt->execute();

    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();


    if (!$email_user) {
        die('Usuário não encontrado.');
    }
  }
catch (PDOException $e) {
  echo "Erro ao buscar dados do usuário: " . $e->getMessage();
}

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
              <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
          </svg>
        </div>cliente_nome

        <div class="visualizar-dados-nome-email">
          <h4 class="visualizar-dados-nome"><?= htmlspecialchars($usuario['cliente_nome']); ?></h4>
          <h5 class="visualizar-dados-email"><?= htmlspecialchars($usuario['email']); ?></h5>
        </div>
      </div>

      <div class="visualizar-dados-geral">
        <h3 class="visualizar-dados-geral-title">Meus Dados</h3>
        <div class="visualizar-dados-grid">
          <p><strong>Nome: </strong> <?= htmlspecialchars($usuario['cliente_nome']); ?></p>
          <p><strong>Telefone: </strong> <?= htmlspecialchars($usuario['telefone']); ?></p>
          <p><strong>E-mail: </strong> <?= htmlspecialchars($usuario['email']); ?></p>
          <p><strong>Endereço: </strong> <?= htmlspecialchars($usuario['cidade']); ?></p>
          <p><strong>Data de Nascimento: </strong> <?= date('d/m/Y', strtotime($usuario['data_nasc'])); ?></p>
        </div>
      </div>

      <div class="visualizar-dados-area-botoes">
        <a href="meu_perfil_senha.php">
          <?php
            $texto = "Editar meu dados";
            include 'botao_cliente.php';
            ?>
        </a>
        <a href="/Projeto_Integrador/controller/cliente/logout.php">
        <a href="../cliente/logout.php">
          <?php include 'botao_logout.php';?>
        </a>
        
        </a>
      </div>
    </div>
  </main>
</body>

</html>

<?php
  include 'footer_cliente.php';
?>
 
