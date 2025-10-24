<?php
// include '../utils/sessao_ativa_adm.php';
include '../utils/sessao_ativa_adm.php';
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

            <form class="client-edit-form">
                <div class="client-edit-header">
                    <h1 class="client-edit-title"><i class="bi bi-chevron-left"></i>Editar meus dados</h1>
                </div>

                <div class="client-edit-grid">
                    <div class="client-edit-column">
                        <div class="client-edit-field-group">
                            <label for="client-name" class="client-edit-label">Nome:</label>
                            <input type="text" id="client-name" class="client-edit-input" placeholder="Administrador Jonh Rooster">
                        </div>
                        
                        <div class="client-edit-field-group">
                            <label for="client-email" class="client-edit-label">E-mail:</label>
                            <input type="email" id="client-email" class="client-edit-input" placeholder="jonhrooster@gmail.com">
                        </div>
                    </div>
                    
                    <div class="client-edit-column">
                        <div class="client-edit-field-group">
                            <label for="client-phone" class="client-edit-label">Telefone:</label>
                            <input type="tel" id="client-phone" class="client-edit-input" placeholder="+55 67 91234-5678">
                        </div>
                        
                        <div class="client-edit-field-group">
                            <label for="client-cnpj" class="client-edit-label">CNPJ:</label>
                            <input type="text" id="client-cnpj" class="client-edit-input" placeholder="12.345.678/0001-95" readonly>
                        </div>
                    </div>
                </div>

                <div class="client-edit-actions">
                    <a href="formulario_altera_senha.php">
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