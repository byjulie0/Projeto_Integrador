<!-- HTML DO CARRINHO-->

<?php include 'menu_pg_inicial.php';
// include '../utils/carrinho2';
require_once __DIR__ . '/../../model/DB/conexao.php';


$stmt = "select * from carrinho join produto on carrinho.produto_id_produto = produto.id_produto WHERE cliente_id_cliente = 27;"; //teste busca banco
    // echo $stmt;
    $result = mysqli_query($con,$stmt);
    $row = mysqli_num_rows($result);
    // echo $row;


    
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

<table border="1">
<thead>
<tr>
<th>img</th>
<th>nome</th>

</tr>
</thead>
<?php while ($retorno = mysqli_fetch_array($result)){
?>
<tbody>
<tr>
<!-- <td ><?php 
// echo $retorno["path_img"];
?></td> -->
 <td ><img src="<?php echo $retorno["path_img"]; ?>" alt="" class="product-img-carrinho"></td>
 <td ><?php echo $retorno["prod_nome"]; ?></td>

</tr>
<?php }?>
</tbody>
</table>



    <div class="main_cart_area">
        <div class="product_area_cart">
            <h1 class="cart_title">Carrinho</h1>

            <section class="cart-header-carrinho">
                <div class="cart-header-labels-carrinho">
                    <div class="check-btn-carrinho">
                        <input type="checkbox" id="check-square-carrinho" class="select-all-checkbox">
                        <div class="check-square-carrinho"></div>
                        <label for="check-square" class="check-box-label-carrinho">Selecionar tudo</label>
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
                </div>
            </section>

            <section class="product-cards-carrinho">
                <div class="product-card-carrinho" data-price="<?= number_format($item['valor'], 2, '.', '') ?>">
                    <div class="product-title-area-carrinho">
                        <div class="check-btn-carrinho">
                            <input type="checkbox" class="product-checkbox" >
                            <div class="check-square-carrinho"></div>
                            <span class="product-title-carrinho"></span>
                        </div>
                        <div class="delete-item-btn-area-carrinho">
                            <button class="delete-item-carrinho" data-id="">Excluir</button>
                        </div>
                    </div>
                    <div class="separation-line-carrinho"></div>
                    <div class="product-carrinho">
                        <div class="non-labeled-content-carrinho">
                            <td ><img src="<?php echo $retorno["path_img"]; ?>" alt="" class="product-img-carrinho"></td>
                            <div class="title-and-description-carrinho">
                                <span class="product-name-carrinho"></span>
                                <td ><?php echo $retorno["prod_nome"]; ?></td>
                                <span class="product-description-carrinho"></span>
                            </div>
                        </div>

                        <div class="labels-respective-content-carrinho">
                            <span class="product-price-carrinho">
                                R$: <span class="unit-price"></span>
                            </span>
                        </div>
                        <div class="labels-respective-content-carrinho">
                            <div class="change-quantity-carrinho">
                                <button class="change-quantity-btn-carrinho minus-btn" data-id="<?= $item['id_item'] ?>">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <span class="quantity-carrinho"></span>
                                <button class="change-quantity-btn-carrinho plus-btn" data-id="<?= $item['id_item'] ?>">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="labels-respective-content-carrinho">
                            <span class="total-price">
                                R$: <span class="product-total-price"></span>
                            </span>
                        </div>
                    </div>
                </div>
            
            </section>
        </div>

        <section class="checkout-btns-carrinho">
            <div class="checkout-btns-space-carrinho">
                <h3 class="resumo_carrinho">Resumo da compra</h3>
                <span class="total_items_cart">Itens: <span class="total-items-count"></span></span>
                <div class="total-price-checkout-carrinho">
                    <span class="total-label-carrinho">
                        Total: R$: <span class="grand-total-price"></span>
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

<?php include 'footer_cliente.php'; ?>
