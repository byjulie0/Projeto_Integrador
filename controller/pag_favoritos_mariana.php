<!-- MARIANA -->
<?php
 include 'menu-pg-inicial.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Favoritos</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../View/Public/css/pag-favoritos.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/View/CSS/pag-favoritos.css">
    <link rel="stylesheet" href="menu-pg-inicial.html">

</head>
<body>
    <section class = area-favoritos>
        <h1 class="favoritos-title"><i class="bi bi-chevron-left"></i> Itens Favoritados</h1>
        <section class="cards-favoritos">
            
            <div class="cards-container-pag-fav">
                <div class="card-pag-fav">
                    <img class="card-img-pag-fav" src="../View/Public/imagens/post-image-35635.jpg" alt="Equino">
                <div class="card-header-pag-fav">
                    <h1>Bovino da raça Angus</h1>
                    <div class="stars-pag-fav">★</div>
                </div>
                <h2>R$00,00</h2>
                    <div class="botao-pag-fav">
                        <button class="excluir-pag-fav">Excluir</button>
                        <button class="btn-pag-fav">Comprar</button>
                    </div>
                <h3>3,7mil Vendidos</h3>
            </div>

            <div class="card-pag-fav">
                <img class="card-img-pag-fav" src="../View/Public/imagens/d18f431605dda131f2eb4ffd65f0d492.jpg" alt="Galináceo">
                <div class="card-header-pag-fav">
                    <h1>Galináceo da raça Índio</h1>
                    <div class="stars-pag-fav">★</div>
                </div>
                <h2>R$00,00</h2>
                    <div class="botao-pag-fav">
                        <button class="excluir-pag-fav">Excluir</button>
                        <button class="btn-pag-fav">Comprar</button>
                    </div>
                <h3>3,7mil Vendidos</h3>
            </div>

            <div class="card-pag-fav">
                <img class="card-img-pag-fav" src="../View/Public/imagens/8e00710f9a371a83a46a8b64167b9f98.png" alt="Bovino">
                <div class="card-header-pag-fav">
                    <h1>Equino da raça Percheron</h1>
                    <div class="stars-pag-fav">★</div>
                </div>
                <h2>R$00,00</h2>
                    <div class="botao-pag-fav">
                    <button class="excluir-pag-fav">Excluir</button>
                    <button class="btn-pag-fav">Comprar</button>
                    </div>
                <h3>3,7mil Vendidos</h3>
                </div>
            </div>
        </section>

    </section>







    
</body>
</html>

<?php

include 'footer_cliente.php';
?>