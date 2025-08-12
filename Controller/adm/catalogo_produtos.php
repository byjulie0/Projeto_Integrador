<?php include 'menu_inicial.php';?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização de produtos</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm/catalogo_produtos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script defer src="../../view/js/toogle.js"></script>
</head>

<body>
    <section id="atualizar-produtos">
        <div id="page-title-atualizar-produtos">
            <div id="title-atualizar-produtos">
                <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
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
                <a href="#">Inativados</a>
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
                            <th class="header-cell-atualizar-produto">Estoque</th>
                            <th class="header-cell-atualizar-produto">Preço</th>
                            <th class="header-cell-atualizar-produto">Editar</th>
                            <th class="header-exclude-atualizar-produtos header-cell-atualizar-produto">Inativar</th>
                        </tr>

                        <tr>
                            <td class="select-all-atualizar-produtos">
                                <input type="checkbox" id="#" name="#" class="product-checkbox">
                            </td>

                            <td class="product-name-atualizar-produtos cell-atualizar-produto">
                                <div class="product-atualizar-produtos"><span>Nome do produto</span></div>
                            </td>

                            <td class="product-category-atualizar-produtos cell-atualizar-produto">
                                <div class="category-name-atualizar-produtos"><span>Nome da categoria</span></div>
                            </td>

                            <td class="qt-atualizar-produtos cell-atualizar-produto">Quantidade em estoque</td>

                            <td class="price-atualizar-produtos cell-atualizar-produto">Preço do produto</td>

                            <td class="update-atualizar-produtos cell-atualizar-produto">
                                <a href="editar_produto.php"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>

                            <td class="exclude-atualizar-produtos cell-atualizar-produto">
                                <button type="button" class="icon-toggle-btn" aria-pressed="false">
                                    <i class="fa-solid fa-toggle-off"></i>
                                    <i class="fa-solid fa-toggle-on"></i>
                                </button>
                            </td>
                            <!-- botao toogle não esta aparecendo -->
                            
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php include 'footer.php'; ?>

