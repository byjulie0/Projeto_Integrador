<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Página Inicial</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../view/public/css/cliente/menu_pg_inicial.css">
    <script defer src="../../view/js/cliente/menu-pg-inicial.js"></script>
    <script defer src="../../view/js/cliente/pg_busca.js"></script>
</head>

<body>
    <section class="menu-pg-inicial">
        <div class="menu-content-pg-inicial">
            <button class="menu-toggle" aria-label="Abrir menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="logo-menu">
                <img src="../../view/public/imagens/logo.png" alt="Logo John Rooster" class="logo-menu-img">
                <a href="pg_inicial_cliente.php" class="logo-menu-title">John Rooster</a>
            </div>

            <ul class="nav-link-pg-inicial">
                <li class="dropdown_menu_inicial">
                    <a href="#" class="nav-item-pg-inicial">Categorias</a>
                    <ul class="submenu_inicial">
                        <li><a href="categoria_produtos.php?id_categoria=1">Bovinos</a></li>
                        <li><a href="categoria_produtos.php?id_categoria=2">Equinos</a></li>
                        <li><a href="categoria_produtos.php?id_categoria=3">Galináceos</a></li>
                        <li><a href="categoria_produtos.php?id_categoria=4">Campeões</a></li>
                        <li><a href="categoria_produtos.php?id_categoria=5">Produtos gerais</a></li>
                    </ul>
                </li>
                <li><a href="categoria_campeoes.php" class="nav-item-pg-inicial">Campeões</a></li>
                <li><a href="#" class="nav-item-pg-inicial">Nossa história</a></li>
            </ul>

            <div class="nav-page-btns-pg-inicial">
                <div class="dropdown_menu_inicial">
                    <a href="#" class="nav-btns-pg-inicial" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-person"></i>
                        <span class="nav-text-pg-inicial">Perfil</span>
                    </a>
                    <ul class="submenu_inicial">
                        <li><a href="meu_perfil.php">Meus dados</a></li>
                        <li><a href="pg_favoritos.php">Favoritos</a></li>
                        <li><a href="login.php">Login - Usuário sem sessão</a></li>
                    </ul>
                </div>
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