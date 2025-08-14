<!-- Anna Laura -->
<?php include 'menu_pg_inicial.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galo Índio de León - John Rooster</title>
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Corrigido -->
</head>
<body class="body-detalhes-produto">

    <h2 class="titulo-produto-detalhes-produto">
        <a href="#" onclick="window.history.back(); return false";><i class="bi bi-chevron-left"></i></a> Animal Selecionado
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


            <!-- </div> -->

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
                <a href="carrinho.php"><button class="botao-carrinho-detalhes-produto">Adicionar ao carrinho</button></a>
                <a href="https://api.whatsapp.com/send?phone=556799492638"><button class="botao-comprar-detalhes-produto">Comprar</button></a>

            </div>
        </div>


        
    </main>

    <section class="descricao-detalhes-produto">
        <h3>Informações</h3>
        <p>Dê uma nova vida ao seu espaço com o Galo Índio de León, a raça que é a verdadeira definição de majestade e beleza. Conhecido por seu porte imponente e plumagem exuberante, este galo não é apenas um animal de estimação; é uma verdadeira obra de arte viva!</p>
    </section>

    <section class="sub-descricao-detalhes-produto">
        <p><strong>Peso:</strong> 5kg</p>
        <p><strong>Idade:</strong> 1 ano</p>
        <p><strong>Raça:</strong> Criado a partir dos melhores exemplares, o Galo Índio de León possui uma linhagem seletiva que garante não apenas beleza, mas também vigor e adaptabilidade.</p>
        <p><strong>Criação:</strong> Os galos devem ter um ambiente amplo, limpo e bem ventilado, com áreas cobertas para proteção contra intempéries e exercícios.</p>
    </section>

</body>
</html>

<?php include 'footer_cliente.php'; ?>


<?php foreach ($produtos as $p): ?>
    <div class="produto">
        <h3><?= htmlspecialchars($p['nome']) ?></h3>
        <p>Preço: R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>

        <form action="/controllers/CarrinhoController.php?action=adicionar" method="POST">
            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <input type="hidden" name="nome" value="<?= htmlspecialchars($p['nome']) ?>">
            <input type="hidden" name="preco" value="<?= $p['preco'] ?>">
            <button type="submit">Adicionar ao Carrinho</button>
        </form>
    </div>
<?php endforeach; ?>

   