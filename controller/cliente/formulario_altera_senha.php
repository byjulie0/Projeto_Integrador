<!-- Isabella -->
<?php
include 'menu_pg_inicial.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário para alteração de senha</title>
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
</head>
<body>
    <section id="section_formulario_senha">
        <div class="espaco_forms_senha">
            <div class="title_div">
                <a href="#" class="setinha_forms_mudar_senha">
                    <i class="fa-solid fa-chevron-left">
                    </i>
                </a>
                <h3 class="titulo_forms_senha">Alterar senha</h3>
            </div>
            <div class="area_forms">
                <p class="p_form_senha">Digite sua senha atual:</p>
                    <input type="password" class="form_senha_atual">
                <p class="p_form_senha">Digite sua nova senha:</p>
                    <input type="password" class="form_nova_senha">
                <p class="p_form_senha">Confirme sua nova senha:</p>
                    <input type="password" class="form_confirma_senha">
            </div>
        </div>
        <div class="div_confirmacao">
            <a href="#" class="esqueceu_senha">Esqueceu a senha?</a>
            <button class="salvar_nova_senha">Salvar</button>
        </div>
    </section>
</body>
</html>