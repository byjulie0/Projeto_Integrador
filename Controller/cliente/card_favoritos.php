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
            <img id="imagem-principal" src="../../View/Public/<?php echo htmlspecialchars($imagem) ?>"
                alt="<?php echo $nome; ?>">
            <div class="info-grid">
                <p><?= $nome ?></p><br>
                <?php if ($id_categoria != 4): ?>
                    <p>Idade:</p>
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
                    <p>Peso:</p>
                    <p><?= $peso ?></p>
                    <p>Raça:</p>
                    <p><?= $raca ?></p>
                    
                <?php else:?>
                    <p>Tipo:</p>
                    <p><?= $raca ?></p>
                <?php endif; ?>

                <p class="preco">R$ <?= $preco ?></p>
            </div>
            <div class="stars-pag-fav">
                <form method="POST" action="../utils/remover_favorito.php" style="display: inline;">
                    <input type="hidden" name="id_produto" value="<?= $id_produto ?>">
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        <i class="fa-solid fa-heart red-heart"></i>
                    </button>
                </form>
            </div>
        </a>
    </div>

</body>

</html>