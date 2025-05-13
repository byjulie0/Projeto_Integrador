/*?php include "menu-pg-inicial.php";?>*/

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="perfiladm2.css">
    <title>Document</title>
</head>
<body>
     <!-- Seta de retorno -->
  <a href="javascript:history.back()" class="seta-voltar">←</a>
<main>
        <h1>Meu perfil</h1>
        <section class="perfil">
            <div class="avatar">
                <img src="transferir.png" alt="Avatar">
                <h2>John Rooster</h2>
                <p>ID do vendedor: 0000</p>
            </div>
            <div class="dados">
                
                <p><strong>Nome:</strong> Fulano da Silva Soares</p>
                <p><strong>E-mail:</strong> sample123@gmail.com</p>
                <p><strong>Telefone:</strong> +55 67 XXXXX-XXXX</p>
                <p><strong>Função:</strong> Administrador geral</p>
                <p><strong>Data de criação da conta:</strong> xx/xx/xxxx</p>
                
            </div>
            <div class ="meus_dados">
                <strong>Meus dados</strong>
            </div>
            <div class="botoes">
                    <button class="editar">Editar meus dados</button>
                    <button class="logout">Logout</button>
                </div>
        </section>
    </main>
</body>
<!-- <?php
    include "footer_adm.php"
    ?> -->
</html>