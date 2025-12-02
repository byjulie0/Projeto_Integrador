<?php

include '../utils/detalhes_prod.php';
include 'menu_pg_inicial.php';

// Verificar se há mensagens de pop-up na sessão
if (isset($_SESSION['popup_message'])) {
    $titulo = $_SESSION['titulo'];
    $texto = $_SESSION['popup_message'];

    // Verificar se é sucesso
    if ($_SESSION['type'] == 'success') {
        $sucesso = true;
    }
    include '../overlays/pop_up_erro.php';

    // Limpar a sessão
    unset($_SESSION['titulo']);
    unset($_SESSION['popup_message']);
    unset($_SESSION['type']);
}

$id_cliente = $_SESSION['id_cliente'] ?? null;
$id_produto = $_GET['id_produto'] ?? null;

if ($id_produto == null) {
    $_SESSION['titulo'] = 'Produto não encontrado!';
    $_SESSION['popup_message'] = 'Não foi possível encontrar esse produto no catalogo.';
    $_SESSION['type'] = 'error';

    header("Location: ../cliente/pg_inicial_cliente.php");
    exit;
}

$sql = "SELECT id_favorito FROM favorito WHERE id_cliente = ? AND id_produto = ?";
$query = $con->prepare($sql);
$query->bind_param("ii", $id_cliente, $id_produto);
$query->execute();
$query->store_result();
$ehfavorito = $query->num_rows > 0;
$query->close();

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
    <div class="titulo-produto-detalhes-produto">
        <a href="#" onclick="window.history.back(); return false"><i class="bi bi-chevron-left"></i></a>
        <p><?php echo htmlspecialchars($produto['prod_nome']); ?></p>
    </div>
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
                <div class="area-favorito">

                    <form method="POST" action="../utils/favoritar.php">
                        <input type="hidden" name="id_cliente" value="<?= $id_cliente ?>">
                        <input type="hidden" name="id_produto" value="<?= $id_produto ?>">
                        <input type="hidden" name="eh_favorito" value="<?= $ehfavorito ? '1' : '0' ?>">

                        <?php
                        $icone = $ehfavorito ? "fa-solid" : "fa-regular"; // fa-regular em vez de fa-thin
                        $ariaPressed = $ehfavorito ? "true" : "false";
                        ?>

                        <button type="submit" name="fav_heart" class="btn-favorito" aria-pressed="<?= $ariaPressed ?>">
                            <i class="<?php echo $icone; ?> fa-heart" style="color: red;"></i>
                        </button>
                    </form>

                </div>

                <section class="sub-descricao-detalhes-produto">
                    <?php if ($produto['id_categoria'] != 5): ?>
                        <p><strong>Peso: </strong><?php echo $peso_formatado; ?></p>
                        <p><strong>Data de nascimento: </strong><?php echo date('d/m/Y', strtotime($produto['idade'])); ?>
                        </p>
                        <p><strong>Tipo: </strong><?php echo $produto['subcat_nome'] ?? 'Não categorizado'; ?></span></p>
                        <?php if ($produto['campeao']): ?>
                            <p><strong>Status:</strong> <span class="badge bg-success">Animal Campeão</span></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </section>

                <p class="preco-detalhes-produto">R$ <?php echo $valor_formatado; ?></p>

                <form id="formCarrinho" action="../utils/add_carrinho.php" method="POST">
                    <input type="hidden" name="id_cliente" value="<?= $id_cliente ?>">
                    <button type="submit" class="botao-carrinho-detalhes-produto" name="id_produto"
                        value="<?= $produto['id_produto'] ?>">Adicionar ao carrinho</button>
                </form>

                <div class="div_info_prod">
                    <p class="informacoes-detalhes-produto">Vendido pela empresa <span>John Rooster</span></p>

                    <p class="informacoes-detalhes-produto">Entregue por <span>John Rooster</span></p>

                    <p class="informacoes-detalhes-produto">A John Rooster se compromete a oferecer apenas os melhores
                        animais e
                        itens do mercado.</p>
                    <h3 class="informacao2">Informações</h3>
                    <p><?php echo $produto['descricao'] ? htmlspecialchars($produto['descricao']) : 'Descrição não disponível.'; ?>
                    </p>
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