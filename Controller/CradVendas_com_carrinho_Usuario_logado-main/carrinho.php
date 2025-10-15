<?php
include "db.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id']; //pega o ID do usuário logado
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <style>
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        table, th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        .btn { padding: 6px 12px; border-radius: 5px; text-decoration: none; }
        .btn-remove { background: red; color: white; }
        .btn-buy { background: green; color: white; display: block; margin: 20px auto; width: 200px; text-align: center; }
        .btn-back { background: blue; color: white; display: inline-block; margin: 20px auto; padding: 8px 16px; text-align: center; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Seu Carrinho</h1>
    <a href="produtos.php" class="btn-back">Voltar para comprar</a>
    <a href="logout.php" style="float:right; margin:10px;">Sair</a>

    <table>
        <tr>
            <th>Produto</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Total</th>
            <th>Ação</th>
        </tr>

        <?php
        $sql = "SELECT c.id, p.nome, p.preco, c.quantidade 
                FROM carrinho c 
                JOIN produtos p ON c.produto_id = p.id
                WHERE c.user_id='$user_id'";
        $result = $mysqli->query($sql);
        $totalGeral = 0;

        while ($row = $result->fetch_assoc()):
            $total = $row['preco'] * $row['quantidade'];
            $totalGeral += $total;
        ?>
        <tr>
            <td><?php echo $row['nome']; ?></td>
            <td>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
            <td><?php echo $row['quantidade']; ?></td>
            <td>R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
            <td><a class="btn btn-remove" href="remover_carrinho.php?id=<?php echo $row['id']; ?>">Remover</a></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2 style="text-align:center;">Total: R$ <?php echo number_format($totalGeral, 2, ',', '.'); ?></h2>

    <?php 
    $mensagem = "Olá, gostaria de finalizar a compra no valor de R$ " . number_format($totalGeral, 2, ',', '.');
    $whatsapp = "https://wa.me/5599999999999?text=" . urlencode($mensagem); 
    ?>
    <a href="<?php echo $whatsapp; ?>" target="_blank" class="btn btn-buy">Finalizar Compra no WhatsApp</a>
</body>
</html>
