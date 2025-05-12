<?php
include 'menu_pg_inicial.php';
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="../view/public/css/cliente.css">
    <link rel="stylesheet" href="https://fontawesome.com/icons/chevron-left?f=classic&s=solid">
</head>
<body class="verificar_administrar_pedidos_body">
    <main class="verificar_administrar_pedidos_content">
        <section class="verificar_administrar_pedidos_sessao_identificar">
            <a href="" class="verificar_administrar_pedidos_sessao_seta_voltar">
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
                <div class="verificar_administrar_pedidos_sessao_mini_bloco_info">
                    <h6>Filtre por pedido em andamento/finalizado/cancelado etc.</h6>
                    <form action="" class="verificar_administrar_pedidos_sessao_formulario_filtrar">
                        <input type="text" id="" placeholder="Filtrar">
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
                    <img src="../view/public/Imagens/Rectangle 195.png" alt="">
                </div>
                <div class="verificar_administrar_pedidos_sessao_pedidos_info">
                    <h5>Boi Tal</h5>
                    <h6>Numero do pedido: XXXXXXXXXX</h6>
                    <h6>Comprador: XXXXXXXXXX</h6>
                    <h6>Data da compra: XXXXXXXXXX</h6>
                    <h6>Hora da compra: XXXXXXXXXX</h6>
                    <h6>Forma de pagamento: XXXXXXXXXX</h6>
                    <form action="" class="verificar_administrar_pedidos_sessao_pedidos_form">
                        <button type="submit">Verificar</button>
                    </form>
                </div>
                <i class="fa-solid fa-chevron-left"></i>
            </div>
        </section>
    </main>
</body>
</html>

<?php
include 'footer_cliente.php';
?>