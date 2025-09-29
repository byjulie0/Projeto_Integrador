<?php include 'menu_inicial.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="../../view/public/css/adm/verificar_administrar_pedido.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body class="verificar_administrar_pedidos_body">
    <main class="verificar_administrar_pedidos_content">
        <section class="verificar_administrar_pedidos_sessao_identificar">

            <div class="verificar_administrar_pedidos_sessao_bloco">
                <div class="verificar_administrar_pedidos_sessao_bloco_info">
                    <div class="verificar_administrar_pedidos_sessao_seta_voltar_div">
                        <a href="#" onclick="window.history.back(); return false;"
                            class="verificar_administrar_pedidos_sessao_seta_voltar">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        <h1>
                            Verificar e administrar pedidos
                        </h1>
                    </div>

                    <form action="" method="GET" class="verificar_administrar_pedidos_sessao_formulario_pesquisa">
                        <div class="div_pesquisa">

                            <input type="text" name="pesquisa" placeholder="Pesquisar"></i>
                            <button type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>

                </div>
            </div>
            <hr class="verificar_administrar_pedidos_sessao_divisao">
        </section>
        <section class="verificar_administrar_pedidos_sessao_visualizar">
            <div class="verificar_administrar_pedidos_sessao_pedidos">
                <div class="verificar_administrar_pedidos_sessao_pedidos_img">
                    <h5>Pedido XXXXXXXXXX</h5>
                    <img src="../../View/Public/Imagens/Rectangle 195.png" alt="">
                </div>
                <div class="verificar_administrar_pedidos_sessao_pedidos_info">
                    <h5>Boi Tal</h5>
                    <h6>Número do pedido: <span
                            class="verificar_administrar_pedidos_sessao_pedidos_info_item">XXXXXXXXXX</span></h6>
                    <h6>Comprador: <span
                            class="verificar_administrar_pedidos_sessao_pedidos_info_item">XXXXXXXXXX</span></h6>
                    <h6>Data da compra: <span
                            class="verificar_administrar_pedidos_sessao_pedidos_info_item">XXXXXXXXXX</span></h6>
                    <h6>Hora da compra: <span
                            class="verificar_administrar_pedidos_sessao_pedidos_info_item">XXXXXXXXXX</span></h6>
                    <h6>Forma de pagamento: <span
                            class="verificar_administrar_pedidos_sessao_pedidos_info_item">XXXXXXXXXX</span></h6>
                    <form action="" class="verificar_administrar_pedidos_sessao_pedidos_form">
                        <?php
                        $texto = "Verificar";
                        include 'botao_adm.php';
                        ?>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>

</html>

<?php include 'footer.php'; ?>