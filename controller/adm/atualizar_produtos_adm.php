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
    <section id="atualizar-produtos">
        <div id="page-title-atualizar-produtos">
            <div id="title-atualizar-produtos">
                <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
                <h3>Atualizar produtos cadastrados</h3>
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
                            <th class="header-product-name-atualizar-produtos header-cell-atualizar-produto">Produto
                            </th>
                            <th class="header-cell-atualizar-produto">Categoria</th>
                            <th class="header-cell-atualizar-produto">Estoque</th>
                            <th class="header-cell-atualizar-produto">Preço</th>
                            <th class="header-cell-atualizar-produto">Editar</th>
                            <th class="header-exclude-atualizar-produtos header-cell-atualizar-produto">Inativar</th>
                        </tr>
                        <tr>
                            <td class="select-all-atualizar-produtos"><button type="checkbox"></button></td>
                            <td class="product-name-atualizar-produtos cell-atualizar-produto">
                                <div class="product-atualizar-produtos">
                                    <img src="../View/Public/Imagens/Rectangle 195.png" alt="" />
                                    <span>Nome do produto</span>
                                </div>
                            </td>
                            <td class="product-category-atualizar-produtos cell-atualizar-produto">
                                <div class="category-name-atualizar-produtos">
                                    <span>
                                        Nome da categoria
                                    </span>
                                </div>
                            </td>
                            <td class="qt-atualizar-produtos cell-atualizar-produto">Quantidade em estoque</td>
                            <td class="price-atualizar-produtos cell-atualizar-produto">Preço do produto</td>
                            <td class="update-atualizar-produtos cell-atualizar-produto"><i
                                    class="fa-solid fa-pen-to-square"></i></td>
                            <td class="exclude-atualizar-produtos cell-atualizar-produto"><i
                                    class="fa-solid fa-trash"></i></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </section>
<div id="popConfirmacao" class="pop_inativar">
  <div class="pop_conteudo">
    <button class="pop_fechar" id="fecharConfirmacao">&times;</button>
    <p>Deseja inativar o(s) produto(s)?</p>
    <button id="btnInativarConfirmado">Inativar</button>
  </div>
</div>
<div id="popSucesso" class="pop_inativar">
  <div class="pop_conteudo">
    <button class="pop_fechar" id="fecharSucesso">&times;</button>
    <p>Produto inativado com sucesso!</p>
    <a href="#" id="linkVerInativos">Ver seção de inativos</a>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const botoesInativar = document.querySelectorAll('.fa-trash');
    const popConfirmacao = document.getElementById('popConfirmacao');
    const popSucesso = document.getElementById('popSucesso');
    const btnInativar = document.getElementById('btnInativarConfirmado');
    const fecharConfirmacao = document.getElementById('fecharConfirmacao');
    const fecharSucesso = document.getElementById('fecharSucesso');

    botoesInativar.forEach(botao => {
        botao.addEventListener('click', function (e) {
            e.preventDefault();
            popConfirmacao.style.display = 'flex';
        });
    });

    btnInativar.addEventListener('click', function () {
        popConfirmacao.style.display = 'none';
        popSucesso.style.display = 'flex';
    });

    fecharConfirmacao.addEventListener('click', () => popConfirmacao.style.display = 'none');
    fecharSucesso.addEventListener('click', () => popSucesso.style.display = 'none');

    window.addEventListener('click', function (e) {
        if (e.target === popConfirmacao) popConfirmacao.style.display = 'none';
        if (e.target === popSucesso) popSucesso.style.display = 'none';
    });

    document.getElementById('linkVerInativos').addEventListener('click', function (e) {
        e.preventDefault();
        window.location.href = '#';
    });
});
</script>
</body>
</div>
</html>

