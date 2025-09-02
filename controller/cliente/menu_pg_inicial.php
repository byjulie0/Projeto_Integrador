<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Página Inicial</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/cliente/menu_pg_inicial.css">
    <script defer src="../../view/js/cliente/menu-pg-inicial.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>

    <section class="menu-pg-inicial">
        
        <div class="menu-content-pg-inicial">
            <button class="menu-toggle">
                <i class="fa-solid fa-bars"></i>
                <script src="menu_hamburguer.js"></script>
            </button>
            <div class="logo-menu">
                <img src="../../view/public/imagens/logo.png" alt="" class="logo-menu-img">
                <a href="pg_inicial_cliente.php" class="logo-menu-title">John Rooster</a>
            </div>

            <div class="nav-link-pg-inicial">
                <li class="dropdown_menu_cliente">
                    <a href="#pg_inicial_categorias" class="nav-item-pg-inicial">Categorias</a>

                    <ul class="submenu_cliente">
                        <li><a href="categoria_bovinos.php">Bovinos</a></li>
                        <li><a href="categoria_equinos.php">Equinos</a></li>
                        <li><a href="categoria_galinaceos.php">Galináceos</a></li>
                        <li><a href="categoria_campeoes.php">Campeões</a></li>
                        <li><a href="categoria_produtos.php">Produtos gerais</a></li>
                    </ul>

                </li>
                <a href="categoria_campeoes.php" class="nav-item-pg-inicial">Campeões do mês</a>
                <a href="#maisvendidos" class="nav-item-pg-inicial">Mais vendidos</a>
            </div>

            <div class="search-container-pg-inicial">
                <input type="text" placeholder="O que deseja buscar?" />
                <button type="submit">
                    <a href="pg_busca.php"><i class="fa-solid fa-magnifying-glass"></i></a>
                </button>
            </div>

            <div class="nav-page-btns-pg-inicial">
                <li class="dropdown_menu_cliente">
                    <a href="#" class="nav-btns-pg-inicial">
                        <i class="bi bi-person"></i>
                        <span class="nav-text-pg-inicial">Perfil</span>
                    </a>
                    <ul class="submenu_cliente">
                        <li><a href="login.php">Login</a></li>
                        <li><a href="meu_perfil.php">Meu perfil</a></li>
                        <li><a href="pg_favoritos.php">Produtos favoritados</a></li>
                    </ul>

                </li>
                <a href="pg_notificacao.php" class="nav-btns-pg-inicial">
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
</body>

</html>