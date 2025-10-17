<?php
include '../utils/sessao_ativa.php';
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
    <script defer src="../../view/js/cliente/carrinho.js"></script>
</head>

<body>
    <div class="main_cart_area">
        <div class="product_area_cart">
            <div class="'area_seta_titulo'">
                <i class="bi bi-chevron-left"></i>
                <h1 class="cart_title">Carrinho</h1>
            </div>

            <section class="product-cards-carrinho">

                <?php
                $id_cliente = $_SESSION["id_cliente"];

                $sql = "SELECT c.id_carrinho, c.quantidade, p.prod_nome, p.path_img, p.descricao, p.valor FROM carrinho c JOIN produto p ON c.id_produto = p.id_produto WHERE c.id_cliente='$id_cliente'";

                $result = $con->query($sql);

                $totalGeral = 0;

                while ($itens = $result->fetch_assoc()):
                    $total = $itens['valor'] * $itens['quantidade'];
                    $totalGeral += $total; ?>

                    <div class="product-card-carrinho" data-price="<?php echo $itens['valor'] ?>"><!-- PREÇO DO PRODUTO -->
                        <div class="product-title-area-carrinho">

                            <div class="delete-item-btn-area-carrinho">
                                <button class="delete-item-carrinho">Excluir</button>
                            </div>

                        </div>
                        <hr class="separation-line-carrinho">


                        <div class="product-carrinho">

                            <div class="non-labeled-content-carrinho">
                                <img src="../../View/Public/<?php echo $itens['path_img'] ?>" alt="<?php echo $itens['prod_nome'] ?>"
                                    class="product-img-carrinho"><!-- IMAGEM DO ITEM -->
                                <div class="title-and-description-carrinho">
                                    <span
                                        class="product-name-carrinho"><?php echo $itens['prod_nome'] ?></span><!-- NOME DO ITEM -->

                                    <span class="product-description-carrinho"><?php echo $itens['descricao'] ?></span>
                                    <!-- DESCRIÇÃO DO ITEM -->
                                </div>
                            </div>

                            <div class="labels-respective-content-carrinho">
                                <div class="change-quantity-carrinho">
                                    <button class="change-quantity-btn-carrinho minus-btn"></button><!-- DIMINUIR  ITEM -->

                                    <span
                                        class="quantity-carrinho"><?php echo $itens['quantidade'] ?></span><!-- QUANTIDADE DO  ITEM -->

                                    <button class="change-quantity-btn-carrinho plus-btn"></button><!-- AUMENTAR  ITEM -->
                                </div>
                            </div>

                            <div class="labels-respective-content-carrinho">
                                <span class="total-price">
                                    R$: <span class="product-total-price"><?php echo $itens['valor'] ?></span>
                                    <!-- PREÇO DO ITEM -->
                                </span>
                            </div>

                        </div>

                    </div>

                <?php endwhile; ?>

            </section>
        </div>

        <section class="checkout-btns-carrinho">
            <div class="checkout-btns-space-carrinho">
                <h3 class="resumo_carrinho">Resumo da compra</h3>
                <span class="total_items_cart">Items: <span class="total-items-count">1</span></span>
                <div class="total-price-checkout-carrinho">
                    <span class="total-label-carrinho">
                        Total: R$: <span class="grand-total-price"><?php echo $totalGeral ?></span>
                    </span>
                </div>

                <hr class="separation-line-carrinho">

                <?php
                $texto = "Fechar Pedido";
                include 'botao_verde_cliente.php';
                ?>
            </div>
        </section>
    </div>
</body>

</html>

<?php
include 'footer_cliente.php';
?>