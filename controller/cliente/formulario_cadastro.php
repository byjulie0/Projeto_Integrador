<?php
    include 'menu_cadastro.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Rooster - Cadastro</title>
    <link rel="stylesheet" href="../view/public/css/cliente.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        .span-required{
            font-size: 0.8rem;
            display: none;
            color: red;
        }
    </style>
</head>
<body class="body-cadastro">
    <main class="main-cadastro">
        <a href="#" class="icon-voltar-cadastro"><i class="bi bi-chevron-left"></i></a>
        <div class="area-form-cadastro">
            <h2 class="titulo-form-cadastro">Cadastrar</h2>
            <div class="area-geral-form-cadastro">
                <form action="#" class="form-cadastro" id="formCadastro">
                    <div class="parte1-form-cadastro">
                        <input type="text" name="nome" required placeholder="Nome Completo*" class="input-form-cadastro">
                        <input type="date" name="data_nascimento" required class="input-form-cadastro" placeholder="Data de Nascimento*">
                        <input type="text" name="cpf_cnpj" required class="input-form-cadastro" placeholder="CPF/CNPJ*">
                        <input type="email" name="email" required class="input-form-cadastro required" placeholder="Email*">
                        <span class="span-required" id="emailError">O email deve ter o padrão email@empresa.com.br</span>
                        <input type="text" name="telefone" class="input-form-cadastro" placeholder="Telefone">
                        <input type="password" name="senha" required class="input-form-cadastro" placeholder="Senha*">
                        <span class="span-required" id="senhaError">A senha deve ter pelo menos 6 caracteres</span>
                    </div>
                </form>
                <div class="line-cadastro"></div>
                <div class="btn-submit-cadastro">
                    <input type="submit" value="Cadastrar" class="input-submit-form-cadastro" id="submitButton">
                </div>
            </div>
            <p class="area-termos-privacidade-cadastro">
                Ao se inscrever, você concorda com as políticas do John Rooster <a href="#" class="termos-privacidade-cadastro">Termos de serviço & Políticas de privacidade</a>
            </p>
            <p class="area-login-cadastro">
                Já tem uma conta? <a href="#" class="login-cadastro">Entre</a>
            </p>
        </div>
    </main>
</body>

<script>
    const email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const senha = 6;
    
    const form = document.getElementById('formCadastro');
    const submitButton = document.getElementById('submitButton');
    const emailInput = document.querySelector('input[name="email"]');
    const senhaInput = document.querySelector('input[name="senha"]');
    const cpfcnpjInput = document.querySelector('input[name="cpf_cnpj"]');
    
    function emailValidate() {
        const emailValue = emailInput.value;
        if (email.test(emailValue)) {
            document.getElementById('emailError').style.display = 'none';
            return true;
        } else {
            document.getElementById('emailError').style.display = 'block';
            return false;
        }
    }
    
    function senhaValidate() {
        const senhaValue = senhaInput.value;
        if (senhaValue.length >= senha) {
            document.getElementById('senhaError').style.display = 'none';
            return true;
        } else {
            document.getElementById('senhaError').style.display = 'block';
            return false;
        }
    }
    
    function validateForm(event) {
        const isEmailValid = emailValidate();
        const isSenhaValid = senhaValidate();

        if (!isEmailValid || !isSenhaValid) {
            event.preventDefault();
        }
    }
    
    form.addEventListener('submit', validateForm);

    emailInput.addEventListener('input', emailValidate);

    senhaInput.addEventListener('input', senhaValidate);
</script>

<?php
    include 'footer_cliente.php';
?>
</html>
