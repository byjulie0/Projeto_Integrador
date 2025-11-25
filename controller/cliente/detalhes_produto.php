<?php

// Pop up para erro ao adicionar no carrinho
if (isset($_GET['erro_estoque']) && $_GET['erro_estoque'] == 1) {

    $titulo = 'Não foi possivel adicionar ao carrinho!';
    $mensagem = 'Este item está já no seu carrinho com a quantidade máxima.';
    include '../overlays/pop_up_estoque.php';
    
} else if (isset($_GET['erro_estoque']) && $_GET['erro_estoque'] == 2) {

    $titulo = 'Não foi possivel adicionar ao carrinho!';
    $mensagem = 'Este item está indisponivel no site.';
    include '../overlays/pop_up_estoque.php';

}

include '../utils/detalhes_prod.php';
include 'menu_pg_inicial.php';

$id_cliente = $_SESSION['id_cliente'] ?? null;
$id_produto = $_GET['id_produto'] ?? null;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($produto['prod_nome']) ?> - Detalhes</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/detalhes_produto.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="../../View/js/cliente/favoritar.js"></script>
</head>

<body class="body-detalhes-produto">
    <h2 class="titulo-produto-detalhes-produto">
        <a href="#" onclick="window.history.back(); return false"><i class="bi bi-chevron-left"></i></a>
    </h2>
    <main class="main-detalhes-produto">

        <?php
        $listaImagens = [];

        if (!empty($produto['path_img'])) {
            $path = trim($produto['path_img']);

            if ($path[0] === '[') {
                $listaImagens = json_decode($path, true);
            } else {
                $listaImagens = explode(',', $path);
            }
        }

        $listaImagens = array_map(function ($img) {
            return trim(str_replace('\\', '', $img));
        }, $listaImagens);

        $imagemPrincipal = !empty($listaImagens[0])
            ? $listaImagens[0]
            : '../../View/public/imagens/default-thumbnail.jpg';
        ?>

        <div class="galeria-detalhes-produto">
            <div class="miniaturas-detalhes-produto">
                <?php foreach ($imagens as $img): ?>

                    <?php if ($img): ?>
                        <img src="../../View/Public/<?php echo htmlspecialchars($img); ?>" alt="Miniatura">
                    <?php else:
                        $img = 'imagens/default-thumbnail.jpg'; ?>
                        <img src="../../View/Public/<?php echo htmlspecialchars($img); ?>" alt="Miniatura">

                    <?php endif ?>

                <?php endforeach; ?>
            </div>

            <div class="imagem-grande-detalhes-produto">
                <img id="imagem-principal" src="../../View/Public/<?php echo htmlspecialchars($imagemPrincipal); ?>"
                    alt="Imagem principal do produto">

                <h3 class="informacao">Informações</h3>
                <p><?php echo $produto['descricao'] ? htmlspecialchars($produto['descricao']) : 'Descrição não disponível.'; ?>
                </p>
            </div>
        </div>

        <div class="info-produto-detalhes-produto">

            <section class="descricao-detalhes-produto">
                <h2><?php echo htmlspecialchars($produto['prod_nome']); ?></h2>

                <div class="area-favorito">
                    <a class="btn-favorito"
                        href="../utils/favoritar.php?id_produto=<?php echo $produto['id_produto']; ?>">
                        <i class="fa-solid fa-heart red-heart"></i>
                    </a>
                </div>

                <section class="sub-descricao-detalhes-produto">
                    <?php if ($produto['id_categoria'] != 5): ?>
                        <p><strong>Peso: </strong><?php echo $peso_formatado; ?></p>
                        <p><strong>Data de nascimento: </strong><?php echo $produto['idade']; ?></p>
                        <p><strong>Tipo: </strong><?php echo $produto['subcat_nome'] ?? 'Não categorizado'; ?></span></p>
                        <?php if ($produto['campeao']): ?>
                            <p><strong>Status:</strong> <span class="badge bg-success">Animal Campeão</span></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </section>

                <p class="preco-detalhes-produto">R$ <?php echo $valor_formatado; ?></p>

                <form id="formCarrinho" action="add_carrinho.php" method="GET">

                    <a type="button" class="botao-carrinho-detalhes-produto"
                        href="../utils/add_carrinho.php?id_produto=<?php echo $produto['id_produto']; ?>">Adicionar ao
                        carrinho
                    </a>
                </form>

                <div class="div_info_prod">
                    <p class="informacoes-detalhes-produto">Vendido pela empresa <span>John Rooster</span></p>

                    <p class="informacoes-detalhes-produto">Entregue por <span>John Rooster</span></p>

                    <p class="informacoes-detalhes-produto">A John Rooster se compromete a oferecer apenas os melhores
                        animais e
                        itens do mercado.</p>
                </div>

            </section>
        </div>
    </main>
    <script>
        // Troca a imagem principal ao clicar na miniatura
        const miniaturas = document.querySelectorAll('.miniaturas-detalhes-produto img');
        const imagemPrincipal = document.getElementById('imagem-principal');
        miniaturas.forEach(img => {
            img.addEventListener('click', () => {
                imagemPrincipal.src = img.src;
            });
        });
    </script>
</body>
<?php include 'footer_cliente.php'; ?>

</html>