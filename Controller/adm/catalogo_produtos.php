<?php
require_once(__DIR__ . "/../utils/listar_produtos_adm.php");
?>

<?php include 'menu_inicial.php';?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização de produtos</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../view/public/css/adm/catalogo_produtos.css">
    <link rel="stylesheet" href="../../view/public/css/adm/toogle.css">
    <script defer src="../../view/js/adm/toogle.js"></script>
</head>

<body>
     <section id="atualizar-produtos">
        <div id="page-title-atualizar-produtos">
            <div id="title-atualizar-produtos">
                <a href="#" onclick="window.history.back(); return false;"><i class="bi bi-chevron-left"></i></a>
                <h3>Catálogo de Produtos</h3>
            </div>
        </div>
        <div id="page-content-atualizar-produtos">
            <div class="first-container-atualizar-produtos">
                <div id="search-bar-atualizar-produtos">
                    <input type="text" placeholder="Pesquisar" />
                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <a href="">Todos</a>
                <a href="?status=ativos">Ativos</a>
                <a href="?status=inativos">Inativados</a>
            </div>
            <hr class="break-line">
            <!-- ?status=inativados -->
            <div id="table2-atualizar-produtos">
                <div id="table-space-atualizar-produtos">
                    <table>
                        
                        <tr>
                            <th class="header-product-name-atualizar-produtos header-cell-atualizar-produto">Produto</th>
                            <th class="header-cell-atualizar-produto">Categoria</th>
                            <th class="header-cell-atualizar-produto">Subcategoria</th>
                            <th class="header-cell-atualizar-produto">Preço</th>
                            <th class="header-cell-atualizar-produto">Editar</th>
                            <th class="header-exclude-atualizar-produtos header-cell-atualizar-produto">Inativar</th>
                        </tr>

                        <?php if (!empty($produtos)): ?>
                            <?php foreach ($produtos as $p): ?>
                                <tr>
                                    <td class="product-name-atualizar-produtos cell-atualizar-produto">
                                        <div class="product-atualizar-produtos"><span><?= htmlspecialchars($p['produto']) ?></span></div>
                                    </td>

                                    <td class="product-category-atualizar-produtos cell-atualizar-produto">
                                        <div class="category-name-atualizar-produtos"><span><?= htmlspecialchars($p['categoria'] ?? 'Ops! Está vazio') ?></span></div>
                                    </td>

                                    <td class="qt-atualizar-produtos cell-atualizar-produto">
                                        <?= htmlspecialchars($p['subcategoria'] ?? 'Ops! Também está vazio') ?>
                                    </td>

                                    <td class="price-atualizar-produtos cell-atualizar-produto">
                                        R$ <?= number_format($p['preco'], 2, ',', '.') ?>
                                    </td>

                                    <td class="update-atualizar-produtos cell-atualizar-produto">
                                        <a href="editar_produto.php?id=<?= $p['id_produto'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>

                                    <td class="exclude-atualizar-produtos cell-atualizar-produto">
                                        <form method="POST" action="toggle_adm_inativar.php" style="display:inline;">
                                            <input type="hidden" name="id_produto" value="<?= $p['id_produto'] ?>">
                                            <input type="hidden" name="status_atual" value="<?= $p['produto_ativo'] ?>">

                                            <?php 
                                            $icone = $p['produto_ativo'] ? 'fa-toggle-on' : 'fa-toggle-off';
                                            $ariaPressed = $p['produto_ativo'] ? 'true' : 'false';
                                            ?>

                                            <button type="submit" name="toggle_produto" 
                                                    class="icon-toggle-btn" 
                                                    aria-pressed="<?= $ariaPressed ?>">
                                                <i class="fa-solid <?= $icone ?>"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align:center;">Nenhum produto cadastrado</td>
                            </tr>
                        <?php endif; ?>

                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php include 'footer.php'; ?>

