<?php
include "../adm/menu_adm.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <link rel="stylesheet" href="/PROJETO_INTEGRADOR/view/public/css/adm.css">
    <link rel="stylesheet" href="/PROJETO_INTEGRADOR/view/public/css/cliente.css">
    <link rel="stylesheet" href="https://fontawesome.com/icons/chevron-left?f=classic&s=solid">
</head>
<body>
    <main>
        <a href="" class="verificar_administrar_pedidos_sessao_seta_voltar">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <div>
            <h1>Visualizar relatórios</h1>
            <h3>Mostrando relatórios referentes ao período: <span>XX/XX/XXXX - YY/YY/YYYY</span></h3>
            <h3>Mudar período</h3>
        </div>
        <section class="dn_section">
            <div class="dn_views">
                <div class="dn_box-img"><img src="../imagens/View.svg" alt=""></div>
                <p class="coisa">visualizaçoes</p>
                <p class="coisa2">totais do site:</p>  <img class="dn_img"src="" alt="">
                <p class="coisa3">0</p>
            </div>
            <div class="dn_sales">
                <div class="dn_box-img2"><img src="" alt=""></div>
                <p>Vendas:0</p>  <img class="dn_img2"src="" alt="">
                
            </div>
            <div class="dn_total-products">
                <div class="dn_box-img3"><img src="" alt=""></div>
                <p>Total de</p>
                <p>produtos cadastrados:</p>  <img class="dn_img3"src="" alt="">
                <p>0</p>
            </div>
            <div class="dn_total-users">
                <div class="dn_box-img4"><img src="" alt=""></di>
                <p>Usuários</p>
                <p>cadastrados:</p>  <img class="dn_img4"src="" alt="">
                <p>0</p>
            </div>
            <div class="dn_sales-today">

            </div>
            <div class="dn_statics">

            </div>
            <div class="dn_atividade">

            </div>
        </section>
    </main>
</body>
</html>

<?php
include "../adm/footer_adm.php";
?>