<?php include 'menu_inicial.php';?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="../../view/public/css/adm/verificar_administrar_pedido.css">
    <link rel="stylesheet" href="https://fontawesome.com/icons/chevron-left?f=classic&s=solid">
</head>

<body class="verificar_administrar_pedidos_body">
    <main class="verificar_administrar_pedidos_content">
        <section class="verificar_administrar_pedidos_sessao_identificar">
            <a href="#" onclick="window.history.back(); return false;"class="verificar_administrar_pedidos_sessao_seta_voltar">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <div class="verificar_administrar_pedidos_sessao_bloco">
                <div class="verificar_administrar_pedidos_sessao_bloco_info">
                    <h1>Verificar e administrar pedidos</h1>
                    <h3>Pesquise o número do pedido ou CPF/CNPJ do cliente para gerenciar o pedido em específico</h3>
                    <form action="" class="verificar_administrar_pedidos_sessao_formulario_pesquisa">
                        <input type="text" id="" placeholder="Pesquisar">
                        <button type="submit"></button>
                    </form>
                </div>
            </div>
            <hr class="verificar_administrar_pedidos_sessao_divisao">
        </section>
        <section class="verificar_administrar_pedidos_sessao_visualizar">
            <div class="verificar_administrar_pedidos_sessao_pedidos">
                <div class="verificar_administrar_pedidos_sessao_pedidos_img">
                    <h5>Pedido XXXXXXXXXX</h5>
                    <img src="/PROJETO_INTEGRADOR/view/public/imagens/Rectangle 195.png" alt="">
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

<?php include 'footer.php';?>