<?php session_start(); include 'menu_cadastro.php';?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Rooster - Cadastro</title>
    <script defer src="../../view/js/cliente/cadastro.js"></script>
    <link rel="stylesheet" href="../../view/public/css/cliente/pg_cadastro.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>

<body class="body-cadastro">
    <main class="main-cadastro">
        <div class="area-form-cadastro">
            <h2 class="titulo-form-cadastro">Cadastrar</h2>
            <div class="area-geral-form-cadastro">

                <form action="realiza_cadastro.php" method="POST" class="form-cadastro" id="formCadastro">

                    <div class="form-colunas-cadastro">

                        <div class="form-coluna-superior">
                            <input type="text" name="nome" placeholder="Nome Completo*" class="input-form-cadastro" required>
                        </div>

                        <div class="form-coluna-inferior">
                            <div class="coluna-esquerda-cadastro">
                                <input type="text" name="cpf_cnpj" required placeholder="CPF/CNPJ*" class="input-form-cadastro">
                                
                                <input type="email" name="email" required class="input-form-cadastro" placeholder="Email*">
                                <span class="span-required" id="emailError">Use o padrão email@empresa.com.br</span>
                                
                                <input type="date" name="data_nascimento" required class="input-form-cadastro" required placeholder="Data de Nascimento*">
                            </div>

                            <div class="coluna-direita-cadastro">
                                <input type="text" name="telefone" required class="input-form-cadastro" placeholder="Telefone">
                                
                                <input type="password" name="senha" class="input-form-cadastro" placeholder="Senha*">
                                <span class="span-required" id="senhaLengthError"></span>

                                <input type="password" name="senha-confirmar" placeholder="Confirmar Senha*" class="input-form-cadastro" required>
                                <span class="span-required" id="senhaConfirmError"></span>
                            </div>
                        </div>
                    </div>

                    <div class="btn-submit-cadastro">
                        <?php
                        $texto = "Cadastrar";
                        include 'botao_cliente.php';
                        ?>
                        <?php
                        $texto = "Cancelar";
                        include 'botao_cancelar.php';
                        ?>
                    </div>
                </form>
              
            </div>

            <p class="area-termos-privacidade-cadastro">
                Ao se inscrever, você concorda com as políticas do John Rooster
                <a href="termos_e_condicoes.php" class="login-cadastro">Termos de serviço</a> &
                <a href="privacidade-e-seguranca.php" class="login-cadastro">Políticas de privacidade</a>
            </p>
            <p class="area-login-cadastro">
                Já tem uma conta? <a href="login.php" class="login-cadastro">Entre</a>
            </p>

        </div>
    </main>
</body>

</html>

<?php include 'footer_cliente.php'; ?>