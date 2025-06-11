<?php
include 'menu_adm.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização de produtos</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm.css">
    <script defer src="../../view/js/menu-pg-inicial.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <section id="reativar_produtos">
        <div id="page_title_reativar_produtos">
            <div id="title_reativar_produtos">
                <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
                <h3>Reativar produtos</h3>
            </div>
            <div id="subtitle_reativar_produtos">
                <span>Pesquise pelo(s) produto(s) que deseja mover de volta ao catalogo</span>
            </div>
        </div>
        <div id="page_content_reativar_produtos">
            <div class="first_container_reativar_produtos">
                <div id="search_bar_reativar_produtos">
                    <input type="text" placeholder="Pesquisar" />
                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
            <div id="break_line_reativar">
            </div>
            <div id="table2_reativar_produtos">
                <div id="table_space_reativar_produtos">
                    <table>
                        <tr>
                            <th class="select_all_label_reativar_produtos"><button>Selecionar tudo</button></th>
                            <th class="header_product_name_reativar_produtos header_cell_reativar_produtos">Produto
                            </th>
                            <th class="header_cell_reativar_produtos">Categoria</th>
                            <th class="header_cell_reativar_produtos">Estoque</th>
                            <th class="header-cell-atualizar-produto">Preço</th>
                            <th class="header_exclude_reativar_produtos header_cell_reativar_produtos">Reativar</th>
                        </tr>
                        <tr>
                            <td class="select_all_reativar_produtos"><button type="checkbox"></button></td>
                            <td class="product_name_reativar_produtos cell_reativar_produtos">
                                <div class="product_reativar_produtos">
                                    <img src="../View/Public/Imagens/Rectangle 195.png" alt="" />
                                    <span>Nome do produto</span>
                                </div>
                            </td>
                            <td class="product_category_reativar_produtos cell_reativar_produtos">
                                <div class="category_name_reativar_produtos">
                                    <span>
                                        Nome da categoria
                                    </span>
                                </div>
                            </td>
                            <td class="qt_reativar_produtos cell_reativar_produtos">Quantidade em estoque</td>
                            <td class="price-atualizar-produtos cell-atualizar-produto">Preço do produto</td>
                            <td class="exclude_reativar_produtos cell_reativar_produtos"><i class="fa-solid fa-arrow-up-from-bracket"></i></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </section>
</body>

</html>

<?php
include 'footer_adm.php';
?>