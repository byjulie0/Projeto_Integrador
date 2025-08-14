<?php include 'menu_pg_inicial.php';?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Meus Dados</title>
    <link rel="stylesheet" href="../../View/Public/css/cliente/meu_perfil_editar.css">
</head>

<body>
    <main class="client-edit-main">
        <div class="client-edit-container">
            <div class="client-edit-header">
                <h1 class="client-edit-title-titulo"><i class="bi bi-chevron-left" onclick="window.history.back(); return false;"></i>Editar meus dados</h1>
            </div>

            <form class="client-edit-form">
                <div class="client-edit-grid">
                    <div class="client-edit-column">
                        <div class="client-edit-field-group">
                            <label for="nome" class="client-edit-label">Nome:</label>
                            <input type="text" id="cliente_nome" class="client-edit-input" placeholder="Fulano da Silva Pinto Soares">
                        </div>

                        <div class="client-edit-field-group">
                            <label for="phone" class="client-edit-label">Telefone:</label>
                            <input type="tel" id="telefone" class="client-edit-input" placeholder="+55 67 XXXXX-XXXX">
                        </div>

                        <div class="client-edit-field-group">
                            <label for="email" class="client-edit-label">E-mail:</label>
                            <input type="email" id="email" class="client-edit-input" placeholder="sample123@gmail.com">
                        </div>
                    </div>

                    <div class="client-edit-column">
                        <div class="client-edit-field-group">
                            <label for="address" class="client-edit-label">Endereço:</label>
                            <input type="text" id="endereco" class="client-edit-input" placeholder="Rua General Exemplo do Exemplo, 24...">
                        </div>

                        <div class="client-edit-field-group">
                            <label for="birthdate" class="client-edit-label">Data de nascimento:</label>
                            <input type="text" id="data_nasc" class="client-edit-input" placeholder="XX/XX/XXXX">
                        </div>
                    </div>
                </div>

                <div class="client-edit-warning">
                    <strong>Atenção:</strong> Sua idade só pode ser alterada 1 única vez, caso seja detectado que o
                    usuário se registrou em nosso site antes da maioridade (18 anos, em território brasileiro) ou a
                    idade inserida seja menor que 18, sua conta será suspensa!
                </div>

                <div class="client-edit-actions">
                    <a href="formulario_altera_senha.php">
                        <button type="button" class="client-edit-password-btn">Alterar senha</button>
                    </a>
                    <?php
                    $texto = "Salvar";
                    include 'botao_cliente.php';
                    ?>
                </div>
            </form>
        </div>
    </main>
</body>

</html>

<?php include 'footer_cliente.php';?>