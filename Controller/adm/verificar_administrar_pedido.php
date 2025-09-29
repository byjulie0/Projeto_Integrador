<?php include 'menu_inicial.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="../../view/public/css/adm/verificar_administrar_pedido.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="verificar_administrar_pedidos_body">
    <main class="verificar_administrar_pedidos_content">
        <!-- Cabeçalho da página -->
        <section class="verificar_administrar_pedidos_sessao_identificar">
            <div class="verificar_administrar_pedidos_sessao_bloco">
                <div class="verificar_administrar_pedidos_sessao_bloco_info">
                    <div class="verificar_administrar_pedidos_sessao_seta_voltar_div">
                        <a href="#" onclick="window.history.back(); return false;" 
                           class="verificar_administrar_pedidos_sessao_seta_voltar">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        <h1>Verificar e administrar pedidos</h1>
                    </div>

                    <!-- Campo de pesquisa -->
                    <form action="" class="verificar_administrar_pedidos_sessao_formulario_pesquisa">
                        <input type="text" placeholder="Pesquisar">
                        <button type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <hr class="verificar_administrar_pedidos_sessao_divisao">
        </section>

        <!-- Card de pedido -->
        <div class="verificar_administrar_pedidos_sessao_visualizar">
            <div class="verificar_administrar_pedidos_sessao_pedidos">
                <table>
                    <tr>
                        <th class="header-cliente-name-verificar-administar header-cell-gerenciar-clientes">Pedido</th>
                        <th class="header-cell-verificar-administar-pedidos">Abertura</th>
                        <th class="header-cell-verificar-administar-pedidoss">Status</th>
                        <th class="header-cell-verificar-administar-pedidos">Cliente</th>
                        <th class="header-cell-verificar-administar-pedidos">Preço</th>
                        <th class="header-cell-verificar-administar-pedidos">CPJ/CPF</th>
                        <th class="header-cell-verificar-administar-pedidos">Verificar</th>
                    </tr>
                    <tr>
                        <td class="product-name-atualizar-produtos cell-atualizar-produto">xxxxx</td>

                        <td class="product-category-atualizar-produtos cell-atualizar-produto">xxxxx</td>

                        <td class="qt-atualizar-produtos cell-atualizar-produto">pendente</td>

                        <td class="price-atualizar-produtos cell-atualizar-produto">fulano</td>

                        <td class="price-atualizar-produtos cell-atualizar-produto">5.000</td>

                        <td class="price-atualizar-produtos cell-atualizar-produto">014.254.789-50</td>

                        <td class="lupa-administar-pedidos cell-atualizar-produto">
                            <a href="verificar_pedidos_infos.php"> <i class="bi bi-search"></i></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </main>
</body>
</html>

<?php include 'footer.php'; ?>
