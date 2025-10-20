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
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm/editar_produto.css">
    <script defer src="../../view/js/adm/editar_produto.js"></script>
</head>

<body class="body_edit_product">
    <div class="area_edit_product">

        <div class="title_page_edit_product">
            <a href="#" onclick="window.history.back(); return false;" class="arrow_edit_product">
                <i class="bi bi-chevron-left"></i>
            </a>
            <h1 class="tile_edit_product">Editar Produto</h1>
        </div>
        <section class="edit_product_area">
            <article class="edit_product_image">
                <div class="img_holder">
                    <label class="img_holder_button">
                        <i class="fa-solid fa-arrow-up-from-bracket"> <span>Selecione uma imagem</span> </i>
                        <input type="file" accept="image/*" style="display: none;">
                    </label>
                </div>
            </article>
            <aside class="edit_product_details">
                <div class="product_details_collumn">

                    <article class="input_product_name">
                        <p class="product_title_info">Nome do produto</p>
                        <input type="text" class="input_product_info" placeholder="Nome do produto" required>
                        

                    <article class="input_product_champion">
                            <p class="product_title_info">Categoria é um campeão?</p>
                            <select name="is_champion" id="is_champion" class="product_info_select" required>
                            <option value="" selected disabled>Selecione uma opção</option>
                            <option value="sim">Sim</option>
                             <option value="nao">Não</option>
                        </select>
                    </article>

                    <article class="input_product_quantity">
                        <p class="product_title_info">Quantidade do produto</p>
                        <input type="number" placeholder="Quantidade do produto" class="input_product_info" required min="0">
                    </article>

                    <article class="input_product_category">
                        <p class="product_title_info">Edite a categoria</p>

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
                        <p class="product_title_info">Edite a subcategoria</p>
                        <select name="subcategories" id="bovinos_breed" class="product_info_select subcategory-select"
                            required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="angus" class="product_bull">Angus</option>
                            <option value="brahman" class="product_bull">Brahman</option>
                            <option value="brangus" class="product_bull">Brangus</option>
                            <option value="hereford" class="product_bull">Hereford</option>
                            <option value="nelore" class="product_bull">Nelore</option>
                            <option value="senepol" class="product_bull">Senepol</option>
                        </select>

                        <select name="subcategories" id="equinos_breed" class="product_info_select subcategory-select"
                            required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="arabe" class="product_horse">Árabe</option>
                            <option value="draftbelga" class="product_horse">Draft Belga</option>
                            <option value="Mustang" class="product_horse">Mustang</option>
                            <option value="painthorse" class="product_horse">Paint Horse</option>
                            <option value="percheron" class="product_horse">Percheron</option>
                            <option value="puro_sangue" class="product_horse">Puro Sangue Inglês</option>
                        </select>

                        <select name="subcategories" id="galinaceos_breed"
                            class="product_info_select subcategory-select" required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="legornne" class="product_rooster">Legorne</option>
                            <option value="leon" class="product_rooster">Léon</option>
                            <option value="orpington" class="product_rooster">Orpington</option>
                            <option value="playmouth_rock" class="product_rooster">Playmouth Rock</option>
                            <option value="rhode_island" class="product_rooster">Rhode Island Redd</option>
                        </select>

                        <select name="subcategories" id="product_types" class="product_info_select subcategory-select"
                            required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="racao" class="general_product">Rações e suplementos alimentares</option>
                            <option value="medicamento" class="general_product">Medicamentos veterinários</option>
                            <option value="higiene" class="general_product">Produtos de higiene e cuidados</option>
                            <option value="equipamento" class="general_product">Equipamentos e utensílios</option>
                            <option value="suplemento" class="general_product">Suplementos nutricionais e aditivos</option>
                        </select>

                        <select name="subcategories" id="winner_breed" class="product_info_select subcategory-select"
                            required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="melhor_exemplar" class="champion_product">Melhor exemplar</option>
                            <option value="grande_campeao" class="champion_product">Grande Campeão</option>
                            <option value="campeao_junior" class="champion_product">Campeão júnior</option>
                            <option value="melhor_desempenho" class="champion_product">Melhor desempenho Funcional</option>
                            <option value="melhor_apresentacao" class="champion_product">Melhor apresentação</option>
                        </select>

                    </article>
                </div>
                <div class="product_details_collumn">

                    <article class="input_product_price">
                        <p class="product_title_info">Valor do produto</p>
                        <input type="number" placeholder=" Valor do produto" class="input_product_info" required min="0.01"
                            step="0.01">
                    </article>

                    <article class="input_product_quantity">
                        <p class="product_title_info">Peso do animal em kg</p>
                        <input type="number" placeholder="Peso do animal" class="input_product_info" required min="0">
                    </article>
                    
                    <article class="input_product_category">
                        <p class="product_title_info">Sexo do animal</p>
                        
                        <select name="categories" id="categories" class="product_info_select" required>
                            <option value="" selected disabled>Selecione uma opção</option>
                            <option value="" class="product_categories">Macho</option>
                            <option value="" class="product_categories">Fêmea</option>
                            <option value="" class="product_categories">Não se aplica (Produto)</option>
                        </select>
                    </article>
                    
                    

                    <article class="input_product_quantity">
                        <p class="product_title_info">Descrição do produto</p>
                        <textarea id="descricao" name="descricao" wrap="soft" placeholder="Descrição..." class="input_product_info product_details" required></textarea>
                    </article>
                    
                </div>
            </aside>
        </section>
        <div class="edit_product_submit_button">
            <?php
            $texto = "Avançar";
            include 'botao_verde_adm.php';
            ?>
        </div>
    </div>
</body>
<?php if ($mostrar_popup_sucesso):
        $texto = "Informações atualizadas com sucesso!";
        include 'pop_up_sucesso.php';
    endif;
?>
</html>
<?php
include 'footer.php';
?>
