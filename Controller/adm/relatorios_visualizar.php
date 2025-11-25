
<?php 
include "menu_inicial.php"; 
include '../../model/DB/conexao.php';  

// intervalo de datas dinâmico (vindo do GET ou valores padrão)
$data_inicio = isset($_GET['data_inicio']) ? $_GET['data_inicio'] : date('Y-m-01'); // primeiro dia do mês atual
$data_fim = isset($_GET['data_fim']) ? $_GET['data_fim'] : date('Y-m-t'); // último dia do mês
       
// quantidade de pedidos por data 
$query_pedidos_por_data = "SELECT DATE(data_pedido) AS data_pedido, COUNT(id_pedido) AS numero_pedidos
                           FROM pedido
                           WHERE data_pedido BETWEEN '$data_inicio' AND '$data_fim'
                           GROUP BY DATE(data_pedido)
                           ORDER BY DATE(data_pedido)";
$result_pedidos_por_data = mysqli_query($con, $query_pedidos_por_data);
$pedidos_por_data = [];
while ($row = mysqli_fetch_assoc($result_pedidos_por_data)) {
    $pedidos_por_data[] = [
        'data_pedido' => $row['data_pedido'],
        'numero_pedidos' => $row['numero_pedidos']
    ];
}

// Consultas SQllllll
$query_pedidos = "SELECT COUNT(id_pedido) AS Numero_De_Pedidos FROM pedido WHERE data_pedido BETWEEN '$data_inicio' AND '$data_fim'";
$result_pedidos = mysqli_query($con, $query_pedidos);
$numero_pedidos = mysqli_fetch_assoc($result_pedidos)['Numero_De_Pedidos'];

$query_produtos = "SELECT COUNT(id_produto) AS Numero_De_Produtos FROM produto WHERE produto_ativo = 1";
$result_produtos = mysqli_query($con, $query_produtos);
$numero_produtos = mysqli_fetch_assoc($result_produtos)['Numero_De_Produtos'];

$query_usuarios = "SELECT COUNT(id_cliente) AS Numero_De_Usuarios FROM cliente WHERE user_ativo = 1";
$result_usuarios = mysqli_query($con, $query_usuarios);
$numero_usuarios = mysqli_fetch_assoc($result_usuarios)['Numero_De_Usuarios'];

$query_estatisticas = "SELECT status_pedido, COUNT(id_pedido) AS Numero_De_Pedidos FROM pedido WHERE data_pedido BETWEEN '$data_inicio' AND '$data_fim' GROUP BY status_pedido";
$result_estatisticas = mysqli_query($con, $query_estatisticas);
$estatisticas = [];
while ($row = mysqli_fetch_assoc($result_estatisticas)) {
    $estatisticas[$row['status_pedido']] = $row['Numero_De_Pedidos'];
}

// Buscar os 10 pedidos mais recentes
$query_ultimos_pedidos = "
     select p.id_pedido, p.id_cliente, p.status_pedido, p.data_pedido, pr.valor from item as i left join pedido as p on i.id_pedido = p.id_pedido left join produto as pr on pr.id_produto = i.id_produto 
	ORDER BY data_pedido DESC 
    LIMIT 10;
";
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
    <title>Relatórios</title>
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../../View/public/css/adm/relatorios_visualizar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="../../View/js/adm/relatorios_visualizar_adm.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    
</head>

