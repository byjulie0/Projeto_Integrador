<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PopUp Estoque</title>
    <link rel="stylesheet" href="../../view/public/css/adm/pop_up_resultado.css">
</head>

<body>
    <div class="popup_resultado" style="display: flex;">
        <div class="area_popup_resultado">
            <h2 class="area_popup_resultado"><?php echo $titulo; ?>
            <p class="texto_pop_up">
                <?php echo htmlspecialchars($mensagem); ?>
            </p>
            <button class="fechar_popup_resultado" onclick="window.history.back(); return false;">&times;</button>
        </div>
    </div>
    </div>
</body>
</html>