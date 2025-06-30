<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Percheron Carrossel</title>
    <script defer src="../view/js/slider_pg_inicial.js"></script>
    <link rel="stylesheet" href="../../view/public/css/cliente.css" />
</head>
<body class="body-math">
    <h1 class="pg-categorias-math">Talvez você goste</h1>
    <div class="carrossel-cat-math">
        <div class="arrow-cat-math" onclick="prevSlide()">&#10094;</div>
        <div class="cards-cat-math" id="carrossel-cards">

            <?php
            $items = [
                [
                    "imagem" => "../../view/public/imagens/img_slider_pg_inicial/cavalo_arabe_slider_pg_inicial.jpg",
                    "peso" => "380 kg",
                    "raca" => "Árabe",
                    "genealogia" => "PO",
                    "idade" => "24 meses",
                    "preco" => "5.200,00"
                ],
                [
                    "imagem" => "../../view/public/imagens/img_slider_pg_inicial/mustang_slider_pg_inicial.jpg",
                    "peso" => "420 kg",
                    "raca" => "Mustang",
                    "genealogia" => "PO",
                    "idade" => "28 meses",
                    "preco" => "5.800,00"
                ],
                [
                    "imagem" => "../../view/public/imagens/img_slider_pg_inicial/painthorse_slider_pg_inicial.jpg",
                    "peso" => "400 kg",
                    "raca" => "Paint Horse",
                    "genealogia" => "PO",
                    "idade" => "26 meses",
                    "preco" => "5.500,00"
                ],
                [
                    "imagem" => "../../view/public/imagens/img_slider_pg_inicial/puro_sangue_slider_pg_inicial.jpg",
                    "peso" => "390 kg",
                    "raca" => "Puro Sangue",
                    "genealogia" => "PO",
                    "idade" => "25 meses",
                    "preco" => "5.300,00"
                ],
                [
                    "imagem" => "../../view/public/imagens/img_slider_pg_inicial/quarto_de_milha_slider_pq_inicial.jpg",
                    "peso" => "410 kg",
                    "raca" => "Quarto de Milha",
                    "genealogia" => "PO",
                    "idade" => "27 meses",
                    "preco" => "5.600,00"
                ]
            ];

            foreach ($items as $item) {
                $imagem = $item['imagem'];
                $peso = $item['peso'];
                $raca = $item['raca'];
                $genealogia = $item['genealogia'];
                $idade = $item['idade'];
                $preco = $item['preco'];

                echo '<div style="display: flex; flex-direction: column; align-items: center;">';
                include 'card_cliente.php';
                echo '<a href="#" class="btn-cat-math">Comprar</a>';
                echo '</div>';
            }
            ?>

        </div>
        <div class="arrow-cat-math" onclick="nextSlide()">&#10095;</div>
    </div>
</body>
</html>