<body>
    <div class="relatorios_container">

    
        <div class="relatorios_header"> 
            <!-- <div class="titulo_seta">
                <a href="#" onclick="window.history.back(); return false;" class="verificar_administrar_pedidos_sessao_seta_voltar"> 
                    <i class="bi bi-chevron-left"></i> 
               </a>
               <h1>Visualizar relatórios</h1>
            </div> -->
        
            <div class="verificar_administrar_pedidos_sessao_periodo_bloco">
                <h3 class="verificar_administrar_pedidos_sessao_mini_titulos_1">Mostrando relatórios referentes ao período:
                     <span class="verificar_administrar_pedidos_sessao_titulo_destaque" id="dataEscolhida"><?php echo date('d/m/Y', strtotime($data_inicio)) . ' - ' . date('d/m/Y', strtotime($data_fim)); ?></span>
                </h3>
                <span class="verificar_administrar_pedidos_sessao_mini_titulos_2" id="abrirCalendario">Mudar período</span>
                <input type="text" id="dataInicio" style="display: none;" value="<?php echo $data_inicio; ?>">
                <input type="text" id="dataFim" style="display: none;" value="<?php echo $data_fim; ?>">
                <hr class="verificar_administrar_pedidos_sessao_periodo_linha">
            </div>
        </div>

        <div class="relatorios_main">
            <div class="relatorios_cards_topo">
                <!-- Card de Produtos -->
                <div class="card_topo">
                    <i class="fa-solid fa-bag-shopping"></i> Produtos <br> cadastrados: 
                    <b><?php echo $numero_produtos; ?></b>
                </div>

                <!-- Card de Pedidos -->
                <div class="card_topo">
                    <i class="fa-solid fa-cart-plus"></i> Pedidos <br> gerados: 
                    <b><?php echo $numero_pedidos; ?></b>
                </div>

                <!-- Card de Usuários -->
                <div class="card_topo">
                    <i class="fa-solid fa-users"></i> Usuários <br> cadastrados: 
                    <b><?php echo $numero_usuarios; ?></b>
                </div>

                <!-- Gráfico de Pizza - Estatísticas -->
                <div class="card_estatisticas">
                    <h3>Estatísticas</h3>
                    <div class="grafico-container">
                        <canvas id="graficoEstatisticas"></canvas>
                    </div>
                </div>

                <!-- Gráfico de Barra -->
                <div class="grafico-barra">
                    <h3>Número de Pedidos por Status</h3>
                    <div class="grafico-container">
                        <canvas id="graficoBarraEstatisticas"></canvas>
                    </div>
                </div>

                <!-- Gráfico de Linha -->
                <div class="grafico-linha">
                    <h3>Pedidos ao Longo do Tempo</h3>
                    <div class="grafico-container">
                        <canvas id="graficoLinhaPedidos"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card de Atividades Recentes -->
    <div class="card_atividades">
        <h3>Atividades recentes</h3>
        <p>Últimos 10 pedidos registrados:</p>

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
                    <tr>
                        <td colspan="5">Nenhum pedido encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="btn_imprimir" id="btnGerarPDF">
            <?php
            $texto = "Imprimir Relatório";
            include 'botao_verde_adm.php';
            ?>
        </div>
    </div>
    <footer> 
        <?php include "footer.php"; ?>
    </footer>

    <script>
        // Configuração unificada para todos os gráficos
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + '   pedidos';
                        }
                    }
                }
            }
        };
    
        // Gerar gráfico de pizza com os dados de status dos pedidos
        var estatisticas = <?php echo json_encode($estatisticas); ?>;
        var ctx = document.getElementById('graficoEstatisticas').getContext('2d');
        var grafico = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pendente', 'Concluído', 'Cancelado'],
                datasets: [{
                    data: [
                        estatisticas['Pendente'] || 0,
                        estatisticas['Concluído'] || 0,
                        estatisticas['Cancelado'] || 0
                    ],
                    backgroundColor: ['#ffcc00', '#4caf50', '#f44336'],
                }]
            },
            options: {
                ...chartOptions,
                plugins: {
                    ...chartOptions.plugins,
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    
        // Gerar gráfico de barra para a distribuição dos pedidos por status
        var ctxBarra = document.getElementById('graficoBarraEstatisticas').getContext   ('2d');
        var graficoBarra = new Chart(ctxBarra, {
            type: 'bar',
            data: {
                labels: ['Pendente', 'Concluído', 'Cancelado'],
                datasets: [{
                    label: 'Número de Pedidos',
                    data: [
                        estatisticas['Pendente'] || 0,
                        estatisticas['Concluído'] || 0,
                        estatisticas['Cancelado'] || 0
                    ],
                    backgroundColor: ['#ffcc00', '#4caf50', '#f44336'],
                    borderColor: ['#ffcc00', '#4caf50', '#f44336'],
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Número de Pedidos'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Status do Pedido'
                        }
                    }
                }
            }
        });
    
        // Gerar gráfico de linha para a variação de pedidos ao longo do tempo
        var pedidosPorData = <?php echo json_encode($pedidos_por_data); ?>; 
        var ctxLinha = document.getElementById('graficoLinhaPedidos').getContext('2d');
        var graficoLinha = new Chart(ctxLinha, {
            type: 'line',
            data: {
                labels: pedidosPorData.map(function(item) { 
                    // Formata a data para DD/MM
                    const date = new Date(item.data_pedido);
                    return date.getDate().toString().padStart(2, '0') + '/' + (date.    getMonth() + 1).toString().padStart(2, '0');
                }), 
                datasets: [{
                    label: 'Número de Pedidos',
                    data: pedidosPorData.map(function(item) { return item.  numero_pedidos; }),
                    fill: false,
                    borderColor: '#007bff',
                    backgroundColor: '#007bff',
                    tension: 0.1,
                    pointBackgroundColor: '#007bff',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Número de Pedidos'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Data'
                        }
                    }
                }
            }
        });
    
        // Forçar redimensionamento dos gráficos quando a janela for redimensionada
        window.addEventListener('resize', function() {
            grafico.resize();
            graficoBarra.resize();
            graficoLinha.resize();
        });
    </script>
</body>

</html>
