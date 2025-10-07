<?php
include 'menu_pg_inicial.php';
session_start();

$id_cliente = $_SESSION['id_cliente'] ?? null;
$id_produto = $_GET['id_produto'] ?? null;
if (!$id_produto) {
    die("Produto não encontrado!");
}

$result = $con->prepare("SELECT * FROM produto WHERE id_produto = $id_produto");
$result = $con->query($id_produto);
$produto = $result->fetch_assoc();

if (!$produto) {
    die("Produto não encontrado!");
}
?>

<!-- $isFavorito = false;

// if (isset($_SESSION['id_cliente'])) {
//     $resultFav = $con->prepare("SELECT 1 FROM favorito WHERE cliente_id_cliente = ? AND produto_id_produto = ?");
//     $resultFav->execute([$_SESSION['id_cliente'], $id_produto]);
//     $isFavorito = $resultFav->rowCount() > 0;
// } -->


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php htmlspecialchars($produto['prod_nome'])?> - Detalhes</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/detalhes_produto.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="body-detalhes-produto">

    <h2 class="titulo-produto-detalhes-produto">
        <a href="#" onclick="window.history.back(); return false"><i class="bi bi-chevron-left"></i></a> Animal
        Selecionado
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

            <form action="add_carrinho.php" method="POST">
                <input type="hidden" name="id_cliente" value="<?php $id_cliente;?>">
                <input type="hidden" name="id_produto" value="">
                <button type="submit" class="botao-carrinho-detalhes-produto">Adicionar ao carrinho</button>
            </form>

            <a href="https://api.whatsapp.com/send?phone=556799492638"><button
                class="botao-comprar-detalhes-produto">Comprar</button>
            </a>

            <section class="descricao-detalhes-produto">
                <h3>Informações</h3>
                <p></p>
            </section>

            <section class="sub-descricao-detalhes-produto">
                <p><strong>Peso: </strong>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                <p><strong>Idade: </strong>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                <p><strong>Raça: </strong>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                <p><strong>Criação: </strong>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
            </section>
    </main>
</body>

</html>

<?php include 'footer_cliente.php'; ?>