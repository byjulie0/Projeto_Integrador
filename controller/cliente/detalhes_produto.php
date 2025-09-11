<?php

// if ($_SESSION['funcao'] != 'CLIENTE'){
//     header("location: login.php");
//     exit();
//     }

  
session_start();
require_once '../../model/conexao.php';
include 'menu_pg_inicial.php';

$id_produto = $_GET['id'] ?? null;
if (!$id_produto) {
    die("Produto não encontrado!");
}

$stmt = $pdo->prepare("SELECT * FROM produto WHERE id_produto = ?");
$stmt->execute([$id_produto]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado!");
}

$isFavorito = false;
if (isset($_SESSION['id_cliente'])) {
    $stmtFav = $pdo->prepare("SELECT 1 FROM favorito WHERE cliente_id_cliente = ? AND produto_id_produto = ?");
    $stmtFav->execute([$_SESSION['id_cliente'], $id_produto]);
    $isFavorito = $stmtFav->rowCount() > 0;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produto['nome']) ?> - Detalhes</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/detalhes_produto.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="body-detalhes-produto">

    <h2 class="titulo-produto-detalhes-produto">
        <a href="#" onclick="window.history.back(); return false"><i class="bi bi-chevron-left"></i></a> Animal Selecionado
    </h2>

    <main class="main-detalhes-produto">

        <div class="galeria-detalhes-produto">
            <div class="miniaturas-detalhes-produto">
                <img src="../../view/public/imagens/default-thumbnail.jpg" alt="Miniatura 1">
                <img src="../../view/public/imagens/default-thumbnail.jpg" alt="Miniatura 2">
                <img src="../../view/public/imagens/default-thumbnail.jpg" alt="Miniatura 3">
            </div>

            <div class="imagem-grande-detalhes-produto">
                <img src="../../view/public/imagens/default-thumbnail.jpg" alt="Imagem Principal">
            </div>
        </div>
            <div class="info-produto-detalhes-produto">
                <div class="estrelas-detalhes-produto">★★★★★<span>4.9 (204)</span>
                    <i class="bi bi-share"></i>
                    <i class="bi bi-heart"></i>
                </div>
                    
                <p class="informacoes-detalhes-produto">
                    Vendido pela empresa <span>John Rooster</span>
                </p>
                <p class="informacoes-detalhes-produto">
                    Entregue por <span>John Rooster</span>
                </p>
                <p class="informacoes-detalhes-produto">
                    A John Rooster se compromete a oferecer apenas os melhores animais do mercado.
                </p>
                <p class="preco-detalhes-produto">R$ 5.000,00</p>
                <form action="detalhes_produto.php" method="POST">
                    <input type="hidden" name="id_cliente" value="1">
                    <input type="hidden" name="id_produto" value="1">
                    <button type="submit" class="botao-carrinho-detalhes-produto">Adicionar ao carrinho</button>
                </form>
                <a href="https://api.whatsapp.com/send?phone=556799492638"><button class="botao-comprar-detalhes-produto">Comprar</button></a>

        <div class="info-produto-detalhes-produto">
            <div class="estrelas-detalhes-produto">
                ★★★★★<span>4.9 (204)</span>
                <i class="bi bi-share"></i>

                <form action="php/favoritos.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">
                    <button type="submit" class="btn btn-link p-0 m-0">
                        <i class="bi <?= $isFavorito ? 'bi-heart-fill text-danger' : 'bi-heart' ?>"></i>
                    </button>
                </form>
            </div>
                    
            <p class="informacoes-detalhes-produto">
                Vendido pela empresa <span>John Rooster</span>
            </p>
            <p class="informacoes-detalhes-produto">
                Entregue por <span>John Rooster</span>
            </p>
            <p class="informacoes-detalhes-produto">
                A John Rooster se compromete a oferecer apenas os melhores animais do mercado.
            </p>
            <p class="preco-detalhes-produto">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
            
            <form action="/controllers/CarrinhoController.php?action=adicionar" method="POST">
                <input type="hidden" name="id" value="<?= $produto['id_produto'] ?>">
                <input type="hidden" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>">
                <input type="hidden" name="preco" value="<?= $produto['preco'] ?>">
                <button type="submit" class="botao-carrinho-detalhes-produto">Adicionar ao carrinho</button>
            </form>

            <a href="https://api.whatsapp.com/send?phone=556799492638">
                <button class="botao-comprar-detalhes-produto">Comprar</button>
            </a>
        </div>
    </main>

    <section class="descricao-detalhes-produto">
        <h3>Informações</h3>
        <p><?= htmlspecialchars($produto['descricao']) ?></p>
    </section>

    <section class="sub-descricao-detalhes-produto">
        <p><strong>Peso:</strong> <?= $produto['peso'] ?? 'N/D' ?></p>
        <p><strong>Idade:</strong> <?= $produto['idade'] ?? 'N/D' ?></p>
        <p><strong>Raça:</strong> <?= $produto['raca'] ?? 'N/D' ?></p>
        <p><strong>Criação:</strong> <?= $produto['criacao'] ?? 'N/D' ?></p>
    </section>

</body>
</html>

<?php include 'footer_cliente.php'; ?>
