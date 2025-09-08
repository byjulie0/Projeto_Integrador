<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talvez você Goste</title>
    <script defer src="../../view/js/cliente/talvez_voce_goste.js"></script>
    <link rel="stylesheet" href="../../view/public/css/cliente/carrosseis_inicial.css">
</head>

<body class="body_pg_carrossel_talvez_voce_goste">
    <h1 class="pg_talvez_goste" id="talvez_goste">Talvez Você Goste</h1>

    <div class="carrossel_talvez_goste">
        <div class="arrow_talvez_goste" id="arrow-esquerda2">&#10094;</div>

        <a href="detalhes_produto.php">
            <div class="cards_talvez_goste" id="carrossel-cards2">
                <?php
                $talvez_voce_goste = [
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

                foreach ($talvez_voce_goste as $item) {
                    $imagem = $item['imagem'];
                    $peso = $item['peso'];
                    $raca = $item['raca'];
                    $genealogia = $item['genealogia'];
                    $idade = $item['idade'];
                    $preco = $item['preco'];

                    echo '<a href="detalhes_produto.php">';
                        include 'card_carrossel.php';
                    echo '</a>';
                }
                ?>
            </div>
        </a>

        <div class="arrow_talvez_goste" id="arrow-direita2">&#10095;</div>
    </div>
</body>

</html>