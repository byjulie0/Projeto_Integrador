<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campeões</title>
    <script defer src="../../view/js/cliente/campeoes.js"></script>
    <link rel="stylesheet" href="../../view/public/css/cliente/carrosseis_inicial.css">
</head>

<body class="body_pg_carrossel_campeoes">
    <div class="carrossel_campeoes_cor">
        <h1 class="pg_campeoes" id="campeoes">Campeões do Mês</h1>

        <div class="carrossel_campeoes">

            <div class="arrow_campeoes" id="arrow-esquerda3">&#10094;</div>

            <a href="detalhes_produto.php">
                <div class="cards_campeoes" id="carrossel-cards3">
                    <?php
                    $campeos = [
                        [
                            "imagem" => "../../view/public/imagens/img_slider_pg_inicial/cavalo_arabe_slider_pg_inicial.jpg",
                            "peso" => "420 kg",
                            "raca" => "Árabe",
                            "genealogia" => "PO",
                            "idade" => "1 ano",
                            "preco" => "2.000 000,00"
                        ],
                        [
                            "imagem" => "../../view/public/imagens/img_slider_pg_inicial/mustang_slider_pg_inicial.jpg",
                            "peso" => "550 kg",
                            "raca" => "Mustang",
                            "genealogia" => "PO",
                            "idade" => "28 meses",
                            "preco" => "12.000,00"
                        ],
                        [
                            "imagem" => "../../view/public/imagens/img_slider_pg_inicial/puro_sangue_slider_pg_inicial.jpg",
                            "peso" => "544 kg",
                            "raca" => "Puro Sangue",
                            "genealogia" => "PO",
                            "idade" => "28 meses",
                            "preco" => "18.000,00"
                        ],
                        [
                            "imagem" => "../../view/public/imagens/nelore3.jpg",
                            "peso" => "442 kg",
                            "raca" => "Nelore",
                            "genealogia" => "PO",
                            "idade" => "1 ano",
                            "preco" => "4.900,00"
                        ],
                        [
                            "imagem" => "../../view/public/imagens/rhode-island-red-rooster.jpg",
                            "peso" => "3,9 kg",
                            "raca" => "Rhode Island",
                            "genealogia" => "PO",
                            "idade" => "1 ano",
                            "preco" => "1.500,00"
                        ]
                    ];

                    foreach ($campeos as $item) {
                        $imagem = $item['imagem'];
                        $peso = $item['peso'];
                        $raca = $item['raca'];
                        $genealogia = $item['genealogia'];
                        $idade = $item['idade'];
                        $preco = $item['preco'];

                        echo '<a href="detalhes_produto.php">';
                            include 'card_cliente.php';
                        echo '</a>';
                    }
                    ?>
                </div>
            </a>

            <div class="arrow_campeoes" id="arrow-direita3">&#10095;</div>
        </div>
    </div>
</body>

</html>