<?php
include 'menu_pg_inicial.php';
require_once __DIR__ . '/../../model/DB/conexao.php';
session_start();

$id_cliente = 1; //$_SESSION['id_cliente'] ?? 0;

//if ($id_cliente == 0) {
  //  die("Você precisa estar logado para acessar o carrinho.");
//}

// ----- AÇÕES (atualizar ou remover) -----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao']) && $_POST['acao'] === 'atualizar') {
        $id_carrinho = $_POST['id_carrinho'] ?? 0;
        $qtd = $_POST['qtd_selecionada'] ?? 1;

        $sql = "UPDATE carrinho 
                SET qtd_selecionada = ? 
                WHERE id_carrinho = ? AND cliente_id_cliente = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("iii", $qtd, $id_carrinho, $id_cliente);
        $stmt->execute();
    }

    if (isset($_POST['acao']) && $_POST['acao'] === 'remover') {
        $id_carrinho = $_POST['id_carrinho'] ?? 0;

        $sql = "DELETE FROM carrinho 
                WHERE id_carrinho = ? AND cliente_id_cliente = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ii", $id_carrinho, $id_cliente);
        $stmt->execute();
    }

    // Recarregar página após ação
    header("Location: carrinho.php");
    exit;
}

// ----- BUSCAR ITENS DO CARRINHO -----
$sql = "SELECT c.id_carrinho, c.qtd_selecionada, c.selecionado,
               p.prod_nome, p.valor, p.descricao, p.imagem
        FROM carrinho c
        JOIN produto p ON c.produto_id_produto = p.id_produto
        WHERE c.cliente_id_cliente = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();
$itens = $result->fetch_all(MYSQLI_ASSOC);

$total = 0;
foreach ($itens as $item) {
    $total += $item['valor'] * $item['qtd_selecionada'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <style>
        .carrinho-container { max-width: 1000px; margin: 20px auto; padding: 20px; }
        .item { display: flex; align-items: center; border-bottom: 1px solid #ccc; padding: 10px 0; }
        .item img { width: 100px; margin-right: 20px; }
        .item-info { flex-grow: 1; }
        .item-preco { font-weight: bold; }
        .total { text-align: right; margin-top: 20px; font-size: 18px; font-weight: bold; }
        .btn { padding: 8px 12px; margin: 5px; border: none; cursor: pointer; border-radius: 5px; }
        .btn-remover { background: #e74c3c; color: #fff; }
        .btn-finalizar { background: #2ecc71; color: #fff; }
    </style>
</head>
<body>
<div class="carrinho-container">
    <h2>Seu Carrinho</h2>

    <?php if (count($itens) > 0): ?>
        <?php foreach ($itens as $item): ?>
            <div class="item">
                <img src="<?= $item['imagem'] ?>" alt="<?= $item['prod_nome'] ?>">
                <div class="item-info">
                    <h3><?= $item['prod_nome'] ?></h3>
                    <p><?= $item['descricao'] ?></p>
                    <p class="item-preco">R$ <?= number_format($item['valor'], 2, ',', '.') ?></p>

                    <!-- Form atualizar quantidade -->
                    <form method="post" style="display:inline-block;">
                        <input type="hidden" name="acao" value="atualizar">
                        <input type="hidden" name="id_carrinho" value="<?= $item['id_carrinho'] ?>">
                        <input type="number" name="qtd_selecionada" 
                               value="<?= $item['qtd_selecionada'] ?>" min="1">
                        <button type="submit" class="btn">Atualizar</button>
                    </form>

                    <!-- Form remover item -->
                    <form method="post" style="display:inline-block;">
                        <input type="hidden" name="acao" value="remover">
                        <input type="hidden" name="id_carrinho" value="<?= $item['id_carrinho'] ?>">
                        <button type="submit" class="btn btn-remover">Remover</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="total">
            Total: R$ <?= number_format($total, 2, ',', '.') ?>
        </div>
        <button class="btn btn-finalizar">Finalizar Compra</button>

    <?php else: ?>
        <p>Seu carrinho está vazio.</p>
    <?php endif; ?>
</div>
</body>
</html>
