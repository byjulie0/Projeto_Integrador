<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto - Segunda Etapa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm.css">
</head>

<body class="body_add_product_second">
    <div class="title_page_add_product_second">
        <a href="#" class="arrow_add_product_second">
            <i class="fa-solid fa-chevron-left">
            </i>
        </a>
        <h1 class="tile_add_product_second">Adicionar Produto</h1>
    </div>
    <p class="info_add_product_second">Preencha as informações necessárias e adicione produtos ao catálogo do site</p>
    <section class="add_product_area_second">
        <article class="add_product_image_second">
            <p class="product_title_info_second">Carregar imagem de capa<span class="mandatory_space_second">*</span></p>
            <div class="img_holder_second">
                <label class="img_holder_button_second">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                    <span>Selecione uma imagem</span>
                    <input type="file" accept="image/*" style="display: none;">
                </label>
            </div>
        </article>
        <aside class="add_product_details_second">
            <div class="product_details_collumn_second">
                <article class="input_product_price_second">
                    <p class="product_title_info_second">Defina o valor do produto<span class="mandatory_space_second">*</span></p>
                    <input type="number" placeholder="Valor" class="input_product_info_second" required min="0.01" step="0.01">
                    <span class="error-message_second">Informe um valor válido (maior que zero)</span>
                </article>
                <article class="input_product_category_second">
                    <p class="product_title_info_second">Selecione a categoria a qual o produto pertence<span
                            class="mandatory_space_second">*</span></p>
                    <select name="categories" id="categories" class="product_info_select_second" required>
                        <option value="" selected disabled>Selecione uma categoria</option>
                        <option value="bovinos" class="product_categories">Bovinos</option>
                        <option value="equinos" class="product_categories">Equinos</option>
                        <option value="galinaceos" class="product_categories">Galináceos</option>
                        <option value="premiados" class="product_categories">Premiados</option>
                        <option value="produtos_gerais" class="product_categories">Produtos Gerais</option>
                    </select>
                    <span class="error-message">Por favor, selecione uma categoria</span>
                </article>
            </div>
        </aside>
    </section>
    <div class="add_product_submit_button_second">
        <button type="submit" class="add_product_button_second">
            Avançar
            <i class="fa-solid fa-arrow-right"></i>
        </button>
    </div>
</body>

</html>

<?php
include 'footer_adm.php';
?>