<?php include 'menu_pg_inicial.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página Favoritos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../../view/public/css/cliente/pg_favoritos.css">
</head>
<body>
    <div class="seta_titulo_pg_favoritos">
        <a class="btn_voltar_favoritos" href="#" onclick="window.history.back(); return false;">
            <i class="bi bi-chevron-left"></i>
        </a>
        <h2 class="h2_pg_favoritos">Favoritos</h2>
    </div>

    <div class="container_pg_favoritos">
        <div class="lotes-wrapper">
            <div class="lotes_container_pg_favoritos" id="lotesContainerFavoritos">
                <?php
                $favoritos = [
                    ["nome" => "Épico (Cavalo)", "imagem" => "../../view/public/imagens/images.jpg", "peso" => "380 kg", "raca" => "Percheron", "genealogia" => "PO", "idade" => "24 meses", "preco" => "5.200,00"],
                    ["nome" => "Galo Índio", "imagem" => "../../view/public/imagens/galo-pag-fav.jpg", "peso" => "3.5 kg", "raca" => "Índio", "genealogia" => "PO", "idade" => "12 meses", "preco" => "600,00"],
                    ["nome" => "Lote de Bovinos 1", "imagem" => "../../view/public/imagens/bovino-pag-fav.jpg", "peso" => "450 kg", "raca" => "Angus", "genealogia" => "PO", "idade" => "30 meses", "preco" => "6.000,00"],
                    ["nome" => "Lote de Bovinos 2", "imagem" => "../../view/public/imagens/bovino-pag-fav.jpg", "peso" => "450 kg", "raca" => "Angus", "genealogia" => "PO", "idade" => "30 meses", "preco" => "6.000,00"]
                ];

                foreach ($favoritos as $item) {
                    $nome = $item['nome'];
                    $imagem = $item['imagem'];
                    $peso = $item['peso'];
                    $raca = $item['raca'];
                    $genealogia = $item['genealogia'];
                    $idade = $item['idade'];
                    $preco = $item['preco'];
                    
                    // Inclui apenas o FRAGMENTO do card
                    include 'card_favoritos.php';
                }
                ?>
            </div>
        </div>
    </div>

    <?php include 'footer_cliente.php'; ?>
</body>
</html>