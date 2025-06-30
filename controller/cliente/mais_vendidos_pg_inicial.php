<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Percheron Carrossel</title>
    <script defer src="../view/js/mais_vendidos.js"></script>
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
</head>
<body class="body-mais-vendidos">
    <h1 class="pg-mais-vendidos" id="mais_vendidos">Mais Vendidos</h1>

    <div class="carrossel-mais-vendidos">
        <div class="arrow-mais-vendidos" onclick="prevSlide()">&#10094;</div>

        <div class="cards-mais-vendidos" id="carrossel-cards">
            <?php
            $mais_vendidos = [
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
                    "imagem" => "../../view/public/imagens/img_slider_pg_inicial/mustang_slider_pg_inicial.jpg",
                    "peso" => "420 kg",
                    "raca" => "Mustang",
                    "genealogia" => "PO",
                    "idade" => "28 meses",
                    "preco" => "5.800,00"
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
                    "imagem" => "../../view/public/imagens/img_slider_pg_inicial/mustang_slider_pg_inicial.jpg",
                    "peso" => "420 kg",
                    "raca" => "Mustang",
                    "genealogia" => "PO",
                    "idade" => "28 meses",
                    "preco" => "5.800,00"
                ]
            ];

            foreach ($mais_vendidos as $item) {
                $imagem = $item['imagem'];
                $peso = $item['peso'];
                $raca = $item['raca'];
                $genealogia = $item['genealogia'];
                $idade = $item['idade'];
                $preco = $item['preco'];
                echo '<div style="display: flex; flex-direction: column; align-items: center;">';
                include 'card_cliente.php';
                echo '</div>';
            }
            ?>
        </div>

        <div class="arrow-mais-vendidos" onclick="nextSlide()">&#10095;</div>
    </div>
</body>
</html>
