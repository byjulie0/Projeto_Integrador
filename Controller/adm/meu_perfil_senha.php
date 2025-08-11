<!-- Arthur -->
<?php include 'menu_inicial.php';?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="../../view/public/css/adm/meu_perfil_senha.css">
</head>
<body class="body-arthura">
    <div class="header-arthura">
        <h2 class="visualizar-dados-title"><a href="#" onclick="window.history.back(); return false";><i class="bi bi-chevron-left"></i></a>Meu Perfil</h2>
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
                    <div class="user-name-arthura">Jonh Rooster</div>
                    <div class="user-email-arthura">ID do vendedor: 0000</div>
                </div>
            </div>
        </div>

        <div class="card-arthura">
            <div class="section-title-arthura">Meus dados</div>
            <div class="section-text-arthura">Para sua segurança, insira sua senha para visualizar os dados:</div>
            
            <form>
                <input type="password" class="password-input-arthura" placeholder="Digite sua senha:">
                <a href="meu_perfil_editar.php"><button type="button" class="view-button-arthura">Visualizar meus dados</button></a>
            </form>
        </div>
        <a href="login_adm.php">
            <button type="button" class="logout-button-arthura">Logout</button>
        </a>
    </div>
</body>
</html>
<?php include 'footer.php';?>
