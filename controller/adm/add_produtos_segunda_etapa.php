<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto - Detalhes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm.css">
    <script defer src="../../view/JS/adicionar_produto_segunda_etapa_adm.js"></script>
</head>

<body class="body_add_product">
    <div class="title_page_add_product">
        <a href="#" class="arrow_add_product" onclick="history.back()">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <h1 class="tile_add_product">Adicionar produto</h1>
    </div>
    <p class="info_add_product">Preencha as informações necessárias e adicione produtos ao catálogo do site</p>
    
    <section class="add_product_area">
        <article class="additional_images_section">
            <p class="product_title_info">Carregar mais imagens do produto <span class="optional_text">(opcional)</span></p>
            <div class="additional_images_container">
                <div class="additional_image_upload">
                    <label class="img_holder_button">
                        <i class="fa-solid fa-plus"></i>
                        <span>Selecionar e upar</span>
                        <input type="file" accept="image/*" style="display: none;" multiple>
                    </label>
                </div>
                <!-- Placeholder for additional uploaded images -->
                <div class="uploaded_images_preview"></div>
            </div>
        </article>
        
        <aside class="product_specifications">
            <article class="specification_group">
                <p class="product_title_info">Especifique seu produto<span class="mandatory_space">*</span></p>
                <div class="specification_input">
                    <label class="specification_label">Raça<span class="mandatory_space">*</span></label>
                    <select class="product_info_select" required>
                        <option value="" selected disabled>Raça</option>
                        <option value="angus">Angus</option>
                        <option value="hereford">Hereford</option>
                        <option value="nelore">Nelore</option>
                    </select>
                </div>
            </article>
            
            <article class="specification_group">
                <p class="product_title_info">Peso<span class="mandatory_space">*</span></p>
                <div class="specification_input">
                    <label class="specification_label">Peso (kg)</label>
                    <input type="number" class="input_product_info" placeholder="Peso" min="0.1" step="0.1" required>
                </div>
            </article>
            
            <article class="specification_group">
                <p class="product_title_info">Sexo<span class="mandatory_space">*</span></p>
                <div class="specification_input">
                    <label class="specification_label">Sexo</label>
                    <select class="product_info_select" required>
                        <option value="" selected disabled>Sexo</option>
                        <option value="macho">Macho</option>
                        <option value="femea">Fêmea</option>
                    </select>
                </div>
            </article>
        </aside>
    </section>
    
    <div class="add_product_submit_button">
        <button type="submit" class="add_product_button">
            Adicionar produto
            <i class="fa-solid fa-check"></i>
        </button>
    </div>
</body>

</html>