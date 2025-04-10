<?php
session_start();

$userData = [
    'name' => 'Fulano da Silva Pinto Soares',
    'email' => 'sample123@gmail.com'
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="back-link">
                <span class="arrow">‹</span>
                <span class="text">Meu perfil</span>
            </div>
        </header>

        <main>
            <div class="profile-section">
                <div class="profile-image">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" fill="#4F6F52"/>
                        <path d="M12.0002 14.5C6.99016 14.5 2.91016 17.86 2.91016 22C2.91016 22.28 3.13016 22.5 3.41016 22.5H20.5902C20.8702 22.5 21.0902 22.28 21.0902 22C21.0902 17.86 17.0102 14.5 12.0002 14.5Z" fill="#4F6F52"/>
                    </svg>
                </div>
                <div class="profile-info">
                    <h1><?php echo htmlspecialchars($userData['name']); ?></h1>
                    <a href="mailto:<?php echo htmlspecialchars($userData['email']); ?>" class="email">
                        <?php echo htmlspecialchars($userData['email']); ?>
                    </a>
                </div>
            </div>

            <div class="data-section">
                <h2>Meus dados</h2>
                <p class="security-message">Cliente, para sua segurança, para visualizar seus dados por favor insira sua senha:</p>
                
                <form action="visualizar-dados.php" method="POST">
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Digite sua senha:" required>
                    </div>
                    <button type="submit" class="btn-primary">Visualizar meus dados</button>
                </form>
            </div>

            <div class="logout-section">
                <button class="btn-logout">Logout</button>
            </div>
        </main>
    </div>
</body>
</html>

<?php 
     include('footer_cliente.php'); 
?>