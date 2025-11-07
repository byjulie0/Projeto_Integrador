<?php
// include '../utils/sessao_ativa_adm.php';
include '../utils/sessao_ativa_adm.php';
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
<body>
    <main class="client-edit-main">
        <div class="client-edit-container">
            <div class="client-edit-header">
                <button class="client-edit-back-btn">
                    <a href="meu_perfil_senha.php" class="client-edit-back-link"><i class="bi bi-chevron-left"></i></a>
                </button>
                <h1 class="client-edit-title">Editar meus dados</h1>
            </div>

            <form class="client-edit-form" method="POST" action="../utils/atualizar_adm.php">
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
            </div>

            <div class="visualizar-dados-area-botoes">
                <a href="meu_perfil_editar.php">
                    <?php
                        $texto = "Salvar";
                        include 'botao_verde_adm.php';
                    ?>
                </a>
                <a href="login.php">
                    <?php include 'botao_logout_adm.php'; ?>
                </a>
            </div>

        </div>
    </div>
</div>
</main>
</body>

</html>

<?php include 'footer.php'; ?>



