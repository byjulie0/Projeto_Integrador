<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PopUp Login</title>
    <link rel="stylesheet" href="../../View/Public/Css/cliente/pop_up_login.css">
</head>

<body>
    <div id="popup_login" class="login_popup">
        <div class="area_login_popup">
            <h2 class="h2_popup_login">Login necessário!</h2>
            <p>Você precisa estar logado para acessar esta funcionalidade.</p>
            <p>Deseja fazer o login?</p>
            <div class="botoes_popup_login">
                <a href="login.php">
                    <?php 
                    $texto = "Fazer Login"; 
                    include '../cliente/botao_verde_cliente.php';
                    ?>
                </a>
                <a href="#" onclick="window.history.back(); return false;">
                    <?php 
                    $texto = "Não"; 
                    include '../cliente/botao_vermelho_cliente.php'; 
                    ?>
                </a>
            </div>
        </div>
    </div>
</body>

</html>