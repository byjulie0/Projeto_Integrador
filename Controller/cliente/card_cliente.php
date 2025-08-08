<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Card animais</title>
  <link rel="stylesheet" href="../../view/public/css/cliente/card_produtos.css">
</head>
<body>

  <div class="card_cliente card-mais-vendidos card-cat-math">
    <img src="<?= $imagem ?>" alt="Imagem do produto" />

    <div class="card_info_grid">
      <p>Peso:</p>
      <p><?= $peso ?></p>

      <p>Raça:</p>
      <p><?= $raca ?></p>

      <p>Genealogia:</p>
      <p><?= $genealogia ?></p>

      <p>Idade:</p>
      <p><?= $idade ?></p>
    </div>

  </div>

</body>

</html>
