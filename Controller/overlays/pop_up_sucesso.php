<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop Up Sucesso</title>
    <link rel="stylesheet" href="./../../view/public/css/adm/pop_up_sucesso.css">
    <script defer src="../../view/js/adm/pop_up_sucesso.js"></script>
</head>
<body>
<div id="popupSucesso" class="popup-overlay" style="display: flex;">
    <div class="popup-box">
        <h1>Sucesso!</h1>
        <button class="popup-close" id="fecharPopup">&times;</button>
        <p><?= $texto ?></p>
    </div>
</div>
</body>
</html>
