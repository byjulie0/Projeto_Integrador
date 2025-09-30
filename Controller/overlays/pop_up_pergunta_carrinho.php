<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PopUp Pergunta Carrinho </title>
    <link rel="stylesheet" href="../../View/Public/Css/cliente/pop_up_login.css">
</head>
<body>
    <div id="popup_login" class="login_popup">
        <div class="area_login_popup">
            <span class="fechar_login_popup">&times;</span>
            <h2 class="h2_popup_login">Remoção de item!</h2>
            <p>Tem certeza que deseja remover esse item do carrinho?</p>
            <div class="botoes_popup_login">
                <a href="login.php">
                    <?php 
                    $texto = "Remover"; 
                    include 'botao_cliente.php';
                    ?>
                </a>
                <a href="#" onclick="window.history.back(); return false;>
                    <?php include 'botao_cancelar.php'; ?>
                </a>
            </div>
        </div>
    </div>
</body>

</html>