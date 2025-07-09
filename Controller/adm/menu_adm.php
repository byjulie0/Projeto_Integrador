<!-- ISABELLA -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Página Inicial</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../View/public/css/adm.css">
    <script defer src="../../View/JS/menu_adm.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>

    <!-- Início do menu -->

    <section class="menu_adm">
        <button class="menu_adm_toggle">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="menu_content_adm">
            <div class="logo_menu_adm">
                <img src="../../view/public/imagens/logo.png" alt="" class="logo_menu_adm_img">
                <a href="pg_inicial_adm.php" class="logo_menu_adm_title">John Rooster</a>
            </div>
            <div class="nav_link_menu_adm">
                <li class="dropdown_menu_adm">
                    <a href="#" class="nav_item_pg_inicial_adm">Gerenciar produtos</a>
                    <ul class="submenu_adm">
                        <li><a href="adicionar_produto.php">Adicionar produtos</a></li>
                        <li><a href="catalogo_de_produtos_adm.php">Visualizar catálogo de produtos</a></li>
                    </ul>
                </li>
                <li class="dropdown_menu_adm">
                    <a href="gerenciar_clientes_adm.php" class="nav_item_pg_inicial_adm">Gerenciar clientes</a>
                </li>
                <li class="dropdown_menu_adm">
                    <a href="verificar_e_administrar_pedidos.php" class="nav_item_pg_inicial_adm">Gerenciar vendas</a>
                    
                </li>
            </div>
            <div class="search_container_menu_adm">
                <input type="text" placeholder="O que deseja buscar?" />
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <div class="nav_page_btns_menu_adm">

                <a href="verificar_e_administrar_pedidos.php" class="nav_btns_menu_adm">
                    <i class="bi bi-person"></i>
                    <span class="nav_text_menu_adm">Perfil</span>
                </a>
                <a href="../cliente/notificacao.php" class="nav_btns_menu_adm">
                    <i class="bi bi-bell"></i>
                    <span class="nav_text_menu_adm">Notificações</span>
                </a>
                <a href="#" class="nav_btns_menu_adm">
                    <i class="bi bi-file-bar-graph"></i>
                    <span class="nav_text_menu_adm">Geral</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Fim do menu -->

</body>

</html>