<?php
// include '../utils/autenticado.php';
include '../utils/listar_pedidos_cliente.php';
include 'menu_pg_inicial.php';
?>
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
            <a href="#" onclick="window.history.back(); return false;" class="arrow_compras">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <h1 class="titulo_historico_compras">Histórico de Compras</h1>
        </div>
        
        <div class="area_historico_compras">
        <?php if (!empty($pedidos)): ?>
            <?php foreach ($pedidos as $pedido): ?>
            <div class="pedido_header">
                <div class="div_data_pedido_pc">
                    <p class="data_pedido_pc">Data do Pedido:</p>
                </div>
                <div class="botao_cancelar">
                    <?php
                        $texto = "Cancelar";
                        include 'botao_vermelho_cliente.php';
                    ?>
                </div>
            </div>
            
            <div class="atributos_pedido_mobile">
                <div class="div_data_pedido_mobile">
                    <p class="data_pedido_mobile">Data do Pedido:<span><?= htmlspecialchars($pedido['data_pedido'])?></span> </p>
                </div>
                <div class="pedido_detalhes">
                    <p class="codigo_pedido">Código do pedido:<span><?= htmlspecialchars($pedido['id_pedido'])?></span> </p>

                    <p class="total_itens">Total de itens:<span><?= htmlspecialchars($pedido['qtd_produto'])?></span> </p>

                    <p class="valor_pedido">Valor do pedido:<span><?= htmlspecialchars($pedido['valor'])?></span> </p>

                    <p class="status_pedido">Status do pedido:<span><?= htmlspecialchars($pedido['status_pedido'])?></span> </p>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif ?>
        </div>
    </div>

<?php include 'footer_cliente.php'; ?>
</body>
</html>
