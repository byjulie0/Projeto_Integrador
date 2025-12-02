<?php
include '../utils/autenticado_adm.php';
if ($adm_nao_logado) {
    include '../overlays/pop_up_login_adm.php';
    exit;
}
include '../utils/listar_clientes.php';
include 'menu_inicial.php';

// Verificar se há mensagens de pop-up na sessão
if (isset($_SESSION['popup_message'])) {
    $titulo = $_SESSION['titulo'];
    $texto = $_SESSION['popup_message'];

    // Verificar se é sucesso
    if ($_SESSION['type'] == 'success') {
        $sucesso = true;
    }
    include '../overlays/pop_up_erro.php';

    // Limpar a sessão
    unset($_SESSION['titulo']);
    unset($_SESSION['popup_message']);
    unset($_SESSION['type']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Clientes</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../view/public/css/adm/gerenciar_clientes.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="../../view/js/adm/buscar_cliente.js"></script>
</head>

<body>
    <section id="gerenciar-clientes">
        <div id="page-title-gerenciar-clientes">
            <div id="title-gerenciar-clientes">
                <a href="#" onclick="window.history.back(); return false;">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <h3>Gerenciar clientes cadastrados</h3>
            </div>
        </div>

        <div id="page-content-gerenciar-clientes">
            <div class="first-container-gerenciar-clientes">
                <form method="GET" id="form-pesquisa-gerenciar-clientes">
                    <div id="search-bar-gerenciar-clientes">
                        <input type="text" id="campo-busca" placeholder="Pesquisar..." autocomplete="off">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </form>
                <form method="get" action="gerenciar_clientes.php" class="botoes_filtros_clientes">
                    <button type="submit" name="status" value="todos"
                        class="gerenciar_clientes_botao_todos">Todos</button>
                    <button type="submit" name="status" value="ativos"
                        class="gerenciar_clientes_botao_ativos">Ativos</button>
                    <button type="submit" name="status" value="inativos"
                        class="gerenciar_clientes_botao_inativos">Inativados</button>
                </form>
            </div>

            <div id="table2-gerenciar-clientes">
                <div id="table-space-gerenciar-clientes">
                    <table class="tabela-clientes">
                        <thead>
                            <tr>
                                <th>Nome do cliente</th>
                                <th>CPF</th>
                                <th>Data de Nascimento</th>
                                <th>Inativos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($cliente)): ?>
                                <?php foreach ($cliente as $c): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($c['cliente_nome']); ?></td>
                                        <td><?= htmlspecialchars($c['cpf_cnpj']); ?></td>
                                        <td><?= date("d/m/Y", strtotime($c['data_nasc'])); ?></td>
                                        <td>
                                            <form method="POST" action="../utils/toggle_cliente.php" style="display:inline;">

                                                <input type="hidden" name="id_cliente" value="<?= $c['id_cliente'] ?>">
                                                <input type="hidden" name="user_ativo" value="<?= $c['user_ativo'] ?>">

                                                <?php
                                                $icone = $c['user_ativo'] ? 'fa-toggle-off' : 'fa-toggle-on';
                                                $ariaPressed = $c['user_ativo'] ? 'false' : 'true';
                                                ?>

                                                <button type="submit" name="toggle_cliente" class="icon-toggle-btn"
                                                    aria-pressed="<?= $ariaPressed ?>">
                                                    <i class="fa-solid <?php echo $icone; ?>"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;">Nenhum cliente encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>

</body>

</html>