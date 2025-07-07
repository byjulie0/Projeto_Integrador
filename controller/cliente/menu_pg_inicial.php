<!-- ANA JULIA -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Página Inicial</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
    <script defer src="../../view/js/menu-pg-inicial.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>

    <!-- Início do menu -->

    <section class="menu-pg-inicial">
        <button class="menu-toggle">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="menu-content-pg-inicial">
            <div class="logo-menu">
                <img src="../../view/public/imagens/logo.png" alt="" class="logo-menu-img">
                <a href="pg_inicial_cliente.php" class="logo-menu-title">John Rooster</a>
            </div>
            <div class="nav-link-pg-inicial">
                <li class="dropdown_menu_cliente">
                    <a href="#pg_inicial_categorias" class="nav-item-pg-inicial">Categorias</a>

                    <ul class="submenu_cliente">
                        <li><a href="#">Bovinos</a></li>
                        <li><a href="#">Equinos</a></li>
                        <li><a href="#">Galináceos</a></li>
                        <li><a href="#">Produtos gerais</a></li>
                    </ul>

                </li>
                <a href="" class="nav-item-pg-inicial">Campeões do mês</a>
                <a href="mais_vendidos_pg_inicial.php" class="nav-item-pg-inicial">Mais vendidos</a>
            </div>
            <div class="search-container-pg-inicial">
                <input type="text" placeholder="O que deseja buscar?" />
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <div class="nav-page-btns-pg-inicial">
                <li class="dropdown_menu_cliente">
                    <a href="#" class="nav-btns-pg-inicial">
                        <i class="bi bi-person"></i>
                        <span class="nav-text-pg-inicial">Perfil</span>
                    </a>
                    <ul class="submenu_cliente">
                        <li><a href="meu_perfil.php">Meu perfil</a></li>
                        <li><a href="#">Minhas compras</a></li>
                        <li><a href="pg_favoritos.php">Produtos favoritados</a></li>
                    </ul>

                </li>
                <a href="notificacao.php" class="nav-btns-pg-inicial">
                    <i class="bi bi-bell"></i>
                    <span class="nav-text-pg-inicial">Notificações</span>
                </a>
                <a href="carrinho.php" class="nav-btns-pg-inicial">
                    <i class="bi bi-cart"></i>
                    <span class="nav-text-pg-inicial">Carrinho</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Fim do menu -->

</body>

</html>