<?php include 'menu_inicial.php';?>
<?php
$mostrar_popup_sucesso = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_avançar'])) {
    $mostrar_popup_sucesso = true;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm/editar_produto.css">
    <script defer src="../../view/js/adm/aditar_produto.js"></script>
</head>
<body class="body_edit_product">
    <div class="edit_produt_area">

        <div class="title_page_edit_product">
            <a href="atualizar_produtos_adm.php" class="arrow_edit_product">
                <i class="fa-solid fa-chevron-left">
                </i>
            </a>
            <h1 class="tile_edit_product">Editar Produto</h1>
        </div>
        <p class="info_edit_product">Edite as informações cadastrais do produto:</p>
        <section class="edit_product_area">
            <article class="edit_product_image">
                <p class="product_edit_title_info">Carregar imagem de capa<span class="mandatory_space">*</span></p>
                <div class="img_holder_edit">
                    <label class="img_holder_button_edit">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <span>Selecione uma imagem</span>
                        <input type="file" accept="image/*" style="display: none;">
                    </label>
                </div>
            </article>
            <aside class="edit_product_details">
                <div class="product_details_collumn">
                    <article class="input_product_name">
                        <p class="product_title_info">Edite o nome do produto<span class="mandatory_space">*</span></p>
                        <input type="text" class="input_product_info" placeholder="Titulo" required>
                        <span class="error-message">Por favor, preencha este campo</span>
                    </article>
                    <article class="input_product_category">
                        <p class="product_edit_title_info">Edite a categoria a qual o produto pertence<span
                                class="mandatory_space">*</span></p>
                        <select name="categories" id="categories" class="product_info_select" required>
                            <option value="" selected disabled>Selecione uma categoria</option>
                            <option value="bovinos" class="product_categories">Bovinos</option>
                            <option value="equinos" class="product_categories">Equinos</option>
                            <option value="galinaceos" class="product_categories">Galináceos</option>
                            <option value="premiados" class="product_categories">Premiados</option>
                            <option value="produtos_gerais" class="product_categories">Produtos Gerais</option>
                        </select>
                        <span class="error-message">Por favor, selecione uma categoria</span>
                    </article>
                    <article class="input_product_subcategory">
                        <p class="product_title_info">Edite a subcategoria a qual o produto pertence<span class="mandatory_space">*</span></p>
                        <select name="subcategories" id="bovinos_breed" class="product_info_select subcategory-select"
                            required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="angus" class="product_bull">Angus</option>
                            <option value="hereford" class="product_bull">Hereford</option>
                            <option value="nelore" class="product_bull">Nelore</option>
                            <option value="girolando" class="product_bull">Girolando</option>
                            <option value="brahman" class="product_bull">Brahman</option>
                        </select>
                        <select name="subcategories" id="equinos_breed" class="product_info_select subcategory-select"
                            required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="puro_sangue" class="product_horse">Puro Sangue Inglês</option>
                            <option value="andaluz" class="product_horse">Andaluz</option>
                            <option value="arabe" class="product_horse">Árabe</option>
                            <option value="lusitano" class="product_horse">Lusitano</option>
                            <option value="marchador" class="product_horse">Manfalarga Marchador</option>
                        </select>
                        <select name="subcategories" id="galinaceos_breed"
                            class="product_info_select subcategory-select" required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="brahma" class="product_rooster">Brahma</option>
                            <option value="orpington" class="product_rooster">Orpington</option>
                            <option value="sussex" class="product_rooster">Sussex</option>
                            <option value="playmouth" class="product_rooster">Playmouth Rock</option>
                            <option value="rhode_island" class="product_rooster">Rhode Island Redd</option>
                        </select>
                        <select name="subcategories" id="product_types" class="product_info_select subcategory-select"
                            required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="racao" class="general_product">Rações e suplementos alimentares</option>
                            <option value="hereford" class="general_product">Medicamentos veterinários</option>
                            <option value="nelore" class="general_product">Produtos de higiene e cuidados</option>
                            <option value="girolando" class="general_product">Equipamentos e utensílios</option>
                            <option value="brahman" class="general_product">Suplementos nutricionais e aditivos</option>
                        </select>
                        <select name="subcategories" id="winner_breed" class="product_info_select subcategory-select"
                            required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="melhor_exemplar" class="champion_product">Melhor exemplar</option>
                            <option value="grande_campeao" class="champion_product">Grande Campeão</option>
                            <option value="campeao_junior" class="champion_product">Campeão júnior</option>
                            <option value="melhor_desempenho" class="champion_product">Melhor desempenho Funcional
                            </option>
                            <option value="melhor_apresentacao" class="champion_product">Melhor apresentação</option>
                        </select>
                    </article>
                </div>
                <div class="product_details_collumn">
                    <article class="input_product_price">
                        <p class="product_title_info">Altere o valor do produto<span class="mandatory_space">*</span>
                        </p>
                        <input type="number" placeholder="Valor" class="input_product_info" required min="0.01"
                            step="0.01">
                        <span class="error-message">Informe um valor válido (maior que zero)</span>
                    </article>
                    <article class="input_product_quantity">
                        <p class="product_title_info">Quantidade em estoque<span class="mandatory_space">*</span></p>
                        <input type="number" placeholder="Valor" class="input_product_info" required min="1">
                    </article>
                    <article class="input_product_quantity">
                        <p class="product_title_info">Descreva o produto<span class="mandatory_space">*</span></p>
                        <input type="text" placeholder="Digite aqui" class="input_product_info product_details"
                            required>
                    </article>
                </div>
            </aside>
        </section>
        <form method="POST" action="">
            <div class="edit_product_submit_button">
                <?php
                $texto = "Avançar";
                include 'botao_adm.php';
                ?>
            </div>
        </form>
    </div>
    <?php if ($mostrar_popup_sucesso):
        $texto = "Informações atualizadas com sucesso!";
        include 'pop_up_sucesso.php';
    endif; ?>
</body>
</html>
<?php include 'footer.php';?>