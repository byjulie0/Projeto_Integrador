<?php
//nclude '/Projeto_Integrador/controller/menu-pg-inicial.php';
?>

<!-- index.html -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Percheron Carrossel</title>
    <link rel="stylesheet" href="cat.css">
    
</head>
<body>
    <?php
     include "../../../controller/menu-pg-inicial.php"

   ?>
    <h1>Percheron</h1>
    <div class="carousel">
        <div class="arrow" onclick="prevSlide()">&#10094;</div>
        <div class="cards" id="carousel-cards">
            <div class="card"><img src="../Imagens/cavalo.jpg" alt="Horse 1"><p>Peso: </p><p>Raça: </p><p>Genealogia: </p><p>Idade: </p><p class="price">R$00,00</p><a href="#" class="btn">Comprar</a></div>
            <div class="card"><img src="../Imagens/cavalo.jpg" alt="Horse 2"><p>Peso: </p><p>Raça: </p><p>Genealogia: </p><p>Idade: </p><p class="price">R$00,00</p><a href="#" class="btn">Comprar</a></div>
            <div class="card"><img src="../Imagens/cavalo.jpg" alt="Horse 3"><p>Peso: </p><p>Raça: </p><p>Genealogia: </p><p>Idade: </p><p class="price">R$00,00</p><a href="#" class="btn">Comprar</a></div>
            <div class="card"><img src="../Imagens/cavalo.jpg" alt="Horse 4"><p>Peso: </p><p>Raça: </p><p>Genealogia: </p><p>Idade: </p><p class="price">R$00,00</p><a href="#" class="btn">Comprar</a></div>
        </div>
        <div class="arrow" onclick="nextSlide()">&#10095;</div>
    </div>

    
    <script>
        let currentIndex = 0;
        const cards = document.getElementById('carousel-cards');
        const cardCount = cards.children.length;
        function showSlide(index) {
            const cardWidth = 220;
            cards.style.transform = `translateX(${-index * cardWidth}px)`;
        }
        function prevSlide() {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : cardCount - 1;
            showSlide(currentIndex);
        }
        function nextSlide() {
            currentIndex = (currentIndex < cardCount - 1) ? currentIndex + 1 : 0;
            showSlide(currentIndex);
        }
        
    </script>
</body>
</html>
