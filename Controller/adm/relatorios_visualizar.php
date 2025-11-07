
<?php 
include "menu_inicial.php"; 
include '../../model/DB/conexao.php';  

// intervalo de datas dinâmico (vindo do GET ou valores padrão)
$data_inicio = isset($_GET['data_inicio']) ? $_GET['data_inicio'] : date('Y-m-01'); // primeiro dia do mês atual
$data_fim    = isset($_GET['data_fim']) ? $_GET['data_fim'] : date('Y-m-t');       
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


mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <link rel="stylesheet" href="../../public/css/adm/relatorios_visualizar.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="../../View/js/adm/relatorios_visualizar_adm.js"></script>

    
    <style>
        /* Ajustando o contêiner do gráfico */
        .grafico-container {
            width: 100%;
            max-width: 400px; 
            height: 300px;     
            margin: 0 auto;    
        }

        /* Ajuste de estilo para os cards (produtos, pedidos, usuários) */
        .relatorios_cards_topo {
            display: grid;
            grid-template-columns: repeat(3, 1fr);  /* Cria 3 colunas */
            gap: 20px;
            margin-bottom: 20px;
        }

        /* Ajuste no tamanho dos cards */
        .card_topo {
            padding: 20px;
            background-color: #dfefd1ff;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Título do gráfico de estatísticas */
        .card_estatisticas h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        /* Ajuste de espaçamento e alinhamento */
        .relatorios_main {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        /* Estilos para o cabeçalho */
        .relatorios_header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
        /*----------------------------------------------------- colocar o visualizar a esquerda da tela */
        .relatorios_header h1{
            display:flex;
            align-items: center;
            margin-left: 50px;
        }
        /* Personalização da linha de seleção do período */
        .verificar_administrar_pedidos_sessao_periodo_linha {
            width: 100%;
            border: 1px solid #ccc;
        }

        /* Estilo geral para o corpo da página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            color: #333;
        }

        /* Ajustando a área de "Atividades recentes" */
        .card_atividades {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        /* seta de retorno */
        .verificar_administrar_pedidos_sessao_seta_voltar {
            position: absolute;
            top: 110px;
            left: 10px;
}
/* card de estatistica par alteração de cor */
        .card_estatisticas{
            background-color: #dbf3d4ff;
        }
        <style>
    /* Manter o estilo do gráfico de pizza como está */
    .grafico-container {
    
        width: 100%;
        max-width: 500px; 
        height: 300px;     
        margin: 0 auto;   
    }

    /* Estilo do contêiner para os gráficos de barra e linha */
    .grafico-row {
        display: flex;  
        justify-content: space-between;  
        gap: 20px;  
        margin-top: 20px;
        
    }

    /* Ajuste do gráfico de barra */
    .grafico-barra {
        flex: 1;  
        max-width: 45%; 
        background-color: #dbf3d4ff; 
    }

    /* Ajuste do gráfico de linha */
    .grafico-linha {
        flex: 1;  
        max-width: 45%; 
        background-color: #dbf3d4ff; 
        
    }
</style>

    </style>
</head>

<body>
    <div class="relatorios_container">

    
        <div class="relatorios_header"> 
            <a href="#" onclick="window.history.back(); return false;" class="verificar_administrar_pedidos_sessao_seta_voltar"> 
                <i class="bi bi-chevron-left"></i> 
            </a>
            <h1>Visualizar relatórios</h1>
            <h3 class="verificar_administrar_pedidos_sessao_mini_titulos_1">Mostrando relatórios referentes ao período:
                <span class="verificar_administrar_pedidos_sessao_titulo_destaque" id="dataEscolhida"><?php echo $data_inicio . ' - ' . $data_fim; ?></span>
            </h3>
            <div class="verificar_administrar_pedidos_sessao_periodo_bloco">
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
            <i class="fa-solid fa-bag-shopping"></i>Produtos <br> cadastrados: 
            <b><?php echo $numero_produtos; ?></b> 
            <i class="fa-solid fa-chevron-right"></i>
        </div>

        <!-- Card de Pedidos -->
        <div class="card_topo">
            <i class="fa-solid fa-cart-plus"></i>Pedidos <br> gerados: 
            <b><?php echo $numero_pedidos; ?></b>
            <i class="fa-solid fa-chevron-right"></i>
        </div>

        <!-- Card de Usuários -->
        <div class="card_topo">
            <i class="fa-solid fa-users"></i>Usuários <br> cadastrados: 
            <b><?php echo $numero_usuarios; ?></b>
            <i class="fa-solid fa-chevron-right"></i>
        </div>

        <!-- Gráfico de Estatísticas -->
        <div class="card_estatisticas">
            <h3>Estatísticas</h3>
            <div class="grafico-container">
                <canvas id="graficoEstatisticas"></canvas>
            </div>
        </div>
    </div>

    <!-- Contêiner para os gráficos de barra e linha -->
    <div class="grafico-row">
        <!-- Gráfico de Barra -->
        <div class="grafico-container grafico-barra">
            <canvas id="graficoBarraEstatisticas"></canvas>
        </div>

        <!-- Gráfico de Linha -->
        <div class="grafico-container grafico-linha">
            <canvas id="graficoLinhaPedidos"></canvas>
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

     <script>
$(document).ready(function() {
    // Quando o usuário clicar em "Mudar período"
    $("#abrirCalendario").click(function() {
        // Exibe os dois campos ocultos e ativa o calendário jQuery UI
        $("#dataInicio, #dataFim").show().datepicker({
            dateFormat: "yy-mm-dd",
            onSelect: function() {
                let inicio = $("#dataInicio").val();
                let fim = $("#dataFim").val();

                // Mostra o intervalo escolhido no texto da tela
                $("#dataEscolhida").text(inicio + " - " + fim);

                // Recarrega a página com as datas escolhidas (enviando via GET)
                window.location.href = `relatorios_visualizar.php?data_inicio=${inicio}&data_fim=${fim}`;
            }
        });
    });
});
</script>


    <script>
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
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' pedidos';
                            }
                        }
                    }
                }
            }
        }
        );
 // Gerar gráfico de barra para a distribuição dos pedidos por status
var ctxBarra = document.getElementById('graficoBarraEstatisticas').getContext('2d');
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
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw + ' pedidos';
                    }
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
            labels: pedidosPorData.map(function(item) { return item.data_pedido; }), 
            datasets: [{
                label: 'Número de Pedidos',
                data: pedidosPorData.map(function(item) { return item.numero_pedidos; }), // Número de pedidos no eixo Y
                fill: false,
                borderColor: '#007bff',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' pedidos';
                        }
                    }
                }
            },
            scales: {
                x: {
                    type: 'category',
                    title: {
                        display: true,
                        text: 'Data'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Número de Pedidos'
                    }
                }
            }
        }
    });
    </script>
</body>

</html>
