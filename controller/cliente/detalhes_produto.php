<?php
include '../../model/DB/conexao.php';
session_start();
include 'menu_pg_inicial.php';

$id_produto = $_GET['id_produto'] ?? null;

$sql = "SELECT p.*, c.cat_nome, s.subcat_nome
        FROM produto p
        LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
        LEFT JOIN subcategoria s ON p.id_subcategoria = s.id_subcategoria
        WHERE p.id_produto = ?";

$query = $con->prepare($sql);
$query->bind_param("i", $id_produto);
$query->execute();
$result = $query->get_result();
$produto = $result->fetch_assoc();

if (!$produto) {
    die("Produto não encontrado!");
}

$valor_formatado = number_format($produto['valor'], 2, ',', '.');
$peso_formatado = $produto['peso'] ? number_format($produto['peso'], 2, ',', '.') . ' kg' : 'Não informado';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($produto['prod_nome']) ?> - Detalhes</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/detalhes_produto.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="../../View/js/cliente/popup_login.js" defer></script>
</head>

<body class="body-detalhes-produto">
    <script>var usuarioLogado = <?php echo isset($_SESSION['id_cliente']) ? 'true' : 'false'; ?>;</script>
    <h2 class="titulo-produto-detalhes-produto">
        <a href="#" onclick="window.history.back(); return false"><i class="bi bi-chevron-left"></i></a>
        <?php echo htmlspecialchars($produto['prod_nome']); ?>
    </h2>
    <main class="main-detalhes-produto">

        <div class="galeria-detalhes-produto">
            <div class="miniaturas-detalhes-produto">
                <img src="<?php echo $produto['path_img']; ?>"
                    alt="<?php echo htmlspecialchars($produto['prod_nome']); ?>">
            </div>

            <div class="imagem-grande-detalhes-produto">
                <img src="<?php echo $produto['path_img']; ?>"
                    alt="Imagem Principal de <?php echo htmlspecialchars($produto['prod_nome']); ?>">
            </div>
        </div>

        <div class="info-produto-detalhes-produto">

            <p class="informacoes-detalhes-produto">Vendido pela empresa <span>John Rooster</span></p>

            <p class="informacoes-detalhes-produto">Entregue por <span>John Rooster</span></p>

            <p class="informacoes-detalhes-produto">A John Rooster se compromete a oferecer apenas os melhores animais e
                itens do mercado.</p>

            <p class="preco-detalhes-produto">R$ <?php echo $valor_formatado; ?></p>

            <form id="formCarrinho" action="add_carrinho.php" method="POST">
                <input type="hidden" name="id_cliente" value="<?php echo $_SESSION['id_cliente'] ?? ''; ?>">
                <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
                <button type="button" class="botao-carrinho-detalhes-produto" onclick="verificarLoginCarrinho()">
                    Adicionar ao carrinho
                </button>
            </form>

            <section class="descricao-detalhes-produto">
                <h3>Informações</h3>
                <p><?php echo $produto['descricao'] ? htmlspecialchars($produto['descricao']) : 'Descrição não disponível.'; ?>
                </p>
            </section>

            <section class="sub-descricao-detalhes-produto">
                <p><strong>Peso: </strong><?php echo $peso_formatado; ?></p>
                <p><strong>Data de nascimento: </strong><?php echo $produto['idade']; ?></p>
                <p><strong>Categoria: </strong><?php echo $produto['subcat_nome'] ?? 'Não categorizado'; ?></span></p>
                <?php if ($produto['campeao']): ?>
                    <p><strong>Status:</strong> <span class="badge bg-success">Animal Campeão</span></p>
                <?php endif; ?>
            </section>
    </main>
</body>
<?php include '../overlays/pop_up_login.php'; ?>
<?php include 'footer_cliente.php'; ?>

</html>