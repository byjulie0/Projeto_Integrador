<?php include 'menu_inicial.php' ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto - Segunda Etapa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm/add_produtos_2etapa.css">
</head>

<body class="body_add_product_second">
    <main class="main_add_product_second">
        <div class="title_page_add_product_second">
            <a href="#" class="arrow_add_product_second"></i></a>
            <h1 class="title_add_product_second">Adicionar Produto</h1>
        </div>
        <p class="info_add_product_second">Preencha as informações necessárias e adicione produtos ao catálogo do site
        </p>
        <section class="add_product_area_second">
            <div class="add_product_image_second">
                <p class="product_title_info_second">Carregar mais imagens do produto<span>(opcional)</span></p>
                <div class="img_holder_second">
                    <label class="img_holder_button_second">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <input type="file" accept="image/*" style="display: none;">
                    </label>
                </div>
            </div>
            <div class="add_product_details_second">
                <div class="product_details_collumn_second">
                    <div class="input_product_category_second">
                        <p class="product_title_info_second">Sexo<span class="mandatory_space_second">*</span></p>
                        <select name="categories" id="categories" class="product_info_select_second" required>
                            <option value="" selected disabled>Selecione uma opção</option>
                            <option value="bovinos" class="product_categories">Masculino</option>
                            <option value="equinos" class="product_categories">Feminino</option>
                            <option value="bovinos" class="product_categories">Não se aplica (Produto)</option>
                        </select>
                        <span class="error-message">Por favor, selecione uma opção</span>
                    </div>
                </div>
            </div>
        </section>
        <div class="add_product_submit_button_second">
            <?php
            $texto = "Adicionar produto +";
            include 'botao_adm.php';
            ?>
        </div>
    </main>
</body>

</html>

<?php
include 'footer.php';
?>