<?php include 'menu_inicial.php';?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm/adicionar_produto.css">
    <script defer src="../../view/js/adm/adicionar_produto.js"></script>
</head>

<body class="body_add_product">
    <div class="area_add_product">

        <div class="title_page_add_product">
            <a href="#" onclick="window.history.back(); return false;" class="arrow_add_product">
                <i class="fa-solid fa-chevron-left">
                </i>
            </a>
            <h1 class="tile_add_product">Adicionar Produto</h1>
        </div>
        <p class="info_add_product">Preencha as informações necessárias e adicione produtos ao catálogo do site</p>
        <section class="add_product_area">
            <article class="add_product_image">
                <p class="product_title_info_img">Carregar imagem de capa<span class="mandatory_space">*</span></p>
                <div class="img_holder">
                    <label class="img_holder_button">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <span>Selecione uma imagem</span>
                        <input type="file" accept="image/*" style="display: none;">
                    </label>
                </div>
            </article>
            <aside class="add_product_details">
                <div class="product_details_collumn">

                    <form action="adicionar_produto_backend.php" method="POST">
                    <article class="input_product_name">
                        <p class="product_title_info">Insira o nome do produto<span class="mandatory_space">*</span></p>
                        <input type="text" class="input_product_info" placeholder="Titulo" name="nome" required>
                        <span class="error-message">Por favor, preencha este campo</span>
                    </article>


                    <article class="input_product_champion">
                            <p class="product_title_info">Categoria é um campeão?</p>
                            <select name="campeao" id="is_champion" class="product_info_select" name="campeao" required>
                            <option value="" selected disabled>Selecione uma opção</option>
                            <option value="sim">Sim</option>
                             <option value="nao">Não</option>
                        </select>
                        <span class="error-message">Por favor, selecione uma opção</span>
                    </article>

                    <article class="input_product_quantity">
                        <p class="product_title_info">Quantidade do produto</p>
                        <input type="number" placeholder="Quantidade_que_esta_no_DB" class="input_product_info" name="quantidade" required min="0">
                    </article>


                    <article class="input_product_category">
                        <p class="product_title_info">Selecione a categoria a qual o produto pertence<span class="mandatory_space">*</span></p>

                        <select name="categoria" id="categories" class="product_info_select" name="categoria" required>
                            <option value="" selected disabled>Selecione uma categoria</option>
                            <option value="bovinos" class="product_categories">Bovinos</option>
                            <option value="equinos" class="product_categories">Equinos</option>
                            <option value="galinaceos" class="product_categories">Galináceos</option>
                            <option value="premiados" class="product_categories">Premiados</option>
                            <option value="produtos_gerais" class="product_categories">Produtos Gerais</option>
                            <option value="equinos2" class="product_categories">Equinos</option>
                            <option value="galinaceos3" class="product_categories">Galináceos</option>
                            <option value="premiados4" class="product_categories">Premiados</option>
                            <option value="produtos_gerais5" class="product_categories">Produtos Gerais</option>
                        </select>

                        <span class="error-message">Por favor, selecione uma categoria</span>
                    </article>

                    <article class="input_product_subcategory">
                        <p class="product_title_info">Selecione a subcategoria a qual o produto pertence</p>
                        <select name="subcategoria" id="bovinos_breed" class="product_info_select subcategory-select" name="subcategoria"required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="angus" class="product_bull">Angus</option>
                            <option value="brahman" class="product_bull">Brahman</option>
                            <option value="brangus" class="product_bull">Brangus</option>
                            <option value="hereford" class="product_bull">Hereford</option>
                            <option value="nelore" class="product_bull">Nelore</option>
                            <option value="senepol" class="product_bull">Senepol</option>
                        </select>

                        <select name="subcategoria" id="equinos_breed" class="product_info_select subcategory-select" required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="arabe" class="product_horse">Árabe</option>
                            <option value="draftbelga" class="product_horse">Draft Belga</option>
                            <option value="Mustang" class="product_horse">Mustang</option>
                            <option value="painthorse" class="product_horse">Paint Horse</option>
                            <option value="percheron" class="product_horse">Percheron</option>
                            <option value="puro_sangue" class="product_horse">Puro Sangue Inglês</option>
                        </select>

                        <select name="subcategoria" id="galinaceos_breed"
                            class="product_info_select subcategory-select"  required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="legornne" class="product_rooster">Legorne</option>
                            <option value="leon" class="product_rooster">Léon</option>
                            <option value="orpington" class="product_rooster">Orpington</option>
                            <option value="playmouth_rock" class="product_rooster">Playmouth Rock</option>
                            <option value="rhode_island" class="product_rooster">Rhode Island Redd</option>
                        </select>

                        <select name="subcategoria" id="product_types" class="product_info_select subcategory-select" required>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                            <option value="racao" class="general_product">Rações e suplementos alimentares</option>
                            <option value="medicamento" class="general_product">Medicamentos veterinários</option>
                            <option value="higiene" class="general_product">Produtos de higiene e cuidados</option>
                            <option value="equipamento" class="general_product">Equipamentos e utensílios</option>
                            <option value="suplemento" class="general_product">Suplementos nutricionais e aditivos</option>
                        </select>

                        <select name="subcategoria" id="winner_breed" class="product_info_select subcategory-select" required>
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
                        <p class="product_title_info">Defina o valor do produto<span class="mandatory_space">*</span></p>
                        <input type="number" placeholder="Valor" class="input_product_info"  name="valor" required min="0.01"
                            step="0.01">
                        <span class="error-message">Informe um valor válido (maior que zero)</span>
                    </article>

                    <article class="input_product_quantity">
                        <p class="product_title_info">Peso do animal em kg<span class="mandatory_space">*</span></p>
                        <input type="number" placeholder="Se for produto digite 0" class="input_product_info" name="peso" required min="0">
                    </article>
                    
                    <article class="input_product_category">
                        <p class="product_title_info">Sexo do animal<span class="mandatory_space">*</span></p>
                        <select name="sexo" id="categories" class="product_info_select" name="sexo" required>
                            <option value="" selected disabled>Selecione uma opção</option>
                            <option value="M" class="product_categories">Macho</option>
                            <option value="F" class="product_categories">Fêmea</option>
                            <option value="Não se aplica" class="product_categories">Não se aplica (Produto)</option>
                        </select>
                        
                        <span class="error-message">Por favor, selecione uma opção</span>
                    </article>
                    
                    <article class="input_product_quantity">
                        <p class="product_title_info">Insira a descrição do produto</p>
                        <textarea id="descricao" name="descricao" wrap="soft" placeholder="Descrição_que_esta_no_DB" class="input_product_info product_details" name="descricao" required></textarea>
                    </article>
                    
                </div>
            </aside>
        </section>
        <div class="add_product_submit_button">
            <?php
            $texto = "Avançar";
            include 'botao_adm.php';
            ?>
            </form>
        </div>
    </div>
</body>

</html>
<?php
include 'footer.php';
?>