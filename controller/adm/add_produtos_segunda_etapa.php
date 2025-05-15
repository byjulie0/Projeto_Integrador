<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm.css">
</head>
<body class="body-add-produtos-2-etapa">
    <div class="area-titulo-add-produtos-2-etapa">
        <a href="adicionar_produto.php" class="icon-voltar-add-produtos-2-etapa">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <h1 class="titulo-add-produtos-2-etapa">Adicionar Produto</h1>
    </div>
    <p class="info-add-produtos-2-etapa">Preencha as informações necessárias e adicione produtos ao catálogo do site</p>
    <section class="area-add-produto-2-etapa">
        <div class="area-add-imagem-add-produtos-2-etapa">
            <label class="title-add-foto-add-produtos-2-etapa">Carregar mais imagens do produtos<span>(opcional)</span></label>
            <input type="file" accept="image/*">
        </div>
        <div class="area-detalhes-add-produtos-2-etapa">
            <h3 class="titulo-detalhe-produto-add-produtos-2-etapa">Especifique o produto<span>*</span></h3>
            <div class="coluna-detalhes-add-produtos-2-etapa">
                <div class="input-add-produtos-2-etapa">
                    <label class="label-input-add-produtos-2-etapa">Raça<span>*</span></label>
                    <select name="racas" id="racas" class="selecao-input-add-produtos-2-etapa" required>
                        <option value="" selected disabled>Selecione uma raça</option>
                        <option value="bovinos" class="product_categories">Bovinos</option>
                        <option value="equinos" class="product_categories">Equinos</option>
                        <option value="galinaceos" class="product_categories">Galináceos</option>
                        <option value="premiados" class="product_categories">Premiados</option>
                        <option value="produtos_gerais" class="product_categories">Produtos Gerais</option>
                    </select>
                    <span class="error-message">Por favor, selecione uma raça</span>
                </div>
                <article class="input_product_subcategory">
                    <p class="product_title_info">Selecione a subcategoria a qual o produto pertence<span
                            class="mandatory_space">*</span></p>
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
                    <select name="subcategories" id="galinaceos_breed" class="product_info_select subcategory-select"
                        required>
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
                        <option value="melhor_desempenho" class="champion_product">Melhor desempenho Funcional</option>
                        <option value="melhor_apresentacao" class="champion_product">Melhor apresentação</option>
                    </select>
                </article>
            </div>
            <div class="product_details_collumn">
                <article class="input_product_price">
                    <p class="product_title_info">Defina o valor do produto<span class="mandatory_space">*</span></p>
                    <input type="number" placeholder="Valor" class="input_product_info" required min="0.01" step="0.01">
                    <span class="error-message">Informe um valor válido (maior que zero)</span>
                </article>
                <article class="input_product_quantity">
                    <p class="product_title_info">Quantidade em estoque<span class="mandatory_space">*</span></p>
                    <input type="number" placeholder="Valor" class="input_product_info" required min="1">
                </article>
                <article class="input_product_quantity">
                    <p class="product_title_info">Descreva o produto<span class="mandatory_space">*</span></p>
                    <input type="text" placeholder="Digite aqui" class="input_product_info product_details" required>
                </article>
            </div>
        </div>
    </section>
</body>
</html>
