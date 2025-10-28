<?php
include '../utils/autenticado_adm.php';
include "menu_inicial.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <link rel="stylesheet" href="../../view/public/css/adm/relatorios_visualizar.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="../../View/js/adm/relatorios_visualizar_adm.js"></script>

</head>

<body>
    <div class="relatorios_container">

        <!-- Cabeçalho -->
        <div class="relatorios_header"> <a href="#" onclick="window.history.back(); return false;"
                class="verificar_administrar_pedidos_sessao_seta_voltar"> <i class="bi bi-chevron-left"></i> <h1>Visualizar relatórios</h1> </a>
            <h3 class="verificar_administrar_pedidos_sessao_mini_titulos_1">Mostrando relatórios referentes ao período:
                <span class="verificar_administrar_pedidos_sessao_titulo_destaque" id="dataEscolhida">XX/XX/XXXX -
                    YY/YY/YYYY</span>
            </h3>
            <div class="verificar_administrar_pedidos_sessao_periodo_bloco"> <span
                    class="verificar_administrar_pedidos_sessao_mini_titulos_2" id="abrirCalendario">Mudar
                    período</span> <input type="text" id="dataInicio" style="display: none;"> <input type="text"
                    id="dataFim" style="display: none;">
                <hr class="verificar_administrar_pedidos_sessao_periodo_linha">
            </div>
        </div>

        <div class="relatorios_main">
            <div class="relatorios_cards_topo">
                <div class="card_topo"><i class="fa-solid fa-bag-shopping"></i>Produtos <br> cadastrados: <b>51</b> <i
                        class="fa-solid fa-chevron-right"></i></div>
                <div class="card_topo"><i class="fa-solid fa-cart-plus"></i>Pedidos <br> gerados: <b>0</b><i
                        class="fa-solid fa-chevron-right"></i></div>
                <div class="card_topo"><i class="fa-solid fa-users"></i>Usuários <br> cadastrados: <b>0</b><i
                        class="fa-solid fa-chevron-right"></i></div>
                <div class="card_estatisticas">
                    <h3>Estatísticas</h3>
                    <canvas id="graficoEstatisticas"></canvas>
                </div>
            </div>
            <div class="card_atividades">
                <h3>Atividades recentes:</h3>
                <p>Mostrar últimos 10 pedidos e informações importantes relacionados</p>
                <button class="btn_imprimir">📄 Imprimir Tabelas</button>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>

</body>

</html>