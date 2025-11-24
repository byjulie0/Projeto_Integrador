<?php
include '../utils/autenticado.php';
if ($usuario_nao_logado) {
    include '../overlays/pop_up_login.php';
    exit;
}
include '../utils/libras.php';
include 'menu_pg_inicial.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/carrinho.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    // Exibir pop-up de erro se houver
    if (isset($_SESSION['popup_type']) && $_SESSION['popup_type'] === 'erro' && isset($_SESSION['popup_message'])) {
        $texto = $_SESSION['popup_message'];
        include '../overlays/pop_up_erro.php';
        unset($_SESSION['popup_type']);
        unset($_SESSION['popup_message']);
    }

    if (isset($_SESSION['popup_type']) && $_SESSION['popup_type'] === 'sucesso' && isset($_SESSION['popup_message'])) {
        $texto = $_SESSION['popup_message'];
        include '../overlays/pop_up_sucesso.php';
        unset($_SESSION['popup_type']);
        unset($_SESSION['popup_message']);
    }

    ?>

    <div class="main_cart_area">
        <div class="product_area_cart">
            <div class="area_seta_titulo">
                <i class="bi bi-chevron-left"></i>
                <h1 class="cart_title">Carrinho</h1>
            </div>

            <section class="product-cards-carrinho">
                <?php
                $sql = "SELECT c.id_carrinho, c.quantidade, p.prod_nome, p.path_img, p.descricao, p.valor
                        FROM carrinho c
                        JOIN produto p ON c.id_produto = p.id_produto
                        WHERE c.id_cliente='$id_cliente' AND p.produto_ativo = 1 AND p.quant_estoque != 0";
                $result = $con->query($sql);
                $totalGeral = 0;
                $totalItems = 0;

                if ($result && $result->num_rows > 0) {
                    while ($itens = $result->fetch_assoc()) {
                        $total = $itens['valor'] * $itens['quantidade'];
                        $totalGeral += $total;
                        $totalItems += $itens['quantidade'];
                        ?>
                        <div class="product-card-carrinho" data-price="<?php echo $itens['valor']; ?>"
                            data-id="<?php echo $itens['id_carrinho']; ?>">

                            <div class="product-title-area-carrinho">
                                <div class="delete-item-btn-area-carrinho">
                                    <a
                                        href="../utils/remove_carrinho.php?id_carrinho=<?php echo $itens['id_carrinho']; ?>">Excluir</a>
                                </div>
                            </div>

                            <hr class="separation-line-carrinho">

                            <div class="product-carrinho">
                                <div class="non-labeled-content-carrinho">
                                    <!-- IMAGEM -->
                                    <?php
                                    $listaImagens = [];

                                    if (!empty($itens['path_img'])) {
                                        $path = trim($itens['path_img']);

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
                                        : '../../View/public/imagens/default-thumbnail.jpg';
                                    ?>
                                    <!-- IMAGEM -->
                                    <img src="../../View/Public/<?php echo htmlspecialchars($imagem); ?>"
                                        alt="<?php echo $itens['prod_nome']; ?>" class="product-img-carrinho">

                                    <div class="title-and-description-carrinho">
                                        <span class="product-name-carrinho"><?php echo $itens['prod_nome']; ?></span>
                                        <span class="product-description-carrinho"><?php echo $itens['descricao']; ?></span>
                                    </div>
                                </div>

                                <div class="labels-respective-content-carrinho">
                                    <div class="change-quantity-carrinho">
                                        <a class="change-quantity-btn-carrinho diminuir-btn"
                                            href="../utils/diminuir_carrinho.php?id_carrinho=<?php echo $itens['id_carrinho']; ?>">-</a>

                                        <span class="quantity-carrinho"><?php echo $itens['quantidade']; ?></span>

                                        <a class="change-quantity-btn-carrinho aumentar-btn"
                                            href="../utils/aumentar_carrinho.php?id_carrinho=<?php echo $itens['id_carrinho']; ?>">+</a>
                                    </div>
                                </div>

                                <div class="labels-respective-content-carrinho">
                                    <span class="product-total-price"
                                        data-price="<?php echo $total; ?>"><?php echo number_format($total, 2, ',', '.'); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="carrinho-vazio">Seu carrinho está vazio</div>';
                }
                ?>
            </section>
        </div>

        <section class="checkout-btns-carrinho">
            <div class="checkout-btns-space-carrinho">
                <h3 class="resumo_carrinho">Resumo da compra</h3>
                <span class="total_items_cart">Items: <span
                        class="total-items-count"><?php echo $totalItems; ?></span></span>
                <div class="total-price-checkout-carrinho">
                    <span class="total-label-carrinho">
                        Total: R$: <span
                            class="grand-total-price"><?php echo number_format($totalGeral, 2, ',', '.'); ?></span>
                    </span>
                </div>

                <hr class="separation-line-carrinho">

                <?php
                if ($totalItems > 0) { ?>
                    <a href="../utils/gerar_pedido.php">
                        <?php
                        $texto = "Fechar Pedido";
                        include 'botao_verde_cliente.php';
                        ?>
                    </a>
                <?php } ?>

            </div>
        </section>
    </div>

    <!-- Script para redirecionar após sucesso do pedido -->
    <script>
        <?php if (isset($_GET['pedido_sucesso']) && $_GET['pedido_sucesso'] == 1): ?>
            // Aguarda 3 segundos e redireciona para limpar carrinho e ir ao histórico
            setTimeout(function () {
                window.location.href = '../utils/limpar_carrinho.php';
            }, 3000);
        <?php endif; ?>
    </script>

    <?php include 'footer_cliente.php'; ?>
</body>

</html>