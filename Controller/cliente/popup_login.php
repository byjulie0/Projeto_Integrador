<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PopUp Login</title>
    <link rel="stylesheet" href="../../View/Public/Css/cliente.css">
    <script defer src="../../view/js/pop_up_login.js"></script>
</head>

<body>
    <div id="popup_login" class="login_popup">
        <div class="area_login_popup">
            <span class="fechar_login_popup">&times;</span>
            <h2>Login necessário!</h2>
            <p>Você precisa estar logado para acessar esta funcionalidade</p>
            <div class="botoes_popup_login">
                <a href="login.php" class="botao_popup_login">Fazer Login</a>
                <button class="botao_popup_cancelar">Cancelar</button>
            </div>
        </div>
    </div>
</body>

</html>