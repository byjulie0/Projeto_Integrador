<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Componente card Busca</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/card_busca.css">
</head>
<body>
    <div class="lote-card">
        <a href="detalhes_produto.php">
            <img src="<?php echo $imagem; ?>" alt="Imagem do Animal">
            <div class="info-grid">
                <p>Peso:</p>
                <p><?php echo $peso; ?></p>
                <p>Raça:</p>
                <p><?php echo $raca; ?></p>
                <p>Genealogia:</p>
                <p><?php echo $genealogia; ?></p>
                <p>Idade:</p>
                <p><?php echo $idade; ?></p>
                <p class="preco">R$ <?php echo $preco; ?></p>
            </div>
        </a>
    </div>
</body>
</html>

