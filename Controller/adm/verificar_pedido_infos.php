<?php 
include 'menu_inicial.php';

$pedido_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($pedido_id === 0) {
    echo "<script>alert('ID do pedido não especificado!'); window.location.href = 'verificar_administrar_pedido.php';</script>";
    exit;
}

include '../../model/DB/conexao.php';

try {
    $sql = "SELECT 
                p.id_pedido,
                p.data_pedido,
                p.status_pedido,
                c.cliente_nome,
                c.cpf_cnpj,
                c.email,
                c.telefone,
                pr.prod_nome AS nome_produto,
                pr.sexo AS sexo_produto,
                pr.valor AS valor_produto,
                pr.path_img AS imagem_produto,
                i.qtd_produto
            FROM pedido p
            INNER JOIN cliente c ON p.id_cliente = c.id_cliente
            INNER JOIN item i ON p.id_pedido = i.id_pedido
            INNER JOIN produto pr ON i.id_produto = pr.id_produto
            WHERE p.id_pedido = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $pedido_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $itens_pedido = [];
    while ($row = $resultado->fetch_assoc()) {
        $itens_pedido[] = $row;
    }

    $stmt->close();

    if (count($itens_pedido) === 0) {
        echo "<div style='padding: 20px; text-align: center;'>";
        echo "<h3>Pedido não encontrado</h3>";
        echo "<p>ID buscado: <strong>" . $pedido_id . "</strong></p>";
        echo "<p>O pedido não foi encontrado no banco de dados.</p>";
        echo "<p><a href='verificar_administrar_pedido.php'>← Voltar para a lista de pedidos</a></p>";
        echo "</div>";
        include 'footer.php';
        exit;
    }

    $pedido_detalhes = $itens_pedido[0];
    $valor_total = 0;
    foreach ($itens_pedido as $item) {
        $valor_total += $item['valor_produto'] * $item['qtd_produto'];
    }

} catch (Exception $e) {
    echo "Erro ao buscar pedido: " . $e->getMessage();
    $pedido_detalhes = null;
}

$caminho_imagem = $pedido_detalhes['imagem_produto'] ?? '';
if (!empty($caminho_imagem)) {
    if (strpos($caminho_imagem, '/') === 0 || strpos($caminho_imagem, '../') === 0 || strpos($caminho_imagem, './') === 0) {
        $imagem_produto = $caminho_imagem;
    } else {
        $imagem_produto = '../../view/public/Imagens/' . $caminho_imagem;
    }
} else {
    $imagem_produto = 'https://via.placeholder.com/200x200/007bff/ffffff?text=Sem+Imagem';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar e administrar pedidos</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm/verificar_pedido_infos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
 
<body>
    <section id="informacoes-pedidos">
        <div id="title-informacoes-pedidos">
            <a href="verificar_administrar_pedido.php"><i class="bi bi-chevron-left"></i></a>
            <h3>Verificar e administrar pedidos</h3>
        </div>

        <div id="subtitle-informacoes-pedidos">
            <div id="id-pedido-informacoes-pedidos">
                <span>ID do pedido:</span>
                <strong>#<?php echo $pedido_detalhes['id_pedido']; ?></strong>
            </div>
        </div>

        <div id="page-content-informacoes-pedidos">
            <div id="first-container-informacoes-pedidos">
                <div class="product-card-informacoes-pedidos">
                    <div class="product-card-informacoes-pedidos1">
                        <div class="product-title">
                            <span><?php echo htmlspecialchars($itens_pedido[0]['nome_produto']); ?></span>
                        </div>

                        <div id="labels-pedido-informacoes-pedidos"> 
                            <div class="label-pedido-informacoes-pedidos status-<?php echo strtolower($pedido_detalhes['status_pedido']); ?>"> 
                                <span><?php echo htmlspecialchars($pedido_detalhes['status_pedido']); ?></span> 
                            </div> 
                        </div>

                        <div class="product-informations-informacoes-pedidos">
                            <div class="img-and-label-informacoes-pedidos">
                                <img src="<?php echo htmlspecialchars($imagem_produto); ?>" alt="<?php echo htmlspecialchars($itens_pedido[0]['nome_produto']); ?>">
                                <div class="informations-informacoes-pedidos">
                                    <span class="type-informacoes-pedidos">
                                        <?php echo htmlspecialchars($itens_pedido[0]['sexo_produto']); ?>
                                    </span>
                                    <span class="name-informacoes-pedidos">
                                        <?php echo htmlspecialchars($itens_pedido[0]['nome_produto']); ?>
                                    </span>
                                    <span class="lote-informacoes-pedidos">
                                        Quantidade: <?php echo $itens_pedido[0]['qtd_produto']; ?>
                                    </span>
                                    <span class="purchase-date-informacoes-pedidos">
                                        Data do pedido: <?php echo date('d/m/Y', strtotime($pedido_detalhes['data_pedido'])); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="final-price-informacoes-pedidos">
                                <p>Valor Total</p>
                                <div class="price-informacoes-pedidos">
                                    <div class="valor-final-informacoes-pedidos">
                                        <span>R$<?php echo number_format($valor_total, 2, ',', '.'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="buttons-area-informacoes-pedidos">
                        <?php if ($pedido_detalhes['status_pedido'] === 'Pendente'): ?>
                            <div class="left-buttons-informacoes-pedidos">
                                <button class="cancel-btn" onclick="cancelarPedido(<?php echo $pedido_detalhes['id_pedido']; ?>)">Cancelar pedido</button>
                            </div>
                        <?php endif; ?>

                        <?php if ($pedido_detalhes['status_pedido'] !== 'Concluído'): ?>
                            <div class="right-buttons-informacoes-pedidos">
                                <button>
                                    <?php  
                                    $texto = "Concluir";
                                    include 'botao_verde_adm.php';
                                    ?>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div id="second-container-informacoes-pedidos">
                <div class="client-data-card-informacoes-pedidos">
                    <span id="client-data-title-span-informacoes-pedidos">
                        Dados do cliente
                    </span>

                    <div class="client-data-spans-informacoes-pedidos">
                        <i class="fa-solid fa-user"></i>
                        <span class="client-data-type-informacoes-pedidos1">Nome:</span>
                        <span class="client-data-informacoes-pedidos"><?php echo htmlspecialchars($pedido_detalhes['cliente_nome']); ?></span>
                    </div>

                    <div class="client-data-spans-informacoes-pedidos">
                        <i class="fa-solid fa-lock"></i>
                        <span class="client-data-type-informacoes-pedidos1">CPF/CNPJ:</span>
                        <span class="client-data-informacoes-pedidos"><?php echo htmlspecialchars($pedido_detalhes['cpf_cnpj']); ?></span>
                    </div>

                    <div class="client-data-spans-informacoes-pedidos">
                        <i class="fa-solid fa-envelope"></i>
                        <span class="client-data-type-informacoes-pedidos1">E-mail:</span>
                        <span class="client-data-informacoes-pedidos"><?php echo htmlspecialchars($pedido_detalhes['email']); ?></span>
                    </div>

                    <div class="client-data-spans-informacoes-pedidos">
                        <i class="fa-solid fa-phone"></i>
                        <span class="client-data-type-informacoes-pedidos1">Telefone:</span>
                        <span class="client-data-informacoes-pedidos"><?php echo htmlspecialchars($pedido_detalhes['telefone']); ?></span>
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
zd