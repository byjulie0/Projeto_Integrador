<?php
include 'menu_adm.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Meus Dados</title>
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
</head>

<body>
    <main class="main">
        <div class="container">
            <h2 class="visualizar-dados-title"><a href="meu_perfil_senha.php"><i class="bi bi-chevron-left"></i></a>Editar meus dados</h2>

            <form class="edit-form">
                <div class="form-grid">
                    <!-- Primeira Coluna -->
                    <div class="form-column">
                        <div class="form-group">
                            <label for="name" class="form-label">Nome:</label>
                            <input type="text" id="adm_nome" class="form-input" placeholder="Administrador Jonh Rooster">
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="email" id="email" class="form-input" placeholder="jonhrooster@gmail.com">
                        </div>
                    </div>
                    
                    <!-- Segunda Coluna -->
                    <div class="form-column">
                        <div class="form-group">
                            <label for="phone" class="form-label">Telefone:</label>
                            <input type="tel" id="telefone" class="form-input" placeholder="+55 67 91234-5678">
                        </div>
                        
                        <div class="form-group">
                            <label for="cnpj" class="form-label">CNPJ:</label>
                            <input type="text" id="cnpj" class="form-input" placeholder="12.345.678/0001-95" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="formulario_altera_senha.php">
                        <button type="button" class="change-password-btn">Alterar senha</button>
                    </a>
                    <?php $texto = "Salvar"; include '../cliente/botao_cliente.php';?>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
<?php include 'footer_adm.php' ?>