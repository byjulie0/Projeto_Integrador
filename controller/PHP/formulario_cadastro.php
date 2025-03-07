<?php
    include 'menu_cadastro_maria.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Rooster - Cadastro</title>
    <link rel="stylesheet" href="../../view/public/css/formulario_cadastro.css">
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
                        <input type="text" required placeholder="Nome Completo*" class="input-form-cadastro">
                        <input type="date" required class="input-form-cadastro" placeholder="Data de Nascimento*">
                        <input type="email" required placeholder="Email*" class="input-form-cadastro">
                        <input type="text" placeholder="Telefone" class="input-form-cadastro">
                        <input type="text" required placeholder="Bairro*" class="input-form-cadastro">
                    </div>
                    <div class="parte2-form-cadastro">
                        <input type="text" required placeholder="Rua*" class="input-form-cadastro">
                        <input type="text" required placeholder="Número*" class="input-form-cadastro">
                        <input type="text" required placeholder="CEP*" class="input-form-cadastro">
                        <input type="text" required placeholder="País*" class="input-form-cadastro">
                        <input type="submit" value="Cadastrar" class="input-submit-form-cadastro">
                    </div>
                </form>
                <div class="line-cadastro"></div>
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
</html>

<?php include 'footer_cliente.php'; ?>