<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Página Inicial</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../View/public/css/adm/menu_inicial.css">
    <script defer src="../../View/JS/menu_adm.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <section class="menu">
        <button class="menu_toggle">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="menu_content">
            <div class="logo_menu">
                <img src="../../view/public/imagens/logo.png" alt="" class="logo_menu_img">
                <a href="pg_inicial.php" class="logo_menu_title">John Rooster</a>
            </div>

            <div class="nav_link_menu">
                <li class="dropdown_menu">
                    <a href="#" class="nav_item_pg_inicial">Gerenciar produtos</a>

                    <ul class="submenu">
                        <li><a href="adicionar_produto.php">Adicionar produtos</a></li>
                        <li><a href="catalogo_produtos.php">Visualizar catálogo de produtos</a></li>
                    </ul>

                </li>
                <a href="gerenciar_clientes.php" class="nav_item_pg_inicial">Gerenciar clientes</a>
                <a href="verificar_administrar_pedido.php" class="nav_item_pg_inicial">Gerenciar vendas</a>

            </div>

            <div class="nav_page_btns_menu">
                <li class="dropdown_menu">
                    <a href="#" class="nav_btns_pg_inicial">
                        <i class="bi bi-person"></i>
                        <span class="nav_text_pg_inicial">Perfil</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="meu_perfil.php">Meus dados</a></li>
                        <li><a href="redefinir_senha.php">Redefinir senha</a></li>
                    </ul>
                </li>
                <a href="notificacao.php" class="nav_btns_menu">
                    <i class="bi bi-bell"></i>
                    <span class="nav_text_menu">Notificações</span>
                </a>
                <a href="relatorios_visualizar.php" class="nav_btns_menu">
                    <i class="bi bi-file-bar-graph"></i>
                    <span class="nav_text_menu">Geral</span>
                </a>
            </div>
        </div>
    </section>
</body>

</html>