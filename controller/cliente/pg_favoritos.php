<?php
include 'menu_pg_inicial.php';

$favoritos = [
    [
        "id" => 1,
        "imagem" => "../../view/public/imagens/images.jpg",
        "peso" => "650 kg",
        "raca" => "Percheron",
        "genealogia" => "PO",
        "idade" => "36 meses",
        "preco" => "8.500,00"
    ],
    [
        "id" => 2,
        "imagem" => "../../View/Public/imagens/galo-pag-fav.jpg",
        "peso" => "3,2 kg",
        "raca" => "Índio",
        "genealogia" => "PO",
        "idade" => "12 meses",
        "preco" => "320,00"
    ],
    [
        "id" => 3,
        "imagem" => "../../View/Public/imagens/bovino-pag-fav.jpg",
        "peso" => "700 kg",
        "raca" => "Angus",
        "genealogia" => "PO",
        "idade" => "30 meses",
        "preco" => "9.900,00"
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Página Favoritos</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../../view/public/css/cliente.css"/>
</head>
<body>

  <section class="area-favoritos">
    <h1 class="favoritos-title"><i class="bi bi-chevron-left"></i> Itens Favoritados</h1>

    <section class="cards-favoritos">
      <div class="cards-container-pag-fav">
        <?php foreach ($favoritos as $item): ?>
          <?php
            $imagem = $item['imagem'];
            $peso = $item['peso'];
            $raca = $item['raca'];
            $genealogia = $item['genealogia'];
            $idade = $item['idade'];
            $preco = $item['preco'];
            $id = $item['id'];
            include 'card_favoritos.php';
          ?>
        <?php endforeach; ?>
      </div>
    </section>
  </section>

</body>
</html>

<?php include 'footer_cliente.php'; ?>
