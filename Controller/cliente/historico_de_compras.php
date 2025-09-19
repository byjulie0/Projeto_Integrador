<?php include 'menu_pg_inicial.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Histórico de Compras</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="../../view/public/css/cliente/historico_de_compras.css" />
</head>
<body class="body_historico_compras">
    <div class="container_historico_compras">

        <div class="title_historico_compras">
            <a href="#" onclick="window.history.back(); return fAalse;" class="arrow_compras">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <h1 class="titulo_historico_compras">Histórico de Compras</h1>
        </div>
        
        <div class="area_historico_compras">

            <div class="pedido_header">
                <div class="div_data_pedido">
                    <p class="data_pedido">Data do Pedido:</p>
                </div>
                <div class="botao_cancelar">
                    <?php
                        $texto = "Cancelar";
                        include 'botao_cancelar.php';
                    ?>
                </div>
            </div>

            <div class="pedido_detalhes">
                <p class="codigo_pedido">Código do pedido<span>:</span> </p>

                <p class="total_itens">Total de itens<span>:</span> </p>

                <p class="valor_pedido">Valor do pedido<span>:</span> </p>

                <p class="status_pedido">Status do pedido<span>:</span> </p>
            </div>

        </div>
    </div>

<?php include 'footer_cliente.php'; ?>
</body>
</html>
