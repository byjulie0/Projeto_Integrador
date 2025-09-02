<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mais Vendidos</title>
    <script defer src="../../view/js/cliente/mais_vendidos.js"></script>
    <link rel="stylesheet" href="../../view/public/css/cliente/carrosseis_inicial.css">
</head>

<body class="body_pg_carrossel_mais_vendidos">
    <h1 class="pg_mais_vendidos" id="mais_vendidos">Mais Vendidos</h1>

    <div class="carrossel_mais_vendidos">

        <div class="arrow_mais_vendidos" id="arrow-esquerda">&#10094;</div>

        <a href="detalhes_produto.php">
            <div class="cards_mais_vendidos" id="carrossel-cards">
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

                    include 'card_cliente.php';
                }
                ?>
            </div>
        </a>

        <div class="arrow_mais_vendidos" id="arrow-direita">&#10095;</div>
    </div>
</body>

</html>