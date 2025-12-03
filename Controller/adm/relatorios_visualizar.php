<?php
include '../utils/autenticado_adm.php';
if ($adm_nao_logado) {
    include '../overlays/pop_up_login_adm.php';
    exit;
}
include "menu_inicial.php";

// === DATAS ===
$data_inicio = $_GET['data_inicio'] ?? date('Y-m-01');
$data_fim    = $_GET['data_fim']    ?? date('Y-m-t');

if (strtotime($data_inicio) > strtotime($data_fim)) {
    $temp = $data_inicio;
    $data_inicio = $data_fim;
    $data_fim = $temp;
}

$data_inicio_sql = mysqli_real_escape_string($con, $data_inicio);
$data_fim_sql    = mysqli_real_escape_string($con, $data_fim);

// === CONSULTAS ===
$pedidos_por_data = mysqli_fetch_all(mysqli_query($con, "SELECT DATE(data_pedido) AS data_pedido, COUNT(id_pedido) AS numero_pedidos
                           FROM pedido
                           WHERE data_pedido BETWEEN '$data_inicio_sql' AND '$data_fim_sql 23:59:59'
                           GROUP BY DATE(data_pedido)
                           ORDER BY DATE(data_pedido)"), MYSQLI_ASSOC);

$numero_pedidos  = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM pedido WHERE data_pedido BETWEEN '$data_inicio_sql' AND '$data_fim_sql 23:59:59'"))['total'] ?? 0;
$numero_produtos = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM produto WHERE produto_ativo = 1"))['total'] ?? 0;
$numero_usuarios = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM cliente WHERE user_ativo = 1"))['total'] ?? 0;

$estatisticas = ['Pendente' => 0, 'Concluído' => 0, 'Cancelado' => 0];
$result_estatisticas = mysqli_query($con, "SELECT status_pedido, COUNT(*) AS total FROM pedido WHERE data_pedido BETWEEN '$data_inicio_sql' AND '$data_fim_sql 23:59:59' GROUP BY status_pedido");
while ($row = mysqli_fetch_assoc($result_estatisticas)) {
    $estatisticas[$row['status_pedido']] = (int)$row['total'];
}

$ultimos_pedidos = mysqli_fetch_all(mysqli_query($con, "SELECT p.id_pedido, p.id_cliente, p.status_pedido, p.data_pedido, pr.valor 
                          FROM item i 
                          LEFT JOIN pedido p ON i.id_pedido = p.id_pedido 
                          LEFT JOIN produto pr ON pr.id_produto = i.id_produto 
                          ORDER BY p.data_pedido DESC LIMIT 10"), MYSQLI_ASSOC);

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios - Admin</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../View/public/css/adm/relatorios_visualizar.css">
    <script src="../../View/js/adm/relatorios_visualizar_adm.js"></script>
    <script>
        $.datepicker.regional['pt-BR'] = {
            closeText: "Fechar", prevText: "Anterior", nextText: "Próximo", currentText: "Hoje",
            monthNames: ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
            monthNamesShort: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
            dayNames: ["Domingo","Segunda-feira","Terça-feira","Quarta-feira","Quinta-feira","Sexta-feira","Sábado"],
            dayNamesShort: ["Dom","Seg","Ter","Qua","Qui","Sex","Sáb"],
            dayNamesMin: ["Dom","Seg","Ter","Qua","Qui","Sex","Sáb"],
            weekHeader: "Sm", dateFormat: "dd/mm/yy", firstDay: 0
        };
        $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
    </script>

    <!-- ARQUIVOS SEPARADOS -->
    <link rel="stylesheet" href="../../View/public/css/adm/relatorios_toast.css">
    <script src="../../View/public/js/adm/relatorios_toast.js"></script>
</head>
<body>

<div class="relatorios_container">
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

    <form id="formFiltroData" method="GET" action="relatorios_visualizar.php" style="display:none;">
        <input type="hidden" name="data_inicio" id="hiddenInicio" value="<?php echo $data_inicio; ?>">
        <input type="hidden" name="data_fim" id="hiddenFim" value="<?php echo $data_fim; ?>">
    </form>

    <div class="relatorios_main">
        <div class="relatorios_cards_topo">
            <div class="card_topo">Produtos ativos: <b><?php echo $numero_produtos; ?></b></div>
            <div class="card_topo">Pedidos gerados: <b><?php echo $numero_pedidos; ?></b></div>
            <div class="card_topo">Usuários ativos: <b><?php echo $numero_usuarios; ?></b></div>

            <div class="card_estatisticas"><h3>Estatísticas</h3><div class="grafico-container"><canvas id="graficoPizza"></canvas></div></div>
            <div class="grafico-barra"><h3>Pedidos por Status</h3><div class="grafico-container"><canvas id="graficoBarra"></canvas></div></div>
            <div class="grafico-linha"><h3>Pedidos ao Longo do Tempo</h3><div class="grafico-container"><canvas id="graficoLinha"></canvas></div></div>
        </div>
    </div>
</div>

<div class="card_atividades">
    <h3>Atividades recentes</h3>
    <p>Últimos 10 pedidos registrados:</p>
    <div class="table-responsive">
        <table class="tabela-pedidos">
            <thead>
                <tr><th>Cod Pedido</th><th>Cod Cliente</th><th>Status</th><th>Data</th><th>Valor Total</th></tr>
            </thead>
            <tbody>
                <?php foreach ($ultimos_pedidos as $p): ?>
                <tr>
                    <td><?php echo htmlspecialchars($p['id_pedido']); ?></td>
                    <td><?php echo htmlspecialchars($p['id_cliente']); ?></td>
                    <td><?php echo htmlspecialchars($p['status_pedido']); ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($p['data_pedido'])); ?></td>
                    <td>R$ <?php echo number_format($p['valor'], 2, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="btn_imprimir" id="btnGerarPDF">
        <?php $texto = "Imprimir Relatório"; include 'botao_verde_adm.php'; ?>
    </div>
</div>

<?php include "footer.php"; ?>

<div id="toast">
    <div class="titulo" id="toastTitulo"></div>
    <div class="mensagem" id="toastMensagem"></div>
    <span class="fechar" onclick="fecharToast()">&times;</span>
</div>

<script>
const estatisticas = <?php echo json_encode($estatisticas); ?>;
const pedidosPorData = <?php echo json_encode($pedidos_por_data); ?>;

new Chart($("#graficoPizza")[0], { type: 'pie', data: { labels: ['Pendente','Concluído','Cancelado'], datasets: [{ data: [estatisticas['Pendente']??0, estatisticas['Concluído']??0, estatisticas['Cancelado']??0], backgroundColor: ['#ffcc00','#4caf50','#f44336'] }] }, options: { responsive:true } });
new Chart($("#graficoBarra")[0], { type: 'bar', data: { labels: ['Pendente','Concluído','Cancelado'], datasets: [{ data: [estatisticas['Pendente']??0, estatisticas['Concluído']??0, estatisticas['Cancelado']??0], backgroundColor: ['#ffcc00','#4caf50','#f44336'] }] }, options: { responsive:true } });
new Chart($("#graficoLinha")[0], {
    type: 'line',
    data: {
        labels: pedidosPorData.map(p => new Date(p.data_pedido).toLocaleDateString('pt-BR', {day:'2-digit', month:'2-digit'})),
        datasets: [{ label: 'Pedidos', data: pedidosPorData.map(p => p.numero_pedidos), borderColor: '#3498db', tension: 0.3 }]
    },
    options: { responsive: true }
});
</script>

</body>
</html>