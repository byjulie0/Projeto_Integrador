<?php 
include 'menu_pg_inicial.php';
require_once __DIR__ . '/../../model/DB/conexao.php';

$cliente_id = 27;
$stmt = $con->prepare("SELECT * 
                      FROM carrinho 
                      JOIN produto ON carrinho.produto_id_produto = produto.id_produto 
                      WHERE cliente_id_cliente = ?");
$stmt->bind_param("i", $cliente_id);
$stmt->execute();
$result = $stmt->get_result();
$row_count = $result->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/carrinho.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script defer src="../../view/js/cliente/carrinho.js"></script>
    <style>
        .checkout-btns-carrinho {
            position: sticky;
            top: 20px;
            background: --color-primary-6: #729762;;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-left: 20px;
            min-width: 300px;
        }
        
        .checkout-btns-space-carrinho {
            width: 100%;
        }
        
        .resumo_carrinho {
            margin-bottom: 15px;
            color: #333;
            font-size: 1.2em;
        }
        
        .total_items_cart {
            display: block;
            margin-bottom: 10px;
            font-size: 1em;
        }
        
        .total-price-checkout-carrinho {
            margin: 15px 0;
            font-size: 1.1em;
            font-weight: bold;
        }
        
        /* CORREÇÃO DOS CHECKBOXES - GARANTIR QUE ELES SEJAM VISÍVEIS */
        .check-btn-carrinho {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .check-box-label-carrinho {
            user-select: none;
            margin-left: 5px;
        }
        
        /* FORÇAR OS CHECKBOXES A SEREM VISÍVEIS */
        .select-all-checkbox, 
        .product-checkbox {
            width: 18px !important;
            height: 18px !important;
            margin: 0 !important;
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
            position: relative !important;
            z-index: 9999 !important;
        }
        
        /* Remover qualquer elemento que esteja cobrindo os checkboxes */
        .check-square-carrinho {
            display: none !important;
        }
        
        /* Garantir que os checkboxes não estejam sendo escondidos pelo CSS existente */
        input[type="checkbox"] {
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
    </style>
</head>

<body>
    <div class="main_cart_area">

        <table border="0" width="100%">
            <tr valign="top">
                <td width="70%">
                    <div class="product_area_cart">
                        <h1 class="cart_title">Carrinho</h1>

                        <section class="cart-header-carrinho">
                            <div class="cart-header-labels-carrinho">
                                <div class="check-btn-carrinho">
                                    <input type="checkbox" id="check-square-carrinho" class="select-all-checkbox">
                                    <label for="check-square-carrinho" class="check-box-label-carrinho">Selecionar tudo</label>
                                </div>
                                <div class="labels-carrinho">
                                    <span class="labels-themselves-carrinho">Preço unitário</span>
                                </div>
                                <div class="labels-carrinho">
                                    <span class="labels-themselves-carrinho">Quantidade</span>
                                </div>
                                <div class="labels-carrinho">
                                    <span class="labels-themselves-carrinho">Preço total</span>
                                </div>

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
                        </section>


                        <section class="product-cards-carrinho">
                            <?php if ($row_count > 0): ?>
                                <?php while ($retorno = $result->fetch_assoc()): ?>
                                    <div class="product-card-carrinho" data-price="<?= number_format($retorno['valor'], 2, '.', '') ?>" data-id="<?= $retorno['id_produto'] ?>">
                                        <div class="product-title-area-carrinho">
                                            <div class="check-btn-carrinho">
                                                <input type="checkbox" class="product-checkbox" checked>
                                                <span class="product-title-carrinho"><?= htmlspecialchars($retorno["prod_nome"]) ?></span>
                                            </div>
                                            <div class="delete-item-btn-area-carrinho">
                                                <button class="delete-item-carrinho" data-id="<?= $retorno['id_produto'] ?>">
                                                    <i class="fa-solid fa-trash"></i> Excluir
                                                </button>
                                            </div>
                                        </div>

                                        <div class="separation-line-carrinho"></div>

                                        <div class="product-carrinho">
                                            <img src="<?= htmlspecialchars($retorno["path_img"]) ?>" alt="<?= htmlspecialchars($retorno["prod_nome"]) ?>" class="product-img-carrinho">

                                            <div class="labels-respective-content-carrinho">
                                                <span class="product-price-carrinho">
                                                    R$ <span class="unit-price"><?= number_format($retorno['valor'], 2, ',', '.') ?></span>
                                                </span>
                                            </div>

                                            <div class="labels-respective-content-carrinho">
                                                <div class="change-quantity-carrinho">
                                                    <button class="change-quantity-btn-carrinho minus-btn" data-id="<?= $retorno['id_produto'] ?>">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </button>
                                                    <span class="quantity-carrinho"><?= $retorno['quantidade'] ?? 1 ?></span>
                                                    <button class="change-quantity-btn-carrinho plus-btn" data-id="<?= $retorno['id_produto'] ?>">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="labels-respective-content-carrinho">
                                                <span class="total-price">
                                                    R$ <span class="product-total-price"><?= number_format(($retorno['valor'] * ($retorno['quantidade'] ?? 1)), 2, ',', '.') ?></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <div class="empty-cart">
                                    <p>Seu carrinho está vazio</p>
                                </div>
                            <?php endif; ?>
                        </section>
                    </div>
                </td>

                <td width="30%">
                    <section class="checkout-btns-carrinho">
                        <div class="checkout-btns-space-carrinho">
                            <h3 class="resumo_carrinho">Resumo da compra</h3>
                            <span class="total_items_cart">Itens selecionados: <span class="total-items-count">0</span></span>
                            <div class="total-price-checkout-carrinho">
                                <span class="total-label-carrinho">
                                    Total: R$ <span class="grand-total-price">0,00</span>
                                </span>
                            </div>
                            <div class="separation-line-carrinho"></div>

                            <?php
                            $texto = "Fechar Pedido"; 
                            include 'botao_cliente.php';
                            ?>
                        </div>
                    </section>
                </td>
            </tr>
        </table>

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
$stmt->close();
include 'footer_cliente.php'; 

<?php
include 'footer_cliente.php';

?>