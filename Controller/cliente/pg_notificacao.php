<?php
include 'menu_pg_inicial.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../view/public/css/cliente/pg_notificacao.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
        integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Notificações</title>
</head>

<body>
    <div class="title_area_notifications">

        <div class="area_notifications">
        <a href="#" onclick="if (document.referrer) { history.back(); } else { window.location.href = 'menu_pg_inicial.php'; }" class=notification_arrow>
        <i class="fa-solid fa-chevron-left" style="color: #2d8c37;"></i>
        </a>
            <h1 class="notification_title">Notificações</h1>
        </div>
        <div class="notification_area">
            <div class="notification">
                <div class="notification_info">
                    <p class="notification_date">12/12/2024 - Produtos</p>
                    <p class="notification_text">{Usuário}, a sela que você estava de olho voltou ao estoque, dê uma
                        olhada!
                    </p>
                </div>
            </div>
            <div class="notification">
                <div class="notification_info">
                    <p class="notification_date">12/12/2024 - Produtos</p>
                    <p class="notification_text">{Usuário}, o Nelore que você estava de olho voltou ao estoque, dê uma
                        olhada!
                    </p>
                </div>
            </div>
            <div class="notification">
                <div class="notification_info">
                    <p class="notification_date">10/12/2024 - Produtos</p>
                    <p class="notification_text">{Usuário}, o Barred Plymouth Rock que você estava de olho voltou ao
                        estoque, dê uma olhada!
                    </p>
                </div>
            </div>
            <div class="notification">
                <div class="notification_info">
                    <p class="notification_date">10/12/2024 - Produtos</p>
                    <p class="notification_text">{Usuário}, o Rhode Island Red que você estava de olho voltou ao
                        estoque, dê
                        uma olhada!
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include 'footer_cliente.php';
?>