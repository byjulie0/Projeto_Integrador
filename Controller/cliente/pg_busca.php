<?php include 'menu_pg_inicial.php';?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Rooster - Busca</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../view/public/css/cliente/pg_busca.css">
</head>
<body class="body_pg_busca">
    <div class="container_pagina_de_busca">
        <a class="btn-voltar" href="pg_inicial_cliente.php" >
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <h2 class="h2-pag-busca">Resultados</h2>
        <p>9 resultados encontrados para 'gado nelore'</p>
        <div class="filtros-container">
            <span class="filtros-titulo">Classificar por:</span>
            <button class="filtro-btn" data-filtro="relevancia">Relevância</button>
            <button class="filtro-btn" data-filtro="mais_recente">Mais Recente</button>
            <button class="filtro-btn" data-filtro="em_destaque">Em Destaque</button>
            <select class="filtro-select">
                <option value="preco">Preço</option>
                <option value="menor_preco">Menor Preço</option>
                <option value="maior_preco">Maior Preço</option>
            </select>
        </div>
        <div class="lotes-wrapper">
            <div class="lotes_container_pagina_de_busca" id="lotesContainer">
                <?php
                $lotes = [
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "380 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "24 meses", "preco" => "5.200,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "420 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "28 meses", "preco" => "5.800,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "350 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "22 meses", "preco" => "4.900,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "400 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "26 meses", "preco" => "5.500,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "380 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "24 meses", "preco" => "5.200,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "420 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "28 meses", "preco" => "5.800,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "350 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "22 meses", "preco" => "4.900,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "400 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "26 meses", "preco" => "5.500,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "400 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "26 meses", "preco" => "5.500,00"],
                ];
                foreach ($lotes as $lote) {
                    $imagem = $lote['imagem'];
                    $peso = $lote['peso'];
                    $raca = $lote['raca'];
                    $genealogia = $lote['genealogia'];
                    $idade = $lote['idade'];
                    $preco = $lote['preco'];
                    include 'card_busca.php';
                }?>
            </div>
            <button class="nav-button next">❯</button>
        </div>
    </div>

    <script src="../../view/public/js/pg_busca.js"></script>
</body>
</html>
<?php include 'footer_cliente.php';?>