<?php
include '../utils/autenticado_adm.php';
if ($adm_nao_logado) {
    include '../overlays/pop_up_login_adm.php';
    exit;
}
include "menu_inicial.php";

// === RECEBE AS DATAS DO GET OU DEFINE PADRÃO (mês atual) ===
$data_inicio = $_GET['data_inicio'] ?? date('Y-m-01');
$data_fim    = $_GET['data_fim']    ?? date('Y-m-t');

// Garante que a data inicial nunca seja maior que a final
if (strtotime($data_inicio) > strtotime($data_fim)) {
    $temp        = $data_inicio;
    $data_inicio = $data_fim;
    $data_fim    = $temp;
}

// Escapa para evitar SQL Injection (melhor ainda seria usar prepared statements)
$data_inicio_sql = mysqli_real_escape_string($con, $data_inicio);
$data_fim_sql    = mysqli_real_escape_string($con, $data_fim);

// === CONSULTAS ===
// Pedidos por dia no período
$query_pedidos_por_data = "SELECT DATE(data_pedido) AS data_pedido, COUNT(id_pedido) AS numero_pedidos
                           FROM pedido
                           WHERE data_pedido BETWEEN '$data_inicio_sql' AND '$data_fim_sql 23:59:59'
                           GROUP BY DATE(data_pedido)
                           ORDER BY DATE(data_pedido)";
$result_pedidos_por_data = mysqli_query($con, $query_pedidos_por_data);
$pedidos_por_data = [];
while ($row = mysqli_fetch_assoc($result_pedidos_por_data)) {
    $pedidos_por_data[] = $row;
}

// Total de pedidos no período
$query_pedidos = "SELECT COUNT(id_pedido) AS Numero_De_Pedidos 
                  FROM pedido 
                  WHERE data_pedido BETWEEN '$data_inicio_sql' AND '$data_fim_sql 23:59:59'";
$numero_pedidos = mysqli_fetch_assoc(mysqli_query($con, $query_pedidos))['Numero_De_Pedidos'] ?? 0;

// Produtos ativos
$query_produtos = "SELECT COUNT(id_produto) AS Numero_De_Produtos FROM produto WHERE produto_ativo = 1";
$numero_produtos = mysqli_fetch_assoc(mysqli_query($con, $query_produtos))['Numero_De_Produtos'] ?? 0;

// Usuários ativos
$query_usuarios = "SELECT COUNT(id_cliente) AS Numero_De_Usuarios FROM cliente WHERE user_ativo = 1";
$numero_usuarios = mysqli_fetch_assoc(mysqli_query($con, $query_usuarios))['Numero_De_Usuarios'] ?? 0;

// Estatísticas por status
$query_estatisticas = "SELECT status_pedido, COUNT(id_pedido) AS Numero_De_Pedidos 
                       FROM pedido 
                       WHERE data_pedido BETWEEN '$data_inicio_sql' AND '$data_fim_sql 23:59:59'
                       GROUP BY status_pedido";
$result_estatisticas = mysqli_query($con, $query_estatisticas);
$estatisticas = [];
while ($row = mysqli_fetch_assoc($result_estatisticas)) {
    $estatisticas[$row['status_pedido']] = (int)$row['Numero_De_Pedidos'];
}

// Últimos 10 pedidos (independente do filtro de data)
$query_ultimos_pedidos = "
    SELECT p.id_pedido, p.id_cliente, p.status_pedido, p.data_pedido, pr.valor 
    FROM item i
    LEFT JOIN pedido p ON i.id_pedido = p.id_pedido
    LEFT JOIN produto pr ON pr.id_produto = i.id_produto
    ORDER BY p.data_pedido DESC
    LIMIT 10";
