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
    <div class="carrossel_talvez_goste_container">
        <h1 class="pg_talvez_goste" id="talvez_goste">Talvez Você Goste</h1>

        <div class="carrossel_talvez_goste">
            <div class="arrow_talvez_goste" id="arrow-esquerda2">&#10094;</div>

            <a href="detalhes_produto.php?id_produto=<?php echo $item['id_produto']; ?>">
                <div class="cards_talvez_goste" id="carrossel-cards2">
                <?php
                        include '../utils/talvez_sort.php';

                        $talvez_voce_goste = getProdutosAleatorios(5);

                        foreach ($talvez_voce_goste as $item) {

                            $imagem = $item['imagem'];
                            $preco  = number_format($item['valor'], 2, ',', '.');
                        
                            // Detecta automaticamente se é ANIMAL
                            $isAnimal = !empty($item['idade']) && !empty($item['peso']);
                        
                            if ($isAnimal) {
                                // ANIMAL
                                $nome       = $item['prod_nome']; // Nome do animal (ou raça)
                                $raca       = $item['prod_nome'];
                                $peso       = $item['peso'] . " kg";
                                $idade      = $item['idade'];
                                $preco_exibir = ""; // animal não mostra preço
                            } else {
                                // PRODUTO
                                $nome       = $item['prod_nome']; // Nome do produto
                                $raca       = "";  // produto não tem raça
                                $peso       = "";  // produto não tem peso
                                $idade      = "";  // produto não tem idade
                                $preco_exibir = "R$ " . $preco; // produto mostra preço
                            }
                        
                            echo '<a href="detalhes_produto.php?id_produto=' . $item['id_produto'] . '">';
                            include 'card_carrossel.php';
                            echo '</a>';
                        }                        
                    ?>
                </div>
            </a>
            <div class="arrow_talvez_goste" id="arrow-direita2">&#10095;</div>
        </div>
    </div>
</body>

</html>