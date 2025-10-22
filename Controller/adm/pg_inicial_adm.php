<?php
    include '../../Controller/utils/sessao_ativa_adm.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Página Inicial ADM</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/pg_inicial_cliente.css">
</head>

<body class="body_pg_inicial_cliente">
    <?php
    include 'menu_inicial.php';
    include '../cliente/carrossel_pg_inicial.php';
    include '../cliente/categorias_pg_inicial.php';
    include '../cliente/campeoes.php';
    include 'footer.php';
    ?>
</body>
</html>
