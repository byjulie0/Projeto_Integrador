
<?php include '../utils/validacao_login.php';?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Página Inicial</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/pg_inicial_cliente.css">
</head>
<body class="body_pg_inicial_cliente">
    <?php
    include 'menu_pg_inicial.php';
    include 'carrossel_pg_inicial.php';
    include 'categorias_pg_inicial.php';
    include 'campeoes.php';
    include 'mais_vendidos.php';
    include 'talvez_voce_goste.php';
    include 'footer_cliente.php';
    ?>
</body>
</html>



