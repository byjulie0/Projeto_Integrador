<?php
session_start();
include '../utils/autenticado.php';
if ($usuario_nao_logado) {
    include '../overlays/pop_up_login.php';
    exit;
}

// Adicionar headers para evitar cache
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

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
    // CORREÇÃO: Removida a duplicação
    if (isset($_GET['error']) && isset($_SESSION['popup_message'])) {
        $titulo = $_SESSION['titulo'];
        $texto = $_SESSION['popup_message'];

        // Marcar como sucesso se vier o parâmetro
        if (isset($_GET['sucess'])) {
            $sucesso = true;
        }
        include '../overlays/pop_up_erro.php';

        // Limpar a sessão APENAS UMA VEZ
        unset($_SESSION['titulo']);
        unset($_SESSION['popup_message']);
    }
    ?>

    <div class="main_cart_area">
        <div class="product_area_cart">
            <div class="area_seta_titulo">
                <a href="#" onclick="window.history.back(); return false;">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <h1 class="cart_title">Carrinho</h1>
            </div>

            <section class="product-cards-carrinho">
                <?php
                // CORREÇÃO: Adicionar verificação de produto_ativo
                $sql = "SELECT c.id_carrinho, c.quantidade, p.prod_nome, p.path_img, p.descricao, p.valor
                        FROM carrinho c
                        JOIN produto p ON c.id_produto = p.id_produto
                        WHERE c.id_cliente='$id_cliente' AND p.produto_ativo = 1";
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

    <script>
        // Prevenir cache do navegador
        window.onpageshow = function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        };

        // Função global para fechar pop-up
        function fecharPopup() {
            // Remove o pop-up da tela
            const popup = document.querySelector('.popup');
            if (popup) {
                popup.style.display = 'none';
            }
            // Recarrega a página para atualizar o carrinho
            setTimeout(function() {
                window.location.reload();
            }, 100);
        }

        // Adicionar event listeners quando o DOM carregar
        document.addEventListener('DOMContentLoaded', function () {
            // Event listener para o botão de fechar
            const fecharBtn = document.querySelector('.fechar_popup');
            if (fecharBtn) {
                fecharBtn.addEventListener('click', fecharPopup);
            }

            // Event listener para clicar fora do pop-up
            const popup = document.querySelector('.popup');
            if (popup) {
                popup.addEventListener('click', function(e) {
                    if (e.target === popup) {
                        fecharPopup();
                    }
                });
            }
        });
    </script>

    <?php include 'footer_cliente.php'; ?>
</body>
</html>