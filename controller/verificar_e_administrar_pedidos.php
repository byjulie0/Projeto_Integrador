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
            <div class="verificar_administrar_pedidos_sessao_bloco_info">
                <h1>Verificar e administrar pedidos</h1>
                <h3>Pesquise o número do pedido ou CPF/CNPJ do cliente para gerenciar o pedido em específico</h3>
                <input type="text" id="" placeholder="Pesquisar">
                <button type="submit"></button>
            </div>
            <div class="verificar_administrar_pedidos_sessao_mini_bloco_info">
                <h6>Filtre por pedido em andamento/finalizado/cancelado etc.</h6>
                <input type="text" id="" placeholder="Filtrar">
                <button type="submit"></button>
            </div>
            <hr>
        </section>
        <section class="verificar_administrar_pedidos_sessao_visualizar"></section>
    </main>
</body>
</html>

<?php
include 'footer_cliente.php';
?>