$result_ultimos_pedidos = mysqli_query($con, $query_ultimos_pedidos);
$ultimos_pedidos = [];
while ($row = mysqli_fetch_assoc($result_ultimos_pedidos)) {
    $ultimos_pedidos[] = $row;
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios - Painel Administrativo</title>

    <!-- jQuery + jQuery UI (para o datepicker) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Seu CSS -->
    <link rel="stylesheet" href="../../View/public/css/adm/relatorios_visualizar.css">

    <style>
        .ui-datepicker .range-start { background: #007bff !important; color: white !important; }
        .ui-datepicker .ui-state-highlight { background: #ffcc00; }
    </style>
</head>
<body>

<div class="relatorios_container">

    <!-- CABEÇALHO COM SELETOR DE PERÍODO -->
    <div class="relatorios_header">
        <div class="verificar_administrar_pedidos_sessao_periodo_bloco">
            <h3 class="verificar_administrar_pedidos_sessao_mini_titulos_1">
                Mostrando relatórios referentes ao período:
                <span class="verificar_administrar_pedidos_sessao_titulo_destaque" id="periodoSelecionado">
                    <?php echo date('d/m/Y', strtotime($data_inicio)) . ' - ' . date('d/m/Y', strtotime($data_fim)); ?>
                </span>
            </h3>
            <button type="button" id="btnMudarPeriodo" class="verificar_administrar_pedidos_sessao_mini_titulos_2">
                Mudar período
            </button>
        </div>
    </div>

    <!-- FORMULÁRIO INVISÍVEL PARA ENVIAR AS DATAS -->
    <form id="formFiltroData" method="GET" action="relatorios_visualizar.php" style="display:none;">
        <input type="hidden" name="data_inicio" id="hiddenInicio" value="<?php echo $data_inicio; ?>">
        <input type="hidden" name="data_fim"    id="hiddenFim"    value="<?php echo $data_fim; ?>">
    </form>

    <!-- CARDS E GRÁFICOS -->
    <div class="relatorios_main">
        <div class="relatorios_cards_topo">
            <div class="card_topo">
                <i class="fa-solid fa-bag-shopping"></i> Produtos <br> ativos: 
                <b><?php echo $numero_produtos; ?></b>
            </div>
            <div class="card_topo">
                <i class="fa-solid fa-cart-plus"></i> Pedidos <br> gerados: 
                <b><?php echo $numero_pedidos; ?></b>
            </div>
            <div class="card_topo">
                <i class="fa-solid fa-users"></i> Usuários <br> ativos: 
                <b><?php echo $numero_usuarios; ?></b>
            </div>

            <!-- Gráficos (vão ser criados pelo JS no final) -->
            <div class="card_estatisticas">
                <h3>Estatísticas</h3>
                <div class="grafico-container"><canvas id="graficoPizza"></canvas></div>
            </div>
            <div class="grafico-barra">
                <h3>Pedidos por Status</h3>
                <div class="grafico-container"><canvas id="graficoBarra"></canvas></div>
            </div>
            <div class="grafico-linha">
                <h3>Pedidos ao Longo do Tempo</h3>
                <div class="grafico-container"><canvas id="graficoLinha"></canvas></div>
            </div>
        </div>
    </div>
</div>

<!-- ÚLTIMOS PEDIDOS -->
<div class="card_atividades">
    <h3>Atividades recentes</h3>
    <p>Últimos 10 pedidos registrados:</p>
    <div class="table-responsive">
        <table class="tabela-pedidos">
            <thead>
                <tr>
                    <th>Cod Pedido</th>
                    <th>Cod Cliente</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ultimos_pedidos)): ?>
                    <?php foreach ($ultimos_pedidos as $pedido): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($pedido['id_pedido']); ?></td>
                            <td><?php echo htmlspecialchars($pedido['id_cliente']); ?></td>
                            <td><?php echo htmlspecialchars($pedido['status_pedido']); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?></td>
                            <td>R$ <?php echo number_format($pedido['valor'], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">Nenhum pedido encontrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="btn_imprimir" id="btnGerarPDF">
        <?php
        $texto = "Imprimir Relatório";
        include 'botao_verde_adm.php';
        ?>
    </div>
</div>

<?php include "footer.php"; ?>

<!-- SCRIPT DO CALENDÁRIO + GRÁFICOS -->
<script>
$(function() {
    // === BOTÃO QUE ABRE O CALENDÁRIO COM DOIS CLIQUES ===
    $("#btnMudarPeriodo").on("click", function() {
        $("<div id='dialogCalendario'>").dialog({
            modal: true,
            title: "Selecionar Período",
            width: 420,
            open: function() {
                $(this).html(`
                    <p style="margin-bottom:15px;"><strong>Clique na data inicial e depois na data final.</strong></p>
                    <div id="datepicker"></div>
                `);

                let dataInicialSelecionada = null;

                $("#datepicker").datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                    firstDay: 1,
                    onSelect: function(dateText) {
                        if (!dataInicialSelecionada) {
                            // Primeira data
                            dataInicialSelecionada = dateText;
                            $(this).find(".ui-state-highlight").removeClass("ui-state-highlight");
                            $(this).find("a.ui-state-active").removeClass("ui-state-active");
                            $(this).find(`td a:contains('${dateText.split('-')[2]}')`)
                                .filter(function() {
                                    return $(this).text() == dateText.split('-')[2];
                                })
                                .addClass("range-start");
                            alert("Data inicial: " + dateText + "\nAgora clique na data final.");
                        } else {
                            // Segunda data
                            const dataFinal = dateText;
                            if (new Date(dataInicialSelecionada) > new Date(dataFinal)) {
                                alert("A data inicial deve ser anterior à data final!");
                                dataInicialSelecionada = null;
                                location.reload(); // limpa seleção errada
                                return;
                            }

                            // Atualiza campos hidden e submete
                            $("#hiddenInicio").val(dataInicialSelecionada);
                            $("#hiddenFim").val(dataFinal);

                            // Atualiza texto na tela
                            const formatadaInicio = $.datepicker.formatDate('dd/mm/yy', new Date(dataInicialSelecionada));
                            const formatadaFim    = $.datepicker.formatDate('dd/mm/yy', new Date(dataFinal));
                            $("#periodoSelecionado").text(formatadaInicio + " - " + formatadaFim);

                            $("#formFiltroData").submit();
                        }
                    }
                });

                // Marca o período atual ao abrir
                if ("<?php echo $data_inicio; ?>" && "<?php echo $data_fim; ?>") {
                    $("#datepicker").datepicker("setDate", new Date("<?php echo $data_inicio; ?>"));
                }
            },
            close: function() {
                $(this).remove();
            }
        });
    });

    // === GRÁFICOS CHART.JS ===
    const estatisticas = <?php echo json_encode($estatisticas); ?>;

    // Pizza
    new Chart(document.getElementById('graficoPizza'), {
        type: 'pie',
        data: {
            labels: ['Pendente', 'Concluído', 'Cancelado'],
            datasets: [{
                data: [
                    estatisticas['Pendente'] ?? 0,
                    estatisticas['Concluído'] ?? 0,
                    estatisticas['Cancelado'] ?? 0
                ],
                backgroundColor: ['#ffcc00', '#4caf50', '#f44336']
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    // Barra
    new Chart(document.getElementById('graficoBarra'), {
        type: 'bar',
        data: {
            labels: ['Pendente', 'Concluído', 'Cancelado'],
            datasets: [{
                label: 'Pedidos',
                data: [
                    estatisticas['Pendente'] ?? 0,
                    estatisticas['Concluído'] ?? 0,
                    estatisticas['Cancelado'] ?? 0
                ],
                backgroundColor: ['#ffcc00', '#4caf50', '#f44336']
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });

    // Linha - pedidos por dia
    const pedidosPorData = <?php echo json_encode($pedidos_por_data); ?>;
    new Chart(document.getElementById('graficoLinha'), {
        type: 'line',
        data: {
            labels: pedidosPorData.map(p => {
                const d = new Date(p.data_pedido);
                return d.getDate().toString().padStart(2,'0') + '/' + (d.getMonth()+1).toString().padStart(2,'0');
            }),
            datasets: [{
                label: 'Pedidos',
                data: pedidosPorData.map(p => p.numero_pedidos),
                borderColor: '#007bff',
                backgroundColor: '#007bff',
                tension: 0.3,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });
});
</script>

</body>
</html>