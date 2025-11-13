<?php
include '../utils/detalhes_prod.php';
include 'menu_pg_inicial.php';
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
    <script src="../../View/js/cliente/popup_login.js" defer></script>
</head>
<body class="body-detalhes-produto">
    <!-- <script>var usuarioLogado = <php echo isset($_SESSION['id_cliente']) ? 'true' : 'false'; ?>;</script> -->
    <h2 class="titulo-produto-detalhes-produto">
        <a href="#" onclick="window.history.back(); return false"><i class="bi bi-chevron-left"></i></a>
    </h2>
    <main class="main-detalhes-produto">

        <div class="galeria-detalhes-produto">
            <div class="miniaturas-detalhes-produto">
                <img src="../../view/public/imagens/default-thumbnail.jpg" alt="Miniatura 1">
                <img src="../../view/public/imagens/default-thumbnail.jpg" alt="Miniatura 2">
                <img src="../../view/public/imagens/default-thumbnail.jpg" alt="Miniatura 3">
                <!-- <img src="<php echo $produto['path_img']; ?>"
                    alt="?php echo htmlspecialchars($produto['prod_nome']); ?>"> -->
            </div>

            <div class="imagem-grande-detalhes-produto">
                <img src="../../view/public/imagens/default-thumbnail.jpg" alt="Imagem Principal">
                <!-- <img src="<php echo $produto['path_img']; ?>"
                    alt="Imagem Principal de <php echo htmlspecialchars($produto['prod_nome']); ?>"> -->
                <h3 class="informacao">Informações</h3>
                <p><?php echo $produto['descricao'] ? htmlspecialchars($produto['descricao']) : 'Descrição não disponível.'; ?>
                </p>
            </div>
            
        </div>

        <div class="info-produto-detalhes-produto">

            <section class="descricao-detalhes-produto">
                <h2><?php echo htmlspecialchars($produto['prod_nome']);?></h2>

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
                    <!-- <input type="hidden" name="id_produto" value="<php echo $produto['id_produto']; ?>"> -->
                    <a type="button" class="botao-carrinho-detalhes-produto" href="../utils/add_carrinho.php?id_produto=<?php echo $produto['id_produto']; ?>">Adicionar ao carrinho</a>
                </form>
                <div class="div_info_prod">
                    <p class="informacoes-detalhes-produto">Vendido pela empresa <span>John Rooster</span></p>

                    <p class="informacoes-detalhes-produto">Entregue por <span>John Rooster</span></p>

                    <p class="informacoes-detalhes-produto">A John Rooster se compromete a oferecer apenas os melhores animais e
                    itens do mercado.</p>
                </div>
            </section>
        </div> 
    </main>
</body>
<!-- <php include '../overlays/pop_up_login.php'; ?> -->
<?php include 'footer_cliente.php'; ?>

</html>