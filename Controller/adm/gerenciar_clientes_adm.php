
<?php
include 'menu_adm.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar clientes</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm.css">
    <script defer src="../../view/js/toogle.js"></script>
    <script defer src="../../view/js/menu-pg-inicial.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <section id="gerenciar-clientes">
        <div id="page-title-gerenciar-clientes">
            <div id="title-gerenciar-clientes">
                <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
                <h3>Gerenciar clientes cadastrados</h3>
            </div>
            <div id="subtitle-gerenciar-clientes">
                <span>Pesquise pelos clientes cadastrados que deseja vizualizar</span>
            </div>
        </div>
        <div id="page-content-gerenciar-clientes">
            <div class="first-container-gerenciar-clientes">
                <div id="search-bar-gerenciar-clientes">
                    <input type="text" placeholder="Pesquisar" />
                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <a href="#">Inativados</a>
            </div>
            <div id="break-line">
            </div>
            <div id="table2-gerenciar-clientes">
                <div id="table-space-gerenciar-clientes">
                    <table>
                        
                        <tr>
                            <th class="select-all-label-gerenciar-clientes"><button>Selecionar tudo</button></th>
                            <th class="header-cliente-name-gerenciar-clientes header-cell-gerenciar-clientes">Nome do cliente</th>
                            <th class="header-cell-gerenciar-clientes">CPF</th>
                            <th class="header-cell-gerenciar-clientes">Data de cadastro</th>
                            <th class="header-exclude-gerenciar-clientes header-cell-gerenciar-clientes">Inativar</th>
                        </tr>

                        <tr>
                            <td class="select-all-gerenciar-clientes">
                                <input type="checkbox" id="#" name="#" class="cliente-checkbox">
                            </td>

                            <td class="cliente-name-gerenciar-clientes cell-gerenciar-clientes">
                                <div class="cliente-gerenciar-clientes"><span>Anna Laurah</span></div>
                            </td>

                            <td class="cliente-cpf-gerenciar-clientes cell-gerenciar-clientes">
                                <div class="cpf-name-gerenciar-clientes"><span>000.000.000-01</span></div>
                            </td>

                            <td class="qt-gerenciar-clientes cell-gerenciar-clientes">25/12/2020</td>


                            <td class="exclude-gerenciar-clientes cell-gerenciar-clientes">
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
<?php include 'footer_adm.php'; ?>

