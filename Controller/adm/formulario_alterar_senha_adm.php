<?php
include '../utils/autenticado.php';
include 'menu_inicial.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário para alteração de senha</title>
    <link rel="stylesheet" href="../../view/public/css/cliente/formulario_altera_senha.css">
</head>

<body>
    <section id="section_formulario_senha">
        <div class="espaco_forms_senha">
            <div class="title_div">
                <a href="#" onclick="window.history.back(); return false" class="setinha_forms_mudar_senha">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <h3 class="titulo_forms_senha">Alterar senha</h3>
            </div>

            <div class="area_forms">
                <div class="area-forms">
                   <form action="../cliente/Controller/utils/alterar_senha.php" method="POST">
                        <p class="p_form_senha">Digite sua senha atual:</p>
                        <input type="password" name="senha_atual" class="form_senha_atual" required>

                        <p class="p_form_senha">Digite sua nova senha:</p>
                        <input type="password" name="nova_senha" class="form_nova_senha" required>

                        <p class="p_form_senha">Confirme sua nova senha:</p>
                        <input type="password" name="confirmar_senha" class="form_confirma_senha" required>
                        <div class="div_confirmacao">
                            <a href="recuperar_senha.php" class="esqueceu_senha">Esqueceu a senha?</a>
                            <?php
                                $texto = "Salvar Senha";
                                include 'botao_verde_adm.php';
                            ?>
                        </div>
                    </form>
                </div>
           
            </div>

            
        </div>
        
    </section>
</body>

</html>
<?php include 'footer.php';?>
