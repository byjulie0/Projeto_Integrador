<?php
include 'menu_inicial.php';

// Receber o ID do pedido da URL
$pedido_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($pedido_id === 0) {
    echo "<script>alert('ID do pedido não especificado!'); window.location.href = 'verificar_administrar_pedido.php';</script>";
    exit;
}

// Buscar os dados do pedido
include '../../model/DB/conexao.php';

try {
    // Consulta SQL CORRIGIDA - sem preco_total
    $sql = "SELECT 
                p.id_pedido,
                p.data_pedido,
                p.status_pedido,
                c.cliente_nome,
                c.cpf_cnpj,
                c.email,
                c.telefone
            FROM pedido p
            INNER JOIN cliente c ON p.cliente_id_cliente = c.id_cliente
            WHERE p.id_pedido = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $pedido_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $pedido_detalhes = $resultado->fetch_assoc();
    $stmt->close();

} catch (Exception $e) {
    echo "Erro ao buscar pedido: " . $e->getMessage();
    $pedido_detalhes = null;
}

// Se não encontrou o pedido
if (!$pedido_detalhes) {
    echo "<div style='padding: 20px; text-align: center;'>";
    echo "<h3>Pedido não encontrado</h3>";
    echo "<p>ID buscado: <strong>" . $pedido_id . "</strong></p>";
    echo "<p>O pedido não foi encontrado no banco de dados.</p>";
    echo "<p><a href='verificar_administrar_pedido.php'>← Voltar para a lista de pedidos</a></p>";
    echo "</div>";
    include 'footer.php';
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido #<?php echo $pedido_detalhes['id_pedido']; ?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm/verificar_pedido_infos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <section id="informacoes-pedidos">
        <div id="title-informacoes-pedidos">
            <a href="verificar_administrar_pedido.php"><i class="bi bi-chevron-left"></i></a>
            <h3>Detalhes do Pedido #<?php echo $pedido_detalhes['id_pedido']; ?></h3>
        </div>
        
        <div id="subtitle-informacoes-pedidos">
            <div id="id-pedido-informacoes-pedidos">
                <span>ID do pedido: </span>
                <strong>#<?php echo $pedido_detalhes['id_pedido']; ?></strong>
            </div>
            <div id="labels-pedido-informacoes-pedidos">
                <div class="label-pedido-informacoes-pedidos status-<?php echo strtolower($pedido_detalhes['status_pedido']); ?>">
                    <span><?php echo htmlspecialchars($pedido_detalhes['status_pedido']); ?></span>
                </div>
            </div>
        </div>

        <div id="page-content-informacoes-pedidos">
            <div id="first-container-informacoes-pedidos">
                <div class="product-card-informacoes-pedidos">
                    <div class="product-title">
                        <span>Informações do Pedido</span>
                    </div>
                    
                    <div class="product-informations-informacoes-pedidos">
                        <div class="informations-informacoes-pedidos">
                            <div class="info-item">
                                <strong>Número do Pedido:</strong> #<?php echo $pedido_detalhes['id_pedido']; ?>
                            </div>
                            <div class="info-item">
                                <strong>Data do pedido:</strong> <?php echo date('d/m/Y', strtotime($pedido_detalhes['data_pedido'])); ?>
                            </div>
                            <div class="info-item">
                                <strong>Status:</strong> <?php echo htmlspecialchars($pedido_detalhes['status_pedido']); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Apenas botão de cancelar para pedidos pendentes -->
                    <div class="buttons-area-informacoes-pedidos">
                        <?php if ($pedido_detalhes['status_pedido'] === 'Pendente'): ?>
                            <div class="left-buttons-informacoes-pedidos">
                                <button class="cancel-btn" onclick="cancelarPedido(<?php echo $pedido_detalhes['id_pedido']; ?>)">
                                    Cancelar pedido
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div id="second-container-informacoes-pedidos">
                <div class="client-data-card-informacoes-pedidos">
                    <span id="client-data-title-span-informacoes-pedidos">Dados do cliente</span>
                    
                    <div class="client-data-spans-informacoes-pedidos">
                        <i class="fa-solid fa-user"></i>
                        <span class="client-data-type-informacoes-pedidos">Nome:</span>
                        <span class="client-data-informacoes-pedidos"><?php echo htmlspecialchars($pedido_detalhes['cliente_nome']); ?></span>
                    </div>

                    <div class="client-data-spans-informacoes-pedidos">
                        <i class="fa-solid fa-lock"></i>
                        <span class="client-data-type-informacoes-pedidos">CPF/CNPJ:</span>
                        <span class="client-data-informacoes-pedidos"><?php echo htmlspecialchars($pedido_detalhes['cpf_cnpj']); ?></span>
                    </div>

                    <div class="client-data-spans-informacoes-pedidos">
                        <i class="fa-solid fa-envelope"></i>
                        <span class="client-data-type-informacoes-pedidos">E-mail:</span>
                        <span class="client-data-informacoes-pedidos"><?php echo htmlspecialchars($pedido_detalhes['email'] ?? 'Não informado'); ?></span>
                    </div>

                    <div class="client-data-spans-informacoes-pedidos">
                        <i class="fa-solid fa-phone"></i>
                        <span class="client-data-type-informacoes-pedidos">Telefone:</span>
                        <span class="client-data-informacoes-pedidos"><?php echo htmlspecialchars($pedido_detalhes['telefone'] ?? 'Não informado'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function cancelarPedido(pedidoId) {
            if (confirm('Tem certeza que deseja cancelar este pedido?')) {
                window.location.href = 'acao_cancelar_pedido.php?id=' + pedidoId;
            }
        }
    </script>
</body>
</html>

<?php include 'footer.php'; ?>