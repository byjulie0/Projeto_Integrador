<!-- MARIANA -->
<?php
 include 'menu_pg_inicial.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Favoritos</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!--<link rel="stylesheet" href="../View/Public/css/pag-favoritos.css">-->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../View/CSS/cliente.css">
    <!--<link rel="stylesheet" href="menu-pg-inicial.html"> -->

</head>
<body>

    <section class="area-favoritos">
        <h1 class="favoritos-title"><i class="bi bi-chevron-left"></i> Itens Favoritados</h1>
        <section class="cards-favoritos">
            
            <div class="cards-container-pag-fav">
                <div class="card-pag-fav">
                    <img class="card-img-pag-fav" src="../View/Public/imagens/images.jpg" alt="Equino da raça Percheron">
                <div class="card-header-pag-fav">
                    <h2 class="produto-nome-pag-fav">Equino da raça Percheron</h2>
                    <div class="stars-pag-fav">★</div>
                </div>
                <p class="produto-preco-pag-fav">R$00,00</p>
                    <div class="botao-pag-fav">
                        <button class="excluir-pag-fav">Excluir</button>
                        <button class="btn-pag-fav">Comprar</button>
                    </div>
                    <p class="produto-vendas-pag-fav">3,7 mil vendidos</p>


            </div>

            <div class="card-pag-fav">
                <img class="card-img-pag-fav" src="../View/Public/imagens/galo-pag-fav.jpg" alt="Galináceo da raça Índio">
                <div class="card-header-pag-fav">
                <h2 class="produto-nome-pag-fav">Galináceo da raça Índio</h2>
                    <div class="stars-pag-fav">★</div>
                </div>
                <p class="produto-preco-pag-fav">R$00,00</p>
                    <div class="botao-pag-fav">
                        <button class="excluir-pag-fav">Excluir</button>
                        <button class="btn-pag-fav">Comprar</button>
                    </div>
                    <p class="produto-vendas-pag-fav">3,7 mil vendidos</p>
            </div>

            <div class="card-pag-fav">
            <img class="card-img-pag-fav" src="../View/Public/imagens/bovino-pag-fav.jpg" alt="Bovino da raça Angus">
                <div class="card-header-pag-fav">
                <h2 class="produto-nome-pag-fav">Bovino da raça Angus</h2>
                    <div class="stars-pag-fav">★</div>
                </div>
                <p class="produto-preco-pag-fav">R$00,00</p>
                    <div class="botao-pag-fav">
                    <button class="excluir-pag-fav">Excluir</button>
                    <button class="btn-pag-fav">Comprar</button>
                    </div>
                    <p class="produto-vendas-pag-fav">3,7 mil vendidos</p>
                </div>
            </div>
        </section>

    </section>







    
</body>
</html>

<?php

include 'footer_cliente.php';
?>