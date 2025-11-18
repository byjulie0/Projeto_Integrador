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
$listaImagens = [];

if (!empty($row['path_img'])) {
    $path = trim($row['path_img']);

    if ($path[0] === '[') {
        $listaImagens = json_decode($path, true);
    } else {
        $listaImagens = explode(',', $path);
    }
}

$listaImagens = array_map(function ($img) {
    return trim(str_replace('\\', '', $img));
}, $listaImagens);

$imagem = !empty($listaImagens[0])
    ? $listaImagens[0]
    : 'view/public/imagens/default-thumbnail.jpg';
if (!$imagem):
    $imagem = 'imagens/default-thumbnail.jpg';
endif;
$nome = $row['prod_nome'];
$valor = number_format($row['valor'], 2, ',', '.');

// PROCESSAR PATH_IMG - PEGAR APENAS A PRIMEIRA IMAGEM
$imagemPrincipal = 'imagens/default-thumbnail.jpg'; // Imagem padrão

if (!empty($row['path_img'])) {
    $path = trim($row['path_img']);
    
    // Se for JSON (array de imagens)
    if ($path[0] === '[') {
        $listaImagens = json_decode($path, true);
        if (!empty($listaImagens[0])) {
            $imagemPrincipal = trim(str_replace('\\', '', $listaImagens[0]));
        }
    } 
    // Se for string com vírgulas
    else if (strpos($path, ',') !== false) {
        $listaImagens = explode(',', $path);
        $imagemPrincipal = trim(str_replace('\\', '', $listaImagens[0]));
    }
    // Se for imagem única
    else {
        $imagemPrincipal = trim(str_replace('\\', '', $path));
    }
}
?>
<body>
    <div class="lote-card">
        <a href="detalhes_produto.php?id_produto=<?php echo $id_prod; ?>">

            <img id="imagem-principal" src="../../View/Public/<?php echo htmlspecialchars($imagem); ?>"
                alt="<?php echo $nome; ?>">
            
            <div class="info-grid">
                <p>Nome:</p>
                <p><?php echo htmlspecialchars($nome); ?></p>
                <p class="preco">R$ <?php echo $valor; ?></p>
            </div>
        </a>
    </div>
</body>
</html>