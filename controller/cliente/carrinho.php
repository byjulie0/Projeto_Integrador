<!-- Ana Julia e Isabella -->
<?php
include 'menu_pg_inicial.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="../../view/js/carrinho.js"></script>


</head>

<body>
    <div class="main_cart_area">
        <div class="product_area_cart">
            <?php include 'setas.php'; ?>
            <h1 class="cart_title">Carrinho</h1>

            <section class="cart-header-carrinho">
                <div class="cart-header-labels-carrinho">
                    <div class="check-btn-carrinho">
                        <input type="checkbox" id="check-square-carrinho" class="select-all-checkbox">
                        <div class="check-square-carrinho"></div>
                        <label for="check-square" class="check-box-label-carrinho">Selecionar tudo</label>
                    </div>
                    <div class="labels-carrinho">
                        <span class="labels-themselves-carrinho">
                            Preço unitário
                        </span>
                    </div>
                    <div class="labels-carrinho">
                        <span class="labels-themselves-carrinho">
                            Quantidade
                        </span>
                    </div>
                    <div class="labels-carrinho">
                        <span class="labels-themselves-carrinho">
                            Preço total
                        </span>
                    </div>
                </div>
            </section>
            <section class="product-cards-carrinho">
                <div class="product-card-carrinho" data-price="50.00">
                    <div class="product-title-area-carrinho">
                        <div class="check-btn-carrinho">
                            <input type="checkbox" class="product-checkbox">
                            <div class="check-square-carrinho"></div>
                            <span class="product-title-carrinho">
                                Bovino - Nelore
                            </span>
                        </div>
                        <div class="delete-item-btn-area-carrinho">
                            <button class="delete-item-carrinho">
                                Excluir
                            </button>
                        </div>
                    </div>
                    <div class="separation-line-carrinho">
                    </div>
                    <div class="product-carrinho">
                        <div class="non-labeled-content-carrinho">
                            <img src="../../view/public/imagens/blank_image.png" alt="" class="product-img-carrinho">
                            <div class="title-and-description-carrinho">
                                <span class="product-name-carrinho">
                                    Bovino da raça nelore
                                </span>
                                <span class="product-description-carrinho">
                                    descrição (...)
                                </span>
                            </div>
                        </div>

                        <div class="labels-respective-content-carrinho">
                            <span class="product-price-carrinho">
                                R$: <span class="unit-price">50,00</span>
                            </span>
                        </div>
                        <div class="labels-respective-content-carrinho">
                            <div class="change-quantity-carrinho">
                                <button class="change-quantity-btn-carrinho minus-btn">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <span class="quantity-carrinho">
                                    1
                                </span>
                                <button class="change-quantity-btn-carrinho plus-btn">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="labels-respective-content-carrinho">
                            <span class="total-price">
                                R$: <span class="product-total-price">50,00</span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="product-card-carrinho" data-price="75.00">
                    <div class="product-title-area-carrinho">
                        <div class="check-btn-carrinho">
                            <input type="checkbox" class="product-checkbox">
                            <div class="check-square-carrinho"></div>
                            <span class="product-title-carrinho">
                                Cavalo - Mangalarga
                            </span>
                        </div>
                        <div class="delete-item-btn-area-carrinho">
                            <button class="delete-item-carrinho">
                                Excluir
                            </button>
                        </div>
                    </div>
                    <div class="separation-line-carrinho">
                    </div>
                    <div class="product-carrinho">
                        <div class="non-labeled-content-carrinho">
                            <img src="../../view/public/imagens/blank_image.png" alt="" class="product-img-carrinho">
                            <div class="title-and-description-carrinho">
                                <span class="product-name-carrinho">
                                    Cavalo da raça Mangalarga
                                </span>
                                <span class="product-description-carrinho">
                                    descrição (...)
                                </span>
                            </div>
                        </div>

                        <div class="labels-respective-content-carrinho">
                            <span class="product-price-carrinho">
                                R$: <span class="unit-price">75,00</span>
                            </span>
                        </div>
                        <div class="labels-respective-content-carrinho">
                            <div class="change-quantity-carrinho">
                                <button class="change-quantity-btn-carrinho minus-btn">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <span class="quantity-carrinho">
                                    1
                                </span>
                                <button class="change-quantity-btn-carrinho plus-btn">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="labels-respective-content-carrinho">
                            <span class="total-price">
                                R$: <span class="product-total-price">75,00</span>
                            </span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <section class="checkout-btns-carrinho">
            <div class="checkout-btns-space-carrinho">
                <h3 class="resumo_carrinho">Resumo da compra</h3>
                <span class="total_items_cart">Items: <span class="total-items-count">2</span></span>
                <div class="total-price-checkout-carrinho">
                    <span class="total-label-carrinho">
                        Total: R$: <span class="grand-total-price">125,00</span>
                    </span>
                </div>
                <div class="separation-line-carrinho">
                </div>

                <?php
                $texto = "Fechar Pedido"; // Defina o texto do botão aqui
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