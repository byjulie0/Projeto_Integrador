<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Componente card favoritos</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/card_favoritos.css">
</head>

<body>


    <div class="lote-card">
        <a href="detalhes_produto.php?id_produto=<?= $id_produto ?>">
            <img src="<?= $imagem ?>" alt="Imagem do Animal">
            <div class="info-grid">
                <p><?= $nome ?></p><br>
                <p>Peso:</p>
                <p><?= $peso ?></p>
                <p>Raça:</p>
                <p><?= $raca ?></p>
                <p>Idade:</p>
                <p><?= $idade ?></p>
                <p class="preco">R$ <?= $preco ?></p>
            </div>
            <div class="stars-pag-fav"><a href="../utils/favoritar.php?id_produto=<?php echo $id_produto; ?>">

                    <i class="fa-solid fa-heart red-heart"></i></a></div>
        </a>
    </div>

</body>

</html>