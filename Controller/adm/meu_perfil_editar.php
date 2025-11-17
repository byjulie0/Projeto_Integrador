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
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Meus Dados</title>
    <link rel="stylesheet" href="../../View/Public/css/adm/meu_perfil_editar.css">
</head>
<body>
    <main class="client-edit-main">
        <div class="client-edit-container">
            <form class="client-edit-form" method="POST" action="../utils/atualizar_adm.php">
                <div class="client-edit-header">
                    <h1 class="client-edit-title"><i class="bi bi-chevron-left"></i>Editar meus dados</h1>
                </div>

                <div class="client-edit-grid">
                    <div class="client-edit-column">

                        <div class="client-edit-field-group">
                            <label for="client-name" class="client-edit-label">Nome:</label>
                            <input 
                                type="text" 
                                id="client-name" 
                                name="adm_nome"
                                class="client-edit-input" 
                                value="<?= htmlspecialchars($adm_atual['adm_nome']); ?>"
                            >
                        </div>

                        <div class="client-edit-field-group">
                            <label for="client-email" class="client-edit-label">E-mail:</label>
                            <input 
                                type="email" 
                                id="client-email" 
                                name="email"
                                class="client-edit-input" 
                                value="<?= htmlspecialchars($adm_atual['email']); ?>"
                            >
                        </div>

                    </div>

                    <div class="client-edit-column">

                        <div class="client-edit-field-group">
                            <label for="client-phone" class="client-edit-label">Telefone:</label>
                            <input 
                                type="tel" 
                                id="client-phone" 
                                name="telefone"
                                class="client-edit-input" 
                                value="<?= htmlspecialchars($adm_atual['telefone']); ?>"
                            >
                        </div>

                        <div class="client-edit-field-group">
                            <label for="client-cnpj" class="client-edit-label">CNPJ:</label>
                            <input 
                                type="text" 
                                id="client-cnpj" 
                                name="cnpj"
                                class="client-edit-input" 
                                value="<?= htmlspecialchars($adm_atual['cnpj']); ?>" 
                                readonly
                            >
                        </div>

                    </div>
                </div>

                <div class="client-edit-actions">
                    <a href="../cliente/formulario_altera_senha.php">
                        <button type="button" class="client-edit-password-btn">Alterar senha</button>
                    </a>

                    <?php 
                        $texto = "Salvar"; 
                        include 'botao_verde_adm.php'; 
                    ?>
                </div>


            </form>

        </div>
    </main>
</body>
</html>

<?php include 'footer.php' ?>
