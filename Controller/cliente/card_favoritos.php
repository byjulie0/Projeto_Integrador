<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Componente card favoritos</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/card_favoritos.css">
</head>

<body>
<?php
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
    : 'imagens/default-thumbnail.jpg';
?>

    <div class="lote-card">
        <a href="detalhes_produto.php?id_produto=<?= $id_produto ?>">
            <img id="imagem-principal" src="../../View/Public/<?php echo htmlspecialchars($imagem) ?>" alt="<?php echo $nome; ?>">
            <div class="info-grid">
                <p><?= $nome ?></p><br>
                <p>Peso:</p>
                <p><?= $peso ?></p>
                <p>Raça:</p>
                <p><?= $raca ?></p>
                <p>Idade:</p>
                <p>
                    <?php
                    if (!empty($idade)) {
                        try {
                            $dataNascimento = new DateTime($idade);
                            $dataAtual = new DateTime();
                            $diferenca = $dataAtual->diff($dataNascimento);
                            
                            $anos = $diferenca->y;
                            $meses = $diferenca->m;
                            
                            if ($anos >= 1) {
                                echo $anos . " ano" . ($anos > 1 ? "s" : "");
                            } else {
                                echo $meses . "" . ($meses == 1 ? " mês" : " meses");
                            }
                        } catch (Exception $e) {
                            echo "Data inválida";
                        }
                    } else {
                        echo "Não informado";
                    }
                    ?>
                </p>
                <p class="preco">R$ <?= $preco ?></p>
            </div>
            <div class="stars-pag-fav">
                <a href="../utils/favoritar.php?id_produto=<?php echo $id_produto; ?>">
                    <i class="fa-solid fa-heart red-heart"></i>
                </a>
            </div>
        </a>
    </div>

</body>

</html>