<?php 
    include('menu-pg-inicial.php'); 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="../view/public/CSS/cliente.css">
</head>
<body class="body-arthura">
    <div class="header-arthura">
        <a href="#" class="back-arrow-arthura">&#10094;</a>
        <div class="title-arthura">Meu perfil</div>
    </div>
    <div class="wrapper-arthura">
        <div class="card-arthura">
            <div class="profile-arthura">
                <div class="avatar-arthura">
                    <svg class="avatar-icon-arthura" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <div class="user-info-arthura">
                    <div class="user-name-arthura">Fulano da Silva Pinto Soares</div>
                    <div class="user-email-arthura">sample123@gmail.com</div>
                </div>
            </div>
        </div>

        <div class="card-arthura">
            <div class="section-title-arthura">Meus dados</div>
            <div class="section-text-arthura">Cliente, para sua segurança, para visualizar seus dados por favor insira sua senha:</div>
            
            <form>
                <input type="password" class="password-input-arthura" placeholder="Digite sua senha:">
                <button type="button" class="view-button-arthura">Visualizar meus dados</button>
            </form>
        </div>

        <button type="button" class="logout-button-arthura">Logout</button>
    </div>
</body>
</html>
<?php
include 'footer_cliente.php';
?>
