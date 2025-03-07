<?php 
     include('menu-pg-inicial.php'); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Página Cliente</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/Projeto_Integrador/view/public/css/cliente.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<main class ="main-arthur">
      <div class="back-link-arthur">
        <a href="#"><span class="arrow-arthur">←</span> Editar meus dados</a>
      </div>

      <form class="edit-form-arthur">
        <div class="form-row-arthur">
          <div class="form-group-arthur">
            <label class ="label-arthur" for="name">Nome: </label>
            <input class ="input-arthur" type="text" id="name" placeholder="Fulano da Silva Pinto Soares">
          </div>
          <div class="form-group-arthur">
            <label class ="label-arthur" for="address">Endereço:</label>
            <input class ="input-arthur" type="text" id="address" placeholder="Rua General Exemplo do Exemplo, 24...">
          </div>
        </div>

        <div class="form-row-arthur">
          <div class="form-group">
            <label class ="label-arthur" for="phone">Telefone:</label>
            <input class ="input-arthur" type="tel" id="phone" placeholder="+55 67 XXXXX-XXXX">
          </div>
          <div class="form-group-arthur">
            <label class ="label-arthur" for="birthdate">Data de nascimento:</label>
            <input class ="input-arthur" type="text" id="birthdate" placeholder="XX/XX/XXXX">
            <small class="warning-arthur">Sua idade só pode ser alterada 1 única vez, caso seja detectado que o usuário se registrou em nosso site antes da maioridade (18 anos, em território brasileiro) ou a idade disposta seja menor que 18, sua conta será suspensa!</small>
          </div>
        </div>

        <div class="form-group-arthur">
          <label class ="label-arthur" for="email">E-mail:</label>
          <input class ="input-arthur" type="email" id="email" placeholder="sample123@email.com">
        </div>

        <div class="form-actions-arthur">
          <a href="#" class="change-password-arthur">Alterar senha</a>
          <button type="submit" class="save-button-arthur">Salvar</button>
        </div>
      </form>
    </main>
</body>
</html>

<?php 
     include('footer_cliente.php'); 
?>