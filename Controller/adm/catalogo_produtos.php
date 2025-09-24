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

