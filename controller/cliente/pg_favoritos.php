<?php include 'menu_pg_inicial.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Página Favoritos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
</head>

<body>
    <div class="container_pagina_de_busca">
        <a class="btn-voltar" href="pg_inicial_cliente.php">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 class="h2-pag-busca">Itens Favoritados</h2>

        <div class="lotes-wrapper">
            <div class="lotes_container_pagina_de_busca" id="lotesContainer">
                <?php
                $favoritos = [
                    [
                        "imagem" => "../../view/public/imagens/images.jpg",
                        "peso" => "380 kg",
                        "raca" => "Percheron",
                        "genealogia" => "PO",
                        "idade" => "24 meses",
                        "preco" => "5.200,00"
                    ],
                    [
                        "imagem" => "../../view/public/imagens/galo-pag-fav.jpg",
                        "peso" => "3.5 kg",
                        "raca" => "Índio",
                        "genealogia" => "PO",
                        "idade" => "12 meses",
                        "preco" => "600,00"
                    ],
                    [
                        "imagem" => "../../view/public/imagens/bovino-pag-fav.jpg",
                        "peso" => "450 kg",
                        "raca" => "Angus",
                        "genealogia" => "PO",
                        "idade" => "30 meses",
                        "preco" => "6.000,00"
                    ]
                ];

                foreach ($favoritos as $item) {
                    $imagem = $item['imagem'];
                    $peso = $item['peso'];
                    $raca = $item['raca'];
                    $genealogia = $item['genealogia'];
                    $idade = $item['idade'];
                    $preco = $item['preco'];
                    include 'card_favoritos.php';
                }
                ?>
            </div>
        </div>
    </div>



    </div>
    </section>

    </section>
    <?php include 'footer_cliente.php'; ?>
</body>

</html>