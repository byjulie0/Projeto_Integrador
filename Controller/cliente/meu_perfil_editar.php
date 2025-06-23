<?php
include 'menu_pg_inicial.php';
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
            <div class="page-header">
                <button class="back-btn">
                <a href="#" class="setinha_forms_mudar_senha">
                    <i class="fa-solid fa-chevron-left">
                    </i>
                </a>
                </button>
                <h1 class="page-title">Editar meus dados</h1>
            </div>

            <form class="edit-form">
                <div class="form-grid"> 
                    <div class="form-column">
                        <div class="form-group">
                            <label for="name" class="form-label">Nome:</label>
                            <input type="text" id="name" class="form-input" value="Fulano da Silva Pinto Soares">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Telefone:</label>
                            <input type="tel" id="phone" class="form-input" placeholder="+55 67 XXXXX-XXXX">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="email" id="email" class="form-input" placeholder="sample123@gmail.com">
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="form-group">
                            <label for="address" class="form-label">Endereço:</label>
                            <input type="text" id="address" class="form-input" placeholder="Rua General Exemplo do Exemplo, 24...">
                        </div>

                        <div class="form-group">
                            <label for="birthdate" class="form-label">Data de nascimento:</label>
                            <input type="text" id="birthdate" class="form-input" placeholder="XX/XX/XXXX">
                        </div>
                    </div>
                </div>

                <div class="warning-text">
                    <strong>Atenção:</strong> Sua idade só pode ser alterada 1 única vez, caso seja detectado que o usuário se registrou em nosso site antes da maioridade (18 anos, em território brasileiro) ou a idade inserida seja menor que 18, sua conta será suspensa!
                </div>

                <div class="form-actions">
                    <button type="button" class="change-password-btn">Alterar senha</button>
                    <button type="submit" class="save-btn">Salvar</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
<?php
        include 'footer_cliente.php';
        ?>