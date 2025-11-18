<?php
include '../utils/autenticado.php';
if ($usuario_nao_logado) {
  include '../overlays/pop_up_login.php';
  exit;
}

$sql = "SELECT * FROM cliente WHERE id_cliente = ?";
$query = $con->prepare($sql);
$query->bind_param("i", $_SESSION['id_cliente']);
$query->execute();
$resultado = $query->get_result();
$cliente_atual = $resultado->fetch_assoc();

if (!$cliente_atual) {
    die("Cliente não encontrado!");
}

include 'menu_pg_inicial.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Meus Dados</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/meu_perfil_editar.css">
</head>

<body>

    <?php if (isset($_GET['atualizado'])): ?>
        <div class="alert-success">Seus dados foram atualizados com sucesso!</div>
    <?php endif; ?>

    <main class="client-edit-main">
        <div class="client-edit-container">
            <form class="client-edit-form" method="POST" action="../utils/atualizar_cliente.php">

                <div class="client-edit-header">
                    <a href="#"><i class="bi bi-chevron-left"onclick="window.history.back(); return false;"></i></a>
                    <h1 class="client-edit-title-titulo">Editar meus dados</h1>
                </div>

                <input type="hidden" name="id_cliente" value="<?= $id_cliente ?>">
                <div class="client-edit-grid">
                    <div class="client-edit-column">
                        <div class="client-edit-field-group">
                            <label for="cliente_nome" class="client-edit-label">Nome:</label>
                            <input type="text" name="cliente_nome" class="client-edit-input"
                                value="<?= htmlspecialchars($cliente_atual['cliente_nome']); ?>">
                        </div>

                        <div class="client-edit-field-group">
                            <label for="telefone" class="client-edit-label">Telefone:</label>
                            <input type="tel" name="telefone" class="client-edit-input"
                                value="<?= htmlspecialchars($cliente_atual['telefone']); ?>">
                        </div>

                        <div class="client-edit-field-group">
                            <label for="email" class="client-edit-label">E-mail:</label>
                            <input type="email" name="email" class="client-edit-input"
                                value="<?= htmlspecialchars($cliente_atual['email']); ?>">
                        </div>
                    </div>

                    <div class="client-edit-column">
                        <div class="client-edit-field-group">
                            <label for="data_nasc" class="client-edit-label">Data de nascimento:</label>
                            <input type="text" name="data_nasc" class="client-edit-input"
                                value="<?= date('d/m/Y', strtotime($cliente_atual['data_nasc'])); ?>">
                        </div>
                    </div>
                </div>

                <div class="client-edit-warning">
                    <strong>Atenção:</strong> Sua idade só pode ser alterada 1 única vez...
                </div>

                <div class="client-edit-actions">
                    <a href="formulario_altera_senha.php">
                        <button type="button" class="client-edit-password-btn">Alterar senha</button>
                    </a>
                    <button type="submit" class="client-edit-password-btn">
                        <?php
                        $texto = "Salvar";
                        include 'botao_verde_cliente.php';
                        ?>
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>

<?php include 'footer_cliente.php'; ?>