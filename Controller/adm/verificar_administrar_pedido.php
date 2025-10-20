<?php
require_once(__DIR__ . "/../utils/listar_pedidos_adm.php");
?>

<?php include 'menu_inicial.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="../../view/public/css/adm/verificar_administrar_pedido.css">
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

                    <div class="first-container-atualizar-produtos">
                        <form action="" method="GET" class="verificar_administrar_pedidos_sessao_formulario_pesquisa">
                            <input type="text" name="pesquisa" placeholder="Pesquisar"
                                value="<?= htmlspecialchars($_GET['pesquisa'] ?? '') ?>">
                            <button type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>

                        <div class="filtros_pedidos">

                            <button class="filtro_todos"
                                href="?<?= isset($_GET['pesquisa']) ? 'pesquisa=' . urlencode($_GET['pesquisa']) : '' ?>">Todos</button>

                            <button class="filtro_pendente"

                                href="?status=pendente<?= isset($_GET['pesquisa']) ? '&pesquisa=' . urlencode($_GET['pesquisa']) : '' ?>">Pendente</button>

                            <button class="filtro_concluido"

                                href="?status=concluído<?= isset($_GET['pesquisa']) ? '&pesquisa=' . urlencode($_GET['pesquisa']) : '' ?>">Concluído</button>

                            <button class="filtro_cancelados"
                                href="?status=cancelado<?= isset($_GET['pesquisa']) ? '&pesquisa=' . urlencode($_GET['pesquisa']) : '' ?>">Cancelado</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="verificar_administrar_pedidos_sessao_divisao">
        </section>

        <div class="verificar_administrar_pedidos_sessao_visualizar">
            <div class="table-container">
                <div class="verificar_administrar_pedidos_sessao_pedidos">
                    <table>
                        <thead>
                            <tr class="linha_cinza">
                                <th class="header-cliente-name-verificar-administar header-cell-gerenciar-clientes">
                                    Pedido</th>
                                <th class="header-cell-verificar-administar-pedidos">Abertura</th>
                                <th class="header-cell-verificar-administar-pedidoss">Status</th>
                                <th class="header-cell-verificar-administar-pedidos">Cliente</th>
                                <th class="header-cell-verificar-administar-pedidos">Preço</th>
                                <th class="header-cell-verificar-administar-pedidos">CPJ/CPF</th>
                                <th class="header-cell-verificar-administar-pedidos">Verificar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $status = $_GET['status'] ?? '';
                            $pesquisa = $_GET['pesquisa'] ?? '';

                            $pedidos_filtrados = [];

                            foreach ($pedidos as $pedido) {
                                $matchStatus = !$status || strtolower($pedido['status_pedido']) === strtolower($status);
                                $matchPesquisa = !$pesquisa || stripos($pedido['cliente_nome'], $pesquisa) !== false;

                                if ($matchStatus && $matchPesquisa) {
                                    $pedidos_filtrados[] = $pedido;
                                }
                            }

                            if (!empty($pedidos_filtrados)):
                                foreach ($pedidos_filtrados as $pedido):
                                    ?>
                                    <tr>
                                        <td class="product-name-atualizar-produtos cell-atualizar-produto">
                                            <?= htmlspecialchars($pedido['id_pedido']) ?>
                                        </td>

                                        <td class="product-category-atualizar-produtos cell-atualizar-produto">
                                            <?= htmlspecialchars($pedido['data_pedido']) ?>
                                        </td>

                                        <td class="qt-atualizar-produtos cell-atualizar-produto">
                                            <?= htmlspecialchars($pedido['status_pedido']) ?>
                                        </td>

                                        <td class="price-atualizar-produtos cell-atualizar-produto">
                                            <?= htmlspecialchars($pedido['cliente_nome']) ?>
                                        </td>

                                        <td class="price-atualizar-produtos cell-atualizar-produto">
                                            R$ <?= number_format($pedido['preco_total'] ?? 0, 2, ',', '.') ?>
                                        </td>

                                        <td class="price-atualizar-produtos cell-atualizar-produto">
                                            <?= htmlspecialchars($pedido['cpf_cnpj']) ?>
                                        </td>

                                        <td class="lupa-administar-pedidos cell-atualizar-produto">
                                            <a href="verificar_pedidos_infos.php?id=<?= urlencode($pedido['id_pedido']) ?>">
                                                <i class="bi bi-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" style="text-align:center;">Nenhum pedido encontrado</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

<?php include 'footer.php'; ?>
