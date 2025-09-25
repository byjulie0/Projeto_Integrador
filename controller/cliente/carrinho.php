<?php
include 'menu_pg_inicial.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/carrinho.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="../../view/js/cliente/carrinho.js"></script>
</head>

<body>
    <div class="main_cart_area">
        <div class="product_area_cart">
            <div class="'area_seta_titulo'">
                 <i class="bi bi-chevron-left"></i>
                <h1 class="cart_title">Carrinho</h1>
            </div>
            <section class="cart-header-carrinho">
                <div class="cart-header-labels-carrinho">
                    <div class="check-btn-carrinho">
                        <input type="checkbox" id="check-square-carrinho" class="select-all-checkbox">
                        <div class="check-square-carrinho"></div>
                        <label for="check-square" class="check-box-label-carrinho">Selecionar tudo</label>
                    </div>
                </div>
            </section>

            <section class="product-cards-carrinho">
                <!-- Item de exemplo no carrinho -->
                <div class="product-card-carrinho" data-price="99.99">
                    <div class="product-title-area-carrinho">
                        <div class="check-btn-carrinho">
                            <input type="checkbox" class="product-checkbox" checked>
                            <div class="check-square-carrinho"></div>
                            <span class="product-title-carrinho">Produto Exemplo 1</span>
                        </div>
                        <div class="delete-item-btn-area-carrinho">
                            <button class="delete-item-carrinho">Excluir</button>
                        </div>
                    </div>
                    <div class="separation-line-carrinho"></div>
                    <div class="product-carrinho">
                        <div class="non-labeled-content-carrinho">
                            <img src="../../view/public/imagens/blank_image.png" alt="" class="product-img-carrinho">
                            <div class="title-and-description-carrinho">
                                <span class="product-name-carrinho">Produto Exemplo 1</span>
                                <span class="product-description-carrinho">Descrição do Produto 1</span>
                            </div>
                        </div>

                        <div class="labels-respective-content-carrinho">
                            <div class="change-quantity-carrinho">
                                <button class="change-quantity-btn-carrinho minus-btn">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <span class="quantity-carrinho">1</span>
                                <button class="change-quantity-btn-carrinho plus-btn">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="labels-respective-content-carrinho">
                            <span class="total-price">
                                R$: <span class="product-total-price">99,99</span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="product-card-carrinho" data-price="99.99">
                    <div class="product-title-area-carrinho">
                        <div class="check-btn-carrinho">
                            <input type="checkbox" class="product-checkbox" checked>
                            <div class="check-square-carrinho"></div>
                            <span class="product-title-carrinho">Produto Exemplo 2</span>
                        </div>
                        <div class="delete-item-btn-area-carrinho">
                            <button class="delete-item-carrinho">Excluir</button>
                        </div>
                    </div>
                    <div class="separation-line-carrinho"></div>
                    <div class="product-carrinho">
                        <div class="non-labeled-content-carrinho">
                            <img src="../../view/public/imagens/blank_image.png" alt="" class="product-img-carrinho">
                            <div class="title-and-description-carrinho">
                                <span class="product-name-carrinho">Produto Exemplo 2</span>
                                <span class="product-description-carrinho">Descrição do Produto 2</span>
                            </div>
                        </div>

                        <div class="labels-respective-content-carrinho">
                            <div class="change-quantity-carrinho">
                                <button class="change-quantity-btn-carrinho minus-btn">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <span class="quantity-carrinho">1</span>
                                <button class="change-quantity-btn-carrinho plus-btn">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="labels-respective-content-carrinho">
                            <span class="total-price">
                                R$: <span class="product-total-price">99,99</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Adicionar mais itens conforme necessário -->
            </section>
        </div>

        <section class="checkout-btns-carrinho">
            <div class="checkout-btns-space-carrinho">
                <h3 class="resumo_carrinho">Resumo da compra</h3>
                <span class="total_items_cart">Items: <span class="total-items-count">1</span></span>
                <div class="total-price-checkout-carrinho">
                    <span class="total-label-carrinho">
                        Total: R$: <span class="grand-total-price">99,99</span>
                    </span>
                </div>
                <div class="separation-line-carrinho"></div>

                <?php
                    $texto = "Fechar Pedido"; 
                    include 'botao_cliente.php';
                ?>
            </div>
        </section>
    </div>
</body>
</html>

<?php
include 'footer_cliente.php';
?>