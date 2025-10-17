
<?php 
session_start();
include 'menu_pg_inicial.php'; 



// Verifica se o cliente está logado
if (!isset($_SESSION['id_cliente'])) {
    // Se não estiver logado, redireciona para a página de login
    header('Location: login.php');
    exit;
}

$id_cliente = $_SESSION['id_cliente']; // pega o id do cliente logado
?>

<?php
include 'C:\xampp\htdocs\Projeto_Integrador\model\DB\conexao.php'; // Ajuste o caminho conforme seu projeto
?>
<?php
$sql = "
SELECT
    p.id_pedido,
    p.data_pedido,
    p.status_pedido,
    COUNT(i.id_item) AS total_itens,
    SUM(i.qtd_produto * pr.valor) AS valor_total
FROM pedido p
LEFT JOIN item i ON p.id_pedido = i.pedido_id_pedido
LEFT JOIN produto pr ON i.produto_id_produto = pr.id_produto
WHERE p.id_cliente = ?
GROUP BY p.id_pedido
ORDER BY p.data_pedido DESC
";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Histórico de Compras</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="../../view/public/css/cliente/historico_de_compras.css" />
</head>
<body class="body_historico_compras">
    <div class="container_historico_compras">

        <div class="title_historico_compras">
            <a href="#" onclick="window.history.back(); return false" class="arrow_compras">
                <i class="bi bi-chevron-left"></i>
            </a>
            <h1 class="titulo_historico_compras">Histórico de Compras</h1>
        </div>
        
        <div class="area_historico_compras">

    <?php while ($pedido = $result->fetch_assoc()): ?>
        <div class="pedido_header">
            <div class="div_data_pedido_pc">
                <p class="data_pedido_pc">Data do Pedido: <?= date('d/m/Y', strtotime($pedido['data_pedido'])) ?></p>
            </div>
            <div class="botao_cancelar">
                <?php
                    if ($pedido['status_pedido'] == 'Pendente') {
                        $texto = "Cancelar";
                        include 'botao_vermelho_cliente.php';
                    }
                ?>
            </div>
        </div>

        <div class="atributos_pedido_mobile">
            <div class="div_data_pedido_mobile">
                <p class="data_pedido_mobile">Data do Pedido: <?= date('d/m/Y', strtotime($pedido['data_pedido'])) ?></p>
            </div>
            <div class="pedido_detalhes">
                <p class="codigo_pedido">Código do pedido<span>:</span> <?= $pedido['id_pedido'] ?></p>
                <p class="total_itens">Total de itens<span>:</span> <?= $pedido['total_itens'] ?></p>
                <p class="valor_pedido">Valor do pedido<span>:</span> R$ <?= number_format($pedido['valor_total'], 2, ',', '.') ?></p>
                <p class="status_pedido">Status do pedido<span>:</span> <?= $pedido['status_pedido'] ?></p>
            </div>
        
    <?php endwhile; ?>

</div>

    </div>

<?php include 'footer_cliente.php'; ?>
</body>
</html>
