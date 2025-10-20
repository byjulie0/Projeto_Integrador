<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Componente card Busca</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/card_telas.css">
</head>
<body>
    <div class="lote-card">
        <a href="detalhes_produto.php">
            <img src="<?php echo $imagem; ?>" alt="<?php $legenda?>">
            <div class="info-grid">
                <p>Nome:</p>
                <p><?= $nome ?></p>
                <!-- <p>Peso:</p>
                <p>echo $peso; ?></p>
                <p>Raça:</p>
                <p>echo $raca; ?></p>
                <p>Genealogia:</p>
                <p>echo $genealogia; ?></p>
                <p>Idade:</p>
                <p>echo $idade; ?></p> -->
                <p class="preco">R$ <?php echo $valor; ?></p>
            </div>
        </a>
    </div>
</body>
</html>

