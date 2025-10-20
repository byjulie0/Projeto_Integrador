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
                    </section>
                </td>
            </tr>
        </table>

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