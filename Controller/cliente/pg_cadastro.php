<?php
session_start();
include 'menu_cadastro.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Rooster - Cadastro</title>
    <script defer src="../../view/js/cliente/cadastro.js"></script>
    <link rel="stylesheet" href="../../view/public/css/cliente/pg_cadastro.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="body-cadastro">
    <?php
    // Exibir pop-up de erro se houver
    if (isset($_SESSION['popup_type']) && $_SESSION['popup_type'] === 'erro' && isset($_SESSION['popup_message'])) {
        $texto = $_SESSION['popup_message'];
        include '../overlays/pop_up_erro.php';
        unset($_SESSION['popup_type']);
        unset($_SESSION['popup_message']);
    }
    
    // Exibir pop-up de sucesso se houver
    if (isset($_SESSION['popup_type']) && $_SESSION['popup_type'] === 'sucesso' && isset($_SESSION['popup_message'])) {
        $texto = $_SESSION['popup_message'];
        include '../overlays/pop_up_sucesso.php';
        unset($_SESSION['popup_type']);
        unset($_SESSION['popup_message']);
        unset($_SESSION['form_data']);
    }
    ?>

    <main class="main-cadastro">
        <div class="area-form-cadastro">
            <h2 class="titulo-form-cadastro">Cadastrar</h2>
            <div class="area-geral-form-cadastro">
                <form action="../utils/realiza_cadastro.php" method="POST" class="form-cadastro" id="myForm">

                    <div class="form-colunas-cadastro">
                        <div class="form-coluna-superior">
                            <input type="text" name="nome" placeholder="Nome Completo*" class="input-form-cadastro"
                                value="<?php echo isset($_SESSION['form_data']['nome']) ? htmlspecialchars($_SESSION['form_data']['nome']) : ''; ?>"
                                required>
                        </div>

                        <div class="form-coluna-inferior">
                            <div class="coluna-esquerda-cadastro">
                                <input type="text" name="cpf_cnpj" required placeholder="CPF/CNPJ*"
                                    class="input-form-cadastro" id="cpfCnpj"
                                    value="<?php echo isset($_SESSION['form_data']['cpf_cnpj']) ? htmlspecialchars($_SESSION['form_data']['cpf_cnpj']) : ''; ?>">

                                <input type="email" name="email" required class="input-form-cadastro"
                                    placeholder="Email*" id="emailInput"
                                    value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>">
                                <span class="span-required" id="emailError">Use o padrão email@empresa.com.br</span>

                                <input type="date" name="data_nascimento" required class="input-form-cadastro"
                                    placeholder="Data de Nascimento*" id="dataNasc"
                                    value="<?php echo isset($_SESSION['form_data']['data_nascimento']) ? htmlspecialchars($_SESSION['form_data']['data_nascimento']) : ''; ?>">
                            </div>

                            <div class="coluna-direita-cadastro">
                                <input type="text" name="telefone" required class="input-form-cadastro"
                                    placeholder="Telefone"
                                    value="<?php echo isset($_SESSION['form_data']['telefone']) ? htmlspecialchars($_SESSION['form_data']['telefone']) : ''; ?>">

                                <input type="password" name="senha" class="input-form-cadastro" placeholder="Senha*"
                                    id="senhaInput" required>
                                <span class="span-required" id="senhaLengthError"></span>

                                <input type="password" name="senha-confirmar" placeholder="Confirmar Senha*"
                                    class="input-form-cadastro" required id="senhaConfirmar">
                                <span class="span-required" id="senhaConfirmError"></span>
                            </div>
                        </div>
                        <div class="g-recaptcha" data-sitekey="6LdyqOUrAAAAAGCnu7xdDfJ4QovvUsJMRuOgUvOa"></div>
                    </div>

                    <div class="btn-submit-cadastro">
                        <?php
                            $texto = "Cadastrar";
                            include 'botao_verde_cliente.php';
                        ?>
                        <?php
                            $texto = "Cancelar";
                            include 'botao_vermelho_cliente.php';
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

    <script>
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>

            

            setTimeout(function() {
                window.location.href = 'login.php';
            }, 3000);
        <?php endif; ?>
    </script>

</body>
</html>

<?php include 'footer_cliente.php'; ?>