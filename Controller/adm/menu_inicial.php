<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Menu Página Inicial</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../view/public/css/adm/menu_inicial.css" />
    <script defer src="../../view/js/adm/menu-pg-adm.js"></script>
</head>

<body>
    <section class="menu-pg-adm">
        <div class="menu-content-pg-adm">
            <button class="menu-toggle" aria-label="Abrir menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="logo-menu">
                <img src="../../view/public/imagens/logo.png" alt="Logo John Rooster" class="logo-menu-img" />
                <a href="relatorios_visualizar.php" class="logo-menu-title">John Rooster</a>
            </div>

            <ul class="nav-link-pg-adm">
                <li class="dropdown_menu_adm">
                    <a href="#" class="nav-item-pg-adm">Gerenciar produtos</a>
                    <ul class="submenu_adm">
                        <li><a href="adicionar_produto.php">Adicionar produtos</a></li>
                        <li><a href="catalogo_produtos.php">Visualizar catálogo de produtos</a></li>
                    </ul>
                </li>
                <li><a href="gerenciar_clientes.php" class="nav-item-pg-adm">Gerenciar clientes</a></li>
                <li><a href="verificar_administrar_pedido.php" class="nav-item-pg-adm">Gerenciar vendas</a></li>
            </ul>

            <div class="nav-page-btns-pg-adm">
                <div class="dropdown_menu_adm">
                    <a href="#" class="nav-btns-pg-adm" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-person"></i>
                        <span class="nav-text-pg-adm">Perfil</span>
                    </a>
                    <ul class="submenu_adm">
                        <li><a href="meu_perfil.php">Meus dados</a></li>
                        <li><a href="formulario_alterar_senha_adm.php">Redefinir senha</a></li>
                        <li><a href="#" onclick="mostrarAlerta(event)">Fazer backup</a></li>
                    </ul>
                </div>
                <a href="pg_notificacao.php" class="nav-btns-pg-adm">
                    <i class="bi bi-bell"></i>
                    <span class="nav-text-pg-adm">Notificações</span>
                </a>
            </div>
        </div>
        <script>
            function mostrarAlerta(event) {
            event.preventDefault();
            alert('Backup iniciado! Aguarde alguns instantes...');
            window.location.href = "../../model/DB/backup.php";
            }
        </script>
    </section>
</body>

</html>
