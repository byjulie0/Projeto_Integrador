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
                            <a class="filtro_todos"
                               href="?<?= isset($_GET['pesquisa']) ? 'pesquisa=' . urlencode($_GET['pesquisa']) : '' ?>">Todos</a>
                            <a class="filtro_pendente"
                               href="?status=Pendente<?= isset($_GET['pesquisa']) ? '&pesquisa=' . urlencode($_GET['pesquisa']) : '' ?>">Pendente</a>
                            <a class="filtro_concluido"
                               href="?status=Concluído<?= isset($_GET['pesquisa']) ? '&pesquisa=' . urlencode($_GET['pesquisa']) : '' ?>">Concluído</a>
                            <a class="filtro_cancelados"
                               href="?status=Cancelado<?= isset($_GET['pesquisa']) ? '&pesquisa=' . urlencode($_GET['pesquisa']) : '' ?>">Cancelado</a>
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
                                <th>Pedido</th>
                                <th>Abertura</th>
                                <th>Status</th>
                                <th>Cliente</th>
                                <th>Preço</th>
                                <th>CPJ/CPF</th>
                                <th>Verificar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $pedidos = $pedidos ?? [];
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
                                        <td><?= htmlspecialchars($pedido['id_pedido']) ?></td>
                                        <td><?= htmlspecialchars($pedido['data_pedido']) ?></td>
                                        <td><?= htmlspecialchars($pedido['status_pedido']) ?></td>
                                        <td><?= htmlspecialchars($pedido['cliente_nome']) ?></td>
                                        <td>R$ <?= number_format($pedido['valor_pedido'] ?? 0, 2, ',', '.') ?></td>
                                        <td><?= htmlspecialchars($pedido['cpf_cnpj']) ?></td>
                                        <td>
                                            <a href="verificar_pedido_infos.php?id=<?= $pedido['id_pedido'] ?>">
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
