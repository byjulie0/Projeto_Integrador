<?php include 'menu_inicial.php';?>
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Peril - Visualizar Dados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../view/public/css/adm/meu_perfil.css">
</head>
</head>
<body class="body-visualizar-dados">
    <main class="main-visualizar-dados">
        <h2 class="visualizar-dados-title">
            <a class="a-style" href="meu_perfil_senha.php">
                <i class="bi bi-chevron-left"></i> Meu Perfil
            </a>
        </h2>
        
        <div class="visualizar-dados-card">
            <div class="visualizar-dados-header">
        <div class="visualizar-dados-img-perfil-div">
            <i class="bi bi-person-circle"></i>
        </div>
        <div class="visualizar-dados-nome-email">
            <h4 class="visualizar-dados-nome">Administrador Jonh Rooster</h4>
            <h5 class="visualizar-dados-email">jonhrooster@gmail.com</h5>
        </div>
    </div>
    
    <div class="visualizar-dados-geral">
        <h3 class="visualizar-dados-geral-title">Meus Dados</h3>
        <div class="visualizar-dados-grid">
            <p>Nome: Administrador Jonh Rooster</p>
            <p>Telefone: +55 67 91234-5678</p>
            <p>E-mail: jonhrooster@gmail.com</p>
            <p>CNPJ: 12.345.678/0001-95</p>
        </div>
    </div>
    
    <div class="visualizar-dados-area-botoes">
        <a href="meu_perfil_editar.php">
            <?php
            $texto = "Editar meus dados";
            include '../cliente/botao_verde_cliente.php';
            ?>
        </a>
        <a href="login.php">
            <?php 
            include '../cliente/botao_logout.php';?>
        </a>
    </div>
</div>
</main>
</body>

</html>

<?php include 'footer.php';?>
<!-- TALVEZ OS INPUTS SEJAM NECESSÁRIOS PARA O BACKEND <p class="vizualizar-dados-geral-nome">
    <label for="name" class="visualizar-dados-label">Nome:
        <input type="text" id="adm_nome" class="form-input" placeholder="Administrador Jonh Rooster" readonly>
    </label>
</p>
<p class="vizualizar-dados-geral-email">
    <label for="email" class="visualizar-dados-label">E-mail:
        <input type="email" id="email" class="form-input" placeholder="jonhrooster@gmail.com" readonly>
    </label>
</p>
<p class="vizualizar-dados-geral-telefone">
    <label for="telefone" class="visualizar-dados-label">Telefone:
        <input type="tel" id="telefone" class="form-input" placeholder="+55 67 91234-5678" readonly>
    </label>
</p>
<p class="vizualizar-dados-geral-datanasc">
    <label for="cnpj" class="form-label">CNPJ:
        <input type="text" id="cnpj" class="form-input" placeholder="12.345.678/0001-95" readonly>
    </label>
</p> -->