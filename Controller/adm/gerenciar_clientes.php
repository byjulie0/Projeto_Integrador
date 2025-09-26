
<?php include 'menu_inicial.php';?>
<?php include '../../Controller/utils/listar_clientes.php'?>
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
            <div id="search-bar-gerenciar-clientes">
                <input type="text" placeholder="Pesquisar" />
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <a href="#">Inativados</a>
        </div>

        <div id="break-line"></div>

        <div id="table2-gerenciar-clientes">
            <div id="table-space-gerenciar-clientes">
                <table>
                    <tr>
                        <th class="select-all-label-gerenciar-clientes">
                            <button>Selecionar tudo</button>
                        </th>
                        <th class="header-cliente-name-gerenciar-clientes header-cell-gerenciar-clientes">Nome do cliente</th>
                        <th class="header-cell-gerenciar-clientes">CPF</th>
                        <th class="header-cell-gerenciar-clientes">Data de cadastro</th>
                        <th class="header-exclude-gerenciar-clientes header-cell-gerenciar-clientes">Inativar</th>
                    </tr>

                    <?php if (!empty($cliente)): ?>
                        <?php foreach ($cliente as $c): ?>
                            <tr>
                                <td><input type="checkbox" name="cliente[]" value="<?= $c['id_cliente']; ?>" class="cliente-checkbox"></td>
                                <td><?= htmlspecialchars($c['cliente_nome']); ?></td>
                                <td><?= htmlspecialchars($c['cpf_cnpj']); ?></td>
                                <td><?= date("d/m/Y", strtotime($c['data_nasc'])); ?></td>
                            <td>
                                <button type="button"
                                        class="icon-toggle-btn"
                                        data-id="<?= $c['id_cliente']; ?>"
                                        aria-pressed="<?= $c['user_ativo'] == 0 ? 'true' : 'false'; ?>">
                                    <i class="fa-solid <?= $c['user_ativo'] == 0 ? 'fa-toggle-on' : 'fa-toggle-off'; ?>"></i>
                                </button>
                            </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align:center;">Nenhum cliente encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
$(document).on("click", ".icon-toggle-btn", function () {
    let btn = $(this);
    let id = btn.data("id");

    $.post("toggle_cliente.php", { id_cliente: id }, function (res) {
        if (res.success) {
         if (res.novo_status == 0) {
        btn.attr("aria-pressed", "true").html('<i class="fa-solid fa-toggle-on"></i>');
    } else {
        btn.attr("aria-pressed", "false").html('<i class="fa-solid fa-toggle-off"></i>');
    }
        } else {
            alert("Erro ao atualizar status!");
        }
    }, "json");
});
</script>

</body>
</html>

<?php include 'footer.php'; ?>
