<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Página Inicial</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm/menu_inicial.css">
    <script defer src="../../view/js/cliente/menu-pg-adm.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    <section class="menu-pg-adm">
        <div class="menu-content-pg-adm">
            <button class="menu-toggle">
                <i class="fa-solid fa-bars"></i>
                <script src="menu_hamburguer.js"></script>
            </button>
            <div class="logo-menu">
                <img src="../../view/public/imagens/logo.png" alt="" class="logo-menu-img">
                <a href="pg_inicial_cliente.php" class="logo-menu-title">John Rooster</a>
            </div>

            <div class="nav-link-pg-adm">
                <li class="dropdown_menu_adm">
                    <a href="#" class="nav-item-pg-adm">Gerenciar produtos</a>

                    <ul class="submenu_adm">
                        <li><a href="adicionar_produto.php">Adicionar produtos</a></li>
                        <li><a href="catalogo_produtos.php">Visualizar catálogo de produtos</a></li>
                    </ul>

                </li>
                <a href="gerenciar_clientes.php" class="nav-item-pg-adm">Gerenciar clientes</a>
                <a href="verificar_administrar_pedido.php" class="nav-item-pg-adm">Gerenciar vendas</a>
            </div>

            <div class="nav-page-btns-pg-adm">
                <li class="dropdown_menu_adm">
                    <a href="#" class="nav-btns-pg-adm">
                        <i class="bi bi-person"></i>
                        <span class="nav-text-pg-adm">Perfil</span>
                    </a>
                    <ul class="submenu_adm">
                        <li><a href="meu_perfil.php">Meus dados</a></li>
                        <li><a href="redefinir_senha.php">Redefinir senha</a></li>
                    </ul>
                </li>
                <a href="notificacao.php" class="nav-btns-pg-adm">
                    <i class="bi bi-bell"></i>
                    <span class="nav-text-pg-adm">Notificações</span>
                </a>
                <a href="relatorios_visualizar.php" class="nav-btns-pg-adm">
                    <i class="bi bi-file-bar-graph"></i>
                    <span class="nav-text-pg-adm">Geral</span>
                </a>
            </div>

        </div>
    </section>
</body>

</html>