<?php
include 'menu-pg-inicial.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARROSSEL</title>
    <link rel="stylesheet" href="../view/public/css/carrossel_pg_inicial-reserva.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="../view/public/Imagens/pecuaria.jpg" alt="First slide">
    
      <div class="carousel-caption d-none d-md-block">
        
        <h5 id="carousel_text">Somos um negócio familiar, com anos de experiência no ramo de vendas de animais pecuários, acumulando clientes ao redor de todo o mundo. Temos certeza de que aqui você achará exatamento o(s) animal(is) que procura!">
        </h5>
        <button class="btn">Saiba mais</button>
    </div>
    
    <div class="carousel-item">
      <img class="d-block w-100" src="../view/public/Imagens/pecuaria2.jpg" alt="Second slide">
    </div>

    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="../view/public/Imagens/pecuaria.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../view/public/Imagens/pecuaria2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Third slide">
    </div>
  </div>
</div> -->



    <!-- <div class="container">
        <div class="texto-carrosel-pg-inicial">
            <div class="texto2-img-carrossel-pg-inicial">
                <img src="../view/public/Imagens/pecuaria.jpg" alt="">
                <h1 class="texto2-carrossel-pg-inicial"><span class="span-carrossel-pg-ini"> Seja Bem-vindo ao nosso site! </span></h1> 
                <h2 class="h2-carrossel-pg-inicial">Somos um negócio familiar, com anos de experiência no ramo de vendas de animais pecuários, acumulando clientes ao redor de todo o mundo. Temos certeza de que aqui você achará exatamento o(s) animal(is) que procura!</h2>
            </div>
        </div>
        <button class="btn">Saiba mais</button>
        
    </div> -->

   

    <footer>
        <?php
        include 'footer_cliente.php';
        ?>
    </footer>
</body>
</html>