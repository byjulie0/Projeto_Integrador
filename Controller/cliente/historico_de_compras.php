<?php include 'menu_pg_inicial.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Compras</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/cliente/historico_de_compras.css">
</head>
<body>
    <div class="container_historico_compras">
 
        <div class="title_historico_compras">
            <a href="#" onclick="window.history.back(); return false;" class="arrow_compras">
                <i class="fa-solid fa-chevron-left">
                </i>
            </a>
            <h1 class="titulo_historico_compras">Histórico de Compras</h1>
        </div>
        
        <div class="area_historico_compras">
            
           <table class="table_historico_compras">

                <tr class="row_info row_header">
                    <th class="th_data_compras">Data do Pedido</th>
                    <th class="th_botao">
                        <?php
                            $texto = "Cancelar";
                            include 'botao_cancelar.php';
                        ?>
                    </th>
                </tr>

                <tr class="row_info row_detalhes">
                    <th class="th_codigo_compras">Código do pedido</th>
                    <th class="th_historico_compras">Total de itens</th>
                    <th class="th_historico_compras">Valor do pedido</th>
                    <th class="status_historico_compras">Status do pedido</th>
                </tr>
        </table>
        </div>
    </div>
    
</body>
</html>
<?php
include 'footer_cliente.php';
?>