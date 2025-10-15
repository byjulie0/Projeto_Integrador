<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Componente card produtos</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/card_telas.css">
</head>
<?php
$id_prod = $row['id_produto'];
$imagem = $row['path_img'];
$nome = $row['prod_nome'];
$valor = number_format($row['valor'], 2, ',', '.');
?>
<body>
    <div class="lote-card">
        <a href="detalhes_produto.php?id_produto=<?php echo $id_prod; ?>">
            <img src="<?php echo $imagem; ?>" alt="<?php echo $nome; ?>">
            <div class="info-grid">
                <p>Nome:</p>
                <p><?php echo $nome; ?></p>
                <p class="preco">R$ <?php echo $valor; ?></p>
            </div>
        </a>
    </div>
</body>
</html>