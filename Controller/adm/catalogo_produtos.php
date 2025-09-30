<?php
require_once(__DIR__ . "/../utils/listar_produtos_adm.php");
?>

<?php include 'menu_inicial.php';?>
<?php include 'catalogo_adm_produtos_action.php';?>
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
</head>

<body>
     <section id="atualizar-produtos">
        <div id="page-title-atualizar-produtos">
            <div id="title-atualizar-produtos">
                <a href="#" onclick="window.history.back(); return false;"><i class="fa-solid fa-chevron-left"></i></a>
                <h3>Catálogo de Produtos</h3>
            </div>
            <div id="subtitle-atualizar-produtos">
                <span>Pesquise pelos produtos do catálogo que deseja alterar</span>
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
                  <a href="?status=ativos">Ativos</a> | <a href="?status=inativados">Inativados</a> 
            </div>
            <div id="break-line">
            </div>
            <div id="table2-atualizar-produtos">
                <div id="table-space-atualizar-produtos">
                    <table>
                        
                        <tr>
                            <th class="select-all-label-atualizar-produtos"><button>Selecionar tudo</button></th>
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
                                    <td class="select-all-atualizar-produtos">
                                        <input type="checkbox" name="produto_id[]" value="<?= $p['id_produto'] ?>" class="product-checkbox">
                                    </td>

                                    <td class="product-name-atualizar-produtos cell-atualizar-produto">
                                        <div class="product-atualizar-produtos"><span><?= htmlspecialchars($p['produto']) ?></span></div>
                                    </td>

                                    <td class="product-category-atualizar-produtos cell-atualizar-produto">
                                        <div class="category-name-atualizar-produtos"><span><?= htmlspecialchars($p['categoria'] ?? 'Sem categoria') ?></span></div>
                                    </td>

                                    <td class="qt-atualizar-produtos cell-atualizar-produto">
                                        <?= htmlspecialchars($p['subcategoria'] ?? 'Sem subcategoria') ?>
                                    </td>

                                    <td class="price-atualizar-produtos cell-atualizar-produto">
                                        R$ <?= number_format($p['preco'], 2, ',', '.') ?>
                                    </td>

                                    <td class="update-atualizar-produtos cell-atualizar-produto">
                                        <a href="editar_produto.php?id=<?= $p['id_produto'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>

                                    <td class="exclude-atualizar-produtos cell-atualizar-produto">
                                        <?php include 'toogle.php'; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align:center;">Nenhum produto cadastrado</td>
                            </tr>
                        <?php endif; ?>
                         <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><input type="checkbox" name="produtos[]" value="<?= $produto['id_produto'] ?>"></td>
                            <td><?= htmlspecialchars($produto['prod_nome']) ?></td>
                            <td><?= htmlspecialchars($produto['id_categoria']) ?></td>
                            <td><?= htmlspecialchars($produto['id_subcategoria']) ?></td>
                            <td><?= number_format($produto['valor'], 2, ',', '.') ?></td>
                            <td><a href="editar_produto.php?id=<?= $produto['id_produto'] ?>">Editar</a></td>
                            <td>
                                <?php include 'toogle.php'; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php include 'footer.php'; ?>

