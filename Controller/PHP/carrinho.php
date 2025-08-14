<?php
require_once '../conexao.php';
session_start();

$id_cliente = $_SESSION['id_cliente'] ?? 0;

// Busca os itens do carrinho
$sql = "SELECT c.id_item, c.quantidade, c.selecionado, p.prod_nome, p.valor, p.descricao
        FROM carrinho c
        JOIN produto p ON c.id_produto = p.id_produto
        WHERE c.id_cliente = :id_cliente";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id_cliente' => $id_cliente]);
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calcula o total apenas dos selecionados
$sqlResumo = "SELECT COUNT(*) AS itens, SUM(p.valor * c.quantidade) AS total
              FROM carrinho c
              JOIN produto p ON c.id_produto = p.id_produto
              WHERE c.id_cliente = :id_cliente AND c.selecionado = 1";
$stmtResumo = $pdo->prepare($sqlResumo);
$stmtResumo->execute([':id_cliente' => $id_cliente]);
$resumo = $stmtResumo->fetch(PDO::FETCH_ASSOC);

// Variáveis para o HTML
$totalItensSelecionados = $resumo['itens'] ?? 0;
$totalValor = $resumo['total'] ?? 0.00;
?>
