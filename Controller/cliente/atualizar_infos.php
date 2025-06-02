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
<section class="area-atualizar-infos">
    <div class="form-container-atualizar-infos">
      <a href="#" class="back-arrow-atualizar-infos"><i class="bi bi-chevron-left"></i></a>
      <h2 class="h2-atualizar-infos">Editar meus dados</h2>

      <form class="form-atualizar-infos" method="post" action="processar_atualizacao.php">
        <div class="form-grid-atualizar-infos">
          <div class="form-group-atualizar-infos">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" class="input-atualizar-infos" placeholder="Fulano da Silva Pinto Soares">
          </div>

          <div class="form-group-atualizar-infos">
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" class="input-atualizar-infos" placeholder="Rua General Exemplo do Exemplo, 24...">
          </div>

          <div class="form-group-atualizar-infos">
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" class="input-atualizar-infos" placeholder="+55 67 XXXXX-XXXX">
          </div>

          <div class="form-group-atualizar-infos">
            <label for="nascimento">Data de nascimento:</label>
            <input type="date" id="nascimento" name="nascimento" class="input-atualizar-infos">
          </div>

          <div class="form-group-atualizar-infos full-width">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" class="input-atualizar-infos" placeholder="sample123@gmail.com">
          </div>
        </div>

        <p class="warning-atualizar-infos">
          <strong>Atenção:</strong> Sua idade só pode ser alterada 1 única vez. Caso seja detectado que o usuário se registrou em nosso site antes da maioridade (18 anos, em território brasileiro) ou a idade inserida seja menor que 18, sua conta será suspensa!
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