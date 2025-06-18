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
<body class="verificar_administrar_pedidos_sessao_body">
    <main>
        <div class="verificar_administrar_pedidos_sessao_info">
            <a href="" class="verificar_administrar_pedidos_sessao_seta_voltar">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <h1>Visualizar relatórios</h1>
            <h3 class="verificar_administrar_pedidos_sessao_mini_titulos_1">Mostrando relatórios referentes ao período: <span class="verificar_administrar_pedidos_sessao_titulo_destaque">XX/XX/XXXX - YY/YY/YYYY</span></h3>
            <h3 class="verificar_administrar_pedidos_sessao_mini_titulos_2">Mudar período</h3>
        </div>
        
        <section class="verificar_administrar_pedidos_sessao_section">
            <div class="verificar_administrar_pedidos_sessao_mini_section">
                <div class="verificar_administrar_pedidos_sessao_coluna">
                    <div class="verificar_administrar_pedidos_sessao_bloco"></div>
                    <div class="verificar_administrar_pedidos_sessao_bloco"></div>
                </div>
                <div class="verificar_administrar_pedidos_sessao_coluna">
                    <div class="verificar_administrar_pedidos_sessao_bloco"></div>
                    <div class="verificar_administrar_pedidos_sessao_bloco"></div>
                </div>
            </div>
            <!-- <div class="verificar_administrar_pedidos_sessao_bloco_5"></div>
            <div class="verificar_administrar_pedidos_sessao_bloco_6"></div>
            <div class="verificar_administrar_pedidos_sessao_bloco_7"></div> -->
        </section>

    </main>
</body>
</html>

<?php
include "../adm/footer_adm.php";
?>