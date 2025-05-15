<!-- MARIANA -->
<?php
 include 'menu_pg_inicial.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar meus dados</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../view/public/css/cliente.css">

</head>
<body >
    <section class= "area-atualizar-infos">
        <div class="form-container-atualizar-infos">
        <a href="#" class="back-arrow-atualizar-infos">←</a>
            <h2 class= "h2-atualizar-infos">Editar meus dados</h2>

            <form class= "form-atualizar-infos">
            <div class="form-grid-atualizar-infos">
                <div class="form-group-atualizar-infos">
                <label class= "label-atualizar-infos" for="nome">Nome:</label>
                <input class= "input-atualizar-infos" type="text" id="nome" placeholder="Fulano da Silva Pinto Soares">
                </div>

                <div class="form-group-atualizar-infos">
                <label class= "label-atualizar-infos" for="endereco">Endereço:</label>
                <input class= "input-atualizar-infos" type="text" id="endereco" placeholder="Rua General Exemplo do Exemplo, 24...">
                </div>

                <div class="form-group-atualizar-infos">
                <label class= "label-atualizar-infos" for="telefone">Telefone:</label>
                <input class= "input-atualizar-infos" type="text" id="telefone" placeholder="+55 67 XXXXX-XXXX">
                </div>

                <div class="form-group-atualizar-infos">
                <label class= "label-atualizar-infos" for="nascimento">Data de nascimento:</label>
                <input class="input-atualizar-infos" type="date" id="nascimento">
                </div>

                <div class="form-group-atualizar-infos full-width">
                <label class= "label-atualizar-infos" for="email">E-mail:</label>
                <input class= "input-atualizar-infos" type="email" id="email" placeholder="sample123@gmail.com">
                </div>
            </div>

            <p class="warning-atualizar-infos">
                <strong>Atenção:</strong> Sua idade só pode ser alterada 1 única vez, caso seja detectado que o usuário se registrou em nosso site antes da maioridade (18 anos, em território brasileiro) ou a idade inserida seja menor que 18, sua conta será suspensa!
            </p>

            <div class="buttons-atualizar-infos">
                <a href="#" class="link-btn-atualizar-infos">Alterar senha</a>
                <button type="submit" class="submit-btn-atualizar-infos">Salvar</button>
            </div>
            </form>
        </div>
    </section>
</body>
</html>



<?php

include 'footer_cliente.php';
?>


.