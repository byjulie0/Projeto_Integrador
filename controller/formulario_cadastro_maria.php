<!-- MARIA HELENA -->
<?php
    include 'menu_cadastro_maria.php';
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
</head>
<body class="body-cadastro">
    <main class="main-cadastro">
        <a href="#" class="icon-voltar-cadastro"><i class="bi bi-chevron-left"></i></a>
        <div class="area-form-cadastro">
            <h2 class="titulo-form-cadastro">Cadastrar</h2>
            <div class="area-geral-form-cadastro">
                <form action="#" class="form-cadastro">
                    <div class="parte1-form-cadastro">
                        <input type="text" name = "nome" required placeholder="Nome Completo*" class="input-form-cadastro">
                        <input type="date" name = "data_nascimento" required class="input-form-cadastro" placeholder="Data de Nascimento*">
                        <input type="text" name = "cpf_cnpj" required class="input-form-cadastro" placeholder="CPF/CNPJ*">
                        <input type="email" name = "telefone" required placeholder="Email*" class="input-form-cadastro">
                        <input type="text" placeholder="Telefone" class="input-form-cadastro">
                        <input type="password" name = "senha" required placeholder="Senha*" class="input-form-cadastro">
                    </div>
                </form>
                <div class="line-cadastro"></div>
                <div class="btn-submit-cadastro">
                    <input type="submit" value="Cadastrar" class="input-submit-form-cadastro">
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
    <script>
    function validarFormulario(event) {
        let nome = document.querySelector('input[type="text"]:nth-of-type(1)');
        let dataNascimento = document.querySelector('input[type="date"]');
        let cpfCnpj = document.querySelector('input[type="text"]:nth-of-type(3)');
        let email = document.querySelector('input[type="email"]');
        let senha = document.querySelector('input[type="password"]');
        
        if (nome.value.trim() === '') {
            alert('Por favor, preencha o campo "Nome Completo".');
            nome.focus();
            event.preventDefault();
            return false;
        }

        if (dataNascimento.value === '') {
            alert('Por favor, preencha a data de nascimento.');
            dataNascimento.focus();
            event.preventDefault();
            return false;
        }

        if (cpfCnpj.value.trim() === '') {
            alert('Por favor, preencha o campo "CPF/CNPJ".');
            cpfCnpj.focus();
            event.preventDefault();
            return false;
        }

        // Validar o email
        if (email.value.trim() === '') {
            alert('Por favor, preencha o campo "Email".');
            email.focus();
            event.preventDefault();
            return false;
        }

        // Validar a senha
        if (senha.value.trim() === '') {
            alert('Por favor, preencha o campo "Senha".');
            senha.focus();
            event.preventDefault();
            return false;
        }

        return true;
    }

    // Adicionando o evento de validação no envio do formulário
    document.querySelector('.form-cadastro').addEventListener('submit', validarFormulario);
    </script>
</body>

</html>

<?php
    include 'footer_cliente.php';
?>