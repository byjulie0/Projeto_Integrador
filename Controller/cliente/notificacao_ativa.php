<!DOCTYPE html>
<!-- Gabriel -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/public/css/cliente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Notificações</title>
</head>
<body>
    <main class="notificacao-usuario-main">
    <header class="header_not_ativa">
            <?php
            include 'menu-pg-inicial.php';
            ?>
        </header>
        <div class="notificacao-usuario-cabesalio">
            <title class="notificacao-usuario-title"></title>
            <div class="notificacao-usuario-notificacao">
                <i class="fa-solid fa-chevron-left" style="color: #2d8c37;"></i>
                <h1 class="notificacao-usuario-h1">NOTIFICAÇÃO</h1>
            </div>
            <button class="notificacao-usuario-filtro">
                <h2 class="notificacao-filtro-name">filtro</h2>
                <i class="notificacao-filtro-arrow"><i class="fa-solid fa-chevron-down"></i></i>
                </div>
            </button>
        </div>
        <div class="notificacao-linha-pad">
            <div class="notificacao-usuario-linha"></div>
        </div>
        <div class="notificacao-usuario-container">
            <div class="notificacao-usuario-card">
                <div class="notificacao-area-bolota">
                    <div class="notificacao-card-bolota">
                        <img src="../view/public/imagens/img_sela.png" alt="" class="descricao-card-img">
                    </div>
                </div>
                <div class="notificacao-usuario-card-text">
                    <div class="notificacao-card-data">
                        <h6>12/12/2024 - Produtos</h6>
                    </div>
                    <div class="notificacao-card-descricao">
                        <h3>Cliente, a cela que você estava de olho voltou ao estoque, dê uma olhada!</h3>
                    </div>    
                </div>
            </div>
            <div class="notificacao-usuario-card">
                <div class="notificacao-area-bolota">
                    <div class="notificacao-card-bolota">
                        <img src="../view/public/imagens/img_sela.png" alt="" class="descricao-card-img">
                    </div>
                </div>
                <div class="notificacao-usuario-card-text">
                    <div class="notificacao-card-data">
                        <h6>12/12/2024 - Produtos</h6>
                    </div>
                    <div class="notificacao-card-descricao">
                        <h3>Cliente, a cela que você estava de olho voltou ao estoque, dê uma olhada!</h3>
                    </div>    
                </div>
            </div>
            <div class="notificacao-usuario-card">
                <div class="notificacao-area-bolota">
                    <div class="notificacao-card-bolota">
                        <img src="../view/public/imagens/img_sela.png" alt="" class="descricao-card-img">
                    </div>
                </div>
                <div class="notificacao-usuario-card-text">
                    <div class="notificacao-card-data">
                        <h6>12/12/2024 - Produtos</h6>
                    </div>
                    <div class="notificacao-card-descricao">
                        <h3>Cliente, a cela que você estava de olho voltou ao estoque, dê uma olhada!</h3>
                    </div>    
                </div>
            </div>
            <div class="notificacao-usuario-card">
                <div class="notificacao-area-bolota">
                    <div class="notificacao-card-bolota">
                        <img src="../view/public/imagens/img_sela.png" alt="" class="descricao-card-img">
                    </div>
                </div>
                <div class="notificacao-usuario-card-text">
                    <div class="notificacao-card-data">
                        <h6>12/12/2024 - Produtos</h6>
                    </div>
                    <div class="notificacao-card-descricao">
                        <h3>Cliente, a cela que você estava de olho voltou ao estoque, dê uma olhada!</h3>
                    </div>    
                </div>
            </div>
        </div>
        <footer class="footer_not_ativa">
        <?php
            include 'footer_cliente.php';
        ?>
    
    </footer>
    </main>
</body>
</html>