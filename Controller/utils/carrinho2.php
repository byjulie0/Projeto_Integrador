<?php
require_once __DIR__ . '/../../model/DB/conexao.php';
session_start();

switch ($action) {
    // Adicionar produto
    case 'add':
        $id = intval($_POST['id']);
        $nome = $_POST['nome'] ?? '';
        $preco = floatval($_POST['preco']);
        $qtd = intval($_POST['quantidade'] ?? 1);

        if (!isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id] = [
                'id' => $id,
                'nome' => $nome,
                'preco' => $preco,
                'quantidade' => $qtd
            ];
        } else {
            $_SESSION['carrinho'][$id]['quantidade'] += $qtd;
        }

        echo json_encode(["success" => true, "carrinho" => $_SESSION['carrinho']]);
        break;

    // Atualizar quantidade
    case 'update':
        $id = intval($_POST['id']);
        $qtd = intval($_POST['quantidade']);
        if (isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id]['quantidade'] = $qtd;
        }
        echo json_encode(["success" => true, "carrinho" => $_SESSION['carrinho']]);
        break;

    // Remover produto
    case 'remove':
        $id = intval($_POST['id']);
        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }
        echo json_encode(["success" => true, "carrinho" => $_SESSION['carrinho']]);
        break;

    // Listar carrinho
    case 'list':
        echo json_encode($_SESSION['carrinho']);
        break;

    default:
        echo json_encode(["error" => "Ação inválida"]);
}

// Inicializa variáveis para evitar erro
$items = $_SESSION['carrinho'] ?? [];
$totalItensSelecionados = 0;
$totalValor = 0;

foreach ($items as $item) {
    $totalItensSelecionados += $item['quantidade'];
    $totalValor += $item['quantidade'] * $item['preco'];}