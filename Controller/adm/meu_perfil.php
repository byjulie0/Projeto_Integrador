<?php
include 'menu_adm.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Peril - Visualizar Dados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
</head>
</head>
 
<body class="body-visualizar-dados">
    <h2 class="visualizar-dados-title">
        <a class="a-style" href="meu_perfil_senha.php"><a href="#" onclick="window.history.back(); return false";><i class="bi bi-chevron-left"></i></a>Meu Perfil ADM</a>
    </h2>
    <main class="main-visualizar-dados">
 
       
       
        <div class="visualizar-dados-card">
            <div class="visualizar-dados-nome-email-img">
                <div class="visualizar-dados-img-perfil-div">
                    <i class="bi bi-person-circle"></i>
                </div>
                <div class="visualizar-dados-nome-email">
                    <h4 class="visualizar-dados-nome">Jonh Rooster</h4>
                    <h5 class="visualizarados-email">ID do vendedor: 0000</h5>
                </div>
            </div>
           
            <div class="visualizar-dados-geral">
                <h3 class="visualizar-dados-geral-title">Meus Dados</h3>
                <div class="visualizar-dados-geral0">
                    <div class="visualizar-dados-geral1">
                        <p class="vizualizar-dados-geral-nome">
                            <label class="visualizar-dados-label">Nome: </label>Administrador John Rooster
                        </p>
                        <p class="vizualizar-dados-geral-telefone">
                            <label class="visualizar-dados-label">Telefone: </label>+55 67 XXXXX-XXXX
                        </p>
                        <p class="vizualizar-dados-geral-email">
                            <label class="visualizar-dados-label">E-mail: </label>sample123@gmail.com
                        </p>
                    </div>
                    <div class="visualizar-dados-geral2">
                        <p class="vizualizar-dados-geral-endereco">
                            <label class="visualizar-dados-label">Função: </label>Administrador Geral
                        </p>
                        <p class="vizualizar-dados-geral-datanasc">
                            <label class="visualizar-dados-label">Data de Criação da conta: </label>XX/XX/XXXX
                        </p>
                    </div>
                </div>
            </div>
           
            <div class="visualizar-dados-area-botoes">
                <a href="meu_perfil_senha.php">
                    <button class="visualizar-dados-editar">Editar meus dados</button>
                </a>
                <a href="login.php">
                <button class="visualizar-dados-logout">Logout</button>
                </a>
            </div>
        </div>
    </main>
</body>
</html>
 
<?php include 'footer_adm.php';?>