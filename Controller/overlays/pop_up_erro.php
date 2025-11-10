<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop Up Erro</title>
    <link rel="stylesheet" href="./../../view/public/css/adm/pop_up.css">
    <script defer src="../../view/js/adm/pop_up.js"></script>
</head>
<body>
<div id="popupSucesso" class="popup-overlay" style="display: flex;">
    <div class="popup-box">
        <h1>Erro!</h1>
        <button class="popup-close" onclick="window.history.back(); return false;">&times;</button>
        <p><?= $texto ?></p>
    </div>
</div>
</body>
</html>
