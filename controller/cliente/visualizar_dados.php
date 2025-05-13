<!-- Maria Helena -->
<?php
include 'menu_pg_inicial.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Peril - Visualizar Dados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../view/public/css/cliente.css">
  </head>
</head>
<body class="body-visualizar-dados">
    <main class="main-visualizar-dados">
        <h2 class="visualizar-dados-title"><i class="bi bi-chevron-left"></i>Meu Perfil</h2>
        <div class="visualizar-dados-nome-email-img">
            <div class="visualizar-dados-img-perfil-div">
                <i class="bi bi-person-circle"></i>
                <img src="" alt="">
            </div>
            <div class="visualizar-dados-nome-email">
                <h4 class="visualizar-dados-nome">Fulano da Silva Soares</h4>
                <h5 class="visualizarados-email">sample123@gmail.com</h5>
            </div>
        </div>
        <div class="visualizar-dados-geral">
            <h3 class="visualizar-dados-geral-title">Meus Dados</h3> 
            <div class="visualizar-dados-geral0">
                <div class="visualizar-dados-geral1">
                    <p class="vizualizar-dados-geral-nome"><label class="visualizar-dados-label">Nome: </label>Fulano da Silva Soares</p>
                    <p class="vizualizar-dados-geral-telefone"><label class="visualizar-dados-label">Telefone: </label>+55 67 XXXXX-XXXX</p>
                    <p class="vizualizar-dados-geral-email"><label class="visualizar-dados-label">E-mail: </label>sample123@gmail.com</p>
                </div>
                <div class="visualizar-dados-geral2">
                    <p class="vizualizar-dados-geral-endereco"><label class="visualizar-dados-label">Endereço: </label>Rua General Exemplo do Exemplo, 24 - Bairro Exemplo, Campo Grande-MS</p>
                    <p class="vizualizar-dados-geral-datanasc"><label class="visualizar-dados-label">Data de Nascimento: </label>XX/XX/XXXX</p>
                </div>
            </div>
        </div>
        <div class="visualizar-dados-area-botoes">
            <button class="visualizar-dados-editar">Editar meus dados</button>
            <button class="visualizar-dados-logout">Logout</button>
        </div>
    </main>
    <footer>
        <?php
            include 'footer_cliente.php';
        ?>
    </footer>
</body>
</html>

