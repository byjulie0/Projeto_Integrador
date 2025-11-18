<?php
include '../utils/autenticado_adm.php';

$sql = "SELECT * FROM adm WHERE id_adm = ?";
$query = $con->prepare($sql);
$query->bind_param("i", $_SESSION['id_adm']);
$query->execute();
$resultado = $query->get_result();
$adm_atual = $resultado->fetch_assoc();

if (!$adm_atual) {
  die("Cliente não encontrado!");
}

include 'menu_inicial.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - Visualizar Dados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../view/public/css/adm/meu_perfil.css">
</head>

<body class="body-visualizar-dados">
    <main class="main-visualizar-dados">
        <div class="visualizar-dados-card">

            <h2 class="visualizar-dados-title">
                <a class="a-style" href="#" onclick="window.history.back(); return false;">
                    <i class="bi bi-chevron-left"></i> Meu Perfil
                </a>
            </h2>

            <div class="visualizar-dados-header">
                <div class="visualizar-dados-img-perfil-div">
                    <i class="bi bi-person-circle"></i>
                </div>
                <div class="visualizar-dados-nome-email">
                    <h4 class="visualizar-dados-nome"><?= htmlspecialchars($adm_atual['adm_nome']); ?></h4>
                    <h5 class="visualizar-dados-email"><?= htmlspecialchars($adm_atual['email']); ?></h5>
                </div>
            </div>

            <div class="visualizar-dados-geral">
                <h3 class="visualizar-dados-geral-title">Meus Dados</h3>
                <div class="visualizar-dados-grid">
                    <p><span>Nome: </span><?= htmlspecialchars($adm_atual['adm_nome']); ?></p>
                    <p><span>Telefone: </span><?= htmlspecialchars($adm_atual['adm_nome']); ?></p>
                    <p><span>E-mail: </span><?= htmlspecialchars($adm_atual['email']); ?></p>
                    <p><span>CNPJ: </span><?= htmlspecialchars($adm_atual['cnpj']); ?></p>
                </div>
            </div>

            <div class="visualizar-dados-area-botoes">
                <a href="meu_perfil_editar.php">
                    <?php
                    $texto = "Editar meus dados";
                    include 'botao_verde_adm.php';
                    ?>
                </a>
                <a href="logout_adm.php">
                    <?php include 'botao_logout_adm.php'; ?>
                </a>
            </div>

        </div>
    </main>
</body>

</html>

<?php include 'footer.php'; ?>