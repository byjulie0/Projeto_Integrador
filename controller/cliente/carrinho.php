<?php

// if ($_SESSION['funcao'] != 'CLIENTE'){
//     header("location: login.php");
//     exit();
//     }


include 'menu_pg_inicial.php';
require_once __DIR__ . '/../../model\DB/conexao.php'; // cria $con
session_start();

// É preciso fazer o PHP Seguindo o Molde do Matheus comm Mysqli Valdir em 05.09.2025

// 'cod estilo mateia '
// <?php
// session_start();
// include '../../model/DB/conexao.php'; // arquivo com a conexão ao banco

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Recebe dados do formulário
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     // Preparar consulta segura para evitar SQL Injection
//     $stmt = "SELECT * FROM user WHERE user_nome = '{$username}';";
//     echo $stmt;
//     $result = mysqli_query($con,$stmt);
//     $row = mysqli_num_rows($result);
//     echo $row;

//     if ($row>0){
        
//         $query = "select * from user";

//         $retorno = mysqli_fetch_array($result);
//         echo $retorno["user_nome"];
//         echo $retorno["senha"];

//         if ($retorno["senha"] == $password)
//         {
//             $_SESSION["username"] = $username;
//             header("Location: ../cliente/pg_inicial_cliente.php");
//         }
//         else{
//             echo  "senha invalida ";
//         }
//     }
    
// }
// ?>


?>

<!-- HTML DO CARRINHO-->

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
                <?php foreach ($itens as $item): ?>
                <div class="product-card-carrinho" data-price="<?= number_format($item['valor'], 2, '.', '') ?>">
                    <div class="product-title-area-carrinho">
                        <div class="check-btn-carrinho">
                            <input type="checkbox" class="product-checkbox" <?= $item['selecionado'] ? 'checked' : '' ?>>
                            <div class="check-square-carrinho"></div>
                            <span class="product-title-carrinho"><?= htmlspecialchars($item['prod_nome']) ?></span>
                        </div>
                        <div class="delete-item-btn-area-carrinho">
                            <button class="delete-item-carrinho" data-id="<?= $item['id_item'] ?>">Excluir</button>
                        </div>
                    </div>
                    <div class="separation-line-carrinho"></div>
                    <div class="product-carrinho">
                        <div class="non-labeled-content-carrinho">
                            <img src="<?= $item['imagem'] ?: '../../view/public/imagens/blank_image.png' ?>" alt="" class="product-img-carrinho">
                            <div class="title-and-description-carrinho">
                                <span class="product-name-carrinho"><?= htmlspecialchars($item['prod_nome']) ?></span>
                                <span class="product-description-carrinho"><?= htmlspecialchars($item['descricao']) ?></span>
                            </div>
                        </div>

                        <div class="labels-respective-content-carrinho">
                            <span class="product-price-carrinho">
                                R$: <span class="unit-price"><?= number_format($item['valor'], 2, ',', '.') ?></span>
                            </span>
                        </div>
                        <div class="labels-respective-content-carrinho">
                            <div class="change-quantity-carrinho">
                                <button class="change-quantity-btn-carrinho minus-btn" data-id="<?= $item['id_item'] ?>">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <span class="quantity-carrinho"><?= $item['quantidade'] ?></span>
                                <button class="change-quantity-btn-carrinho plus-btn" data-id="<?= $item['id_item'] ?>">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="labels-respective-content-carrinho">
                            <span class="total-price">
                                R$: <span class="product-total-price"><?= number_format($item['valor'] * $item['quantidade'], 2, ',', '.') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </section>
        </div>

        <section class="checkout-btns-carrinho">
            <div class="checkout-btns-space-carrinho">
                <h3 class="resumo_carrinho">Resumo da compra</h3>
                <span class="total_items_cart">Items: <span class="total-items-count"><?= $totalItensSelecionados ?></span></span>
                <div class="total-price-checkout-carrinho">
                    <span class="total-label-carrinho">
                        Total: R$: <span class="grand-total-price"><?= number_format($totalValor, 2, ',', '.') ?></span>
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
