<?php
include 'menu-pg-inicial.php';
?>
<!-- index.html -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Percheron Carrossel</title>
    <link rel="stylesheet" href="../view/public/css/cliente.css">
</head>
<body class ='body-math'>
    <h1 id="pg-categorias-math">Talvez você goste</h1>
    <div class="carrossel-cat-math">
        <div class="arrow-cat-math" onclick="prevSlide()">&#10094;</div>
        <div class="cards-cat-math" id="carrossel-cards">
            <div class="card-cat-math"><img class ="img_slider_math" src="../view/public/imagens/img_slider_pg_inicial/cavalo_arabe_slider_pg_inicial.jpg" alt="Horse 1"><p>Peso: </p><p>Raça: </p><p>Genealogia: </p><p>Idade: </p><p class="price-cat-math">R$00,00</p><a href="#" class="btn-cat-math">Comprar</a></div>
            <div class="card-cat-math"><img class ="img_slider_math" src="../view/public/imagens/img_slider_pg_inicial/mustang_slider_pg_inicial.jpg" alt="Horse 2"><p>Peso: </p><p>Raça: </p><p>Genealogia: </p><p>Idade: </p><p class="price-cat-math">R$00,00</p><a href="#" class="btn-cat-math">Comprar</a></div>
            <div class="card-cat-math"><img class ="img_slider_math" src="../view/public/imagens/img_slider_pg_inicial/painthorse_slider_pg_inicial.jpg" alt="Horse 3"><p>Peso: </p><p>Raça: </p><p>Genealogia: </p><p>Idade: </p><p class="price-cat-math">R$00,00</p><a href="#" class="btn-cat-math">Comprar</a></div>
            <div class="card-cat-math"><img class ="img_slider_math" src="../view/public/imagens/img_slider_pg_inicial/puro_sangue_slider_pg_inicial.jpg" alt="Horse 4"><p>Peso: </p><p>Raça: </p><p>Genealogia: </p><p>Idade: </p><p class="price-cat-math">R$00,00</p><a href="#" class="btn-cat-math">Comprar</a></div>
            <div class="card-cat-math"><img class ="img_slider_math" src="../view/public/imagens/img_slider_pg_inicial/quarto_de_milha_slider_pq_inicial.jpg" alt="Horse 5"><p>Peso: </p><p>Raça: </p><p>Genealogia: </p><p>Idade: </p><p class="price-cat-math">R$00,00</p><a href="#" class="btn-cat-math">Comprar</a></div>
        </div>
        <div class="arrow-cat-math" onclick="nextSlide()">&#10095;</div>
    </div>

    
    <script>
        let currentIndex = 0;
        const cards = document.getElementById('carrossel-cards');
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
    <footer>
        <?php
        include 'footer_cliente.php';
        ?>
    </footer>
</body>
</html>

