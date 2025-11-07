<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CARROSSEL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div id="meuCarrossel" class="carousel slide" data-bs-ride="carousel">
    <!-- Indicadores (bolinhas) -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#meuCarrossel" data-bs-slide-to="0" class="active" aria-current="true"
        aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#meuCarrossel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#meuCarrossel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../../view/public/imagens/img_carrossel_pg_inicial/cavlos_carrosel.png" class="d-block w-100"
          alt="Slide 1">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="texto_carrossel">Seja bem-vindo(a)
            <?php if($usuarioLogado) echo $_SESSION["cliente_nome"]; else echo "ao nosso site!";?></h5>
          <p>Somos um negócio familiar, com anos de experiência no ramo de vendas de animais pecuários, acumulando
            clientes ao redor de todo o mundo. Temos certeza de que aqui você achará exatamento o(s) animal(is) que
            procura!</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../../view/public/imagens/img_carrossel_pg_inicial/galo_carrosel.png" class="d-block w-100"
          alt="Slide 2">
        <div class="carousel-caption d-none d-md-block">
            <h5 class="texto_carrossel">Seja bem-vindo(a)
            <?php if($usuarioLogado) echo $_SESSION["cliente_nome"]; else echo "ao nosso site!";?></h5>
          <p>Somos um negócio familiar, com anos de experiência no ramo de vendas de animais pecuários, acumulando
            clientes ao redor de todo o mundo. Temos certeza de que aqui você achará exatamento o(s) animal(is) que
            procura!</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../../view/public/imagens/img_carrossel_pg_inicial/img_carrossel_pecuaria.svg" class="d-block w-100"
          alt="Slide 3">
        <div class="carousel-caption d-none d-md-block">
            <h5 class="texto_carrossel">Seja bem-vindo(a)
            <?php if($usuarioLogado) echo $_SESSION["cliente_nome"]; else echo "ao nosso site!";?></h5>
          <p>Somos um negócio familiar, com anos de experiência no ramo de vendas de animais pecuários, acumulando
            clientes ao redor de todo o mundo. Temos certeza de que aqui você achará exatamento o(s) animal(is) que
            procura!</p>
        </div>
      </div>
    </div>



    <!-- Controles (setas) -->
    <button class="carousel-control-prev carousel-dark " type="button" data-bs-target="#meuCarrossel"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#meuCarrossel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Próximo</span>
    </button>
  </div>

</body>

</html>