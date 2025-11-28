<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop Up Erro</title>
    <link rel="stylesheet" href="../../view/public/css/adm/pop_up_resultado.css">
    <script defer src="../../view/js/adm/pop_up.js"></script>
</head>
<body>
<div class="popup_resultado" style="display: flex;">
    <div class="area_popup_resultado">
        <h1 class="area_popup_resultado erro">Erro!</h1>
        <p class="texto_pop_up">
            <?php echo htmlspecialchars($texto); ?>
        </p>
        <button class="fechar_popup_resultado" onclick="window.history.back(); return false;">&times;</button>
    </div>
</body>
</html>