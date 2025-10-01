<?php
include 'menu_inicial.php';
include '../../model/DB/conexao.php';

$sqlCat = "SELECT id_categoria, cat_nome FROM categoria";
$resCat = mysqli_query($con, $sqlCat);
$categorias = [];
while ($r = mysqli_fetch_assoc($resCat)) {
    $categorias[] = $r;
}

$sqlSub = "SELECT id_subcategoria, subcat_nome, id_categoria FROM subcategoria";
$resSub = mysqli_query($con, $sqlSub);
$subMap = [];
while ($r = mysqli_fetch_assoc($resSub)) {
    $subMap[$r['id_categoria']][] = $r;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="../../view/public/css/adm/adicionar_produto.css">
    <script defer src="../../view/js/adm/adicionar_produto.js"></script>
</head>
<body class="body_add_product">

    <div class="area_add_product">
        <div class="title_page_add_product">
            <a href="#" onclick="window.history.back(); return false;" class="arrow_add_product">
                <i class="bi bi-chevron-left"></i>
            </a>
            <h1 class="tile_add_product">Adicionar Produto</h1>
        </div>

        <form action="../utils/adicionar_produto_backend.php" method="POST" enctype="multipart/form-data">
            <section class="add_product_area">
                <article class="add_product_image">
                    <div class="img_holder">
                        <label class="img_holder_button">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            <span>Selecione uma imagem</span>
                            <input type="file" class="input_product_info" accept="image/*" name="imagem" required style="display:none;">
                        </label>
                    </div>
                </article>

                <aside class="add_product_details">
                    <div class="product_details_collumn">

                        <article class="input_product_name">
                            <p class="product_title_info">Insira o nome do produto<span class="mandatory_space">*</span></p>
                            <input type="text" class="input_product_info" placeholder="Nome do produto" name="nome" required>
                        </article>

                        <article class="input_product_price">
                            <p class="product_title_info">Defina o valor do produto<span class="mandatory_space">*</span></p>
                            <input type="number" placeholder="Valor" class="input_product_info" name="valor" required min="0.01" step="0.01">
                        </article>

                        <article class="input_product_quantity">
                            <p class="product_title_info">Quantidade do produto<span class="mandatory_space">*</span></p>
                            <input type="number" placeholder="Quantidade" class="input_product_info" name="quantidade" required min="0">
                        </article>

                        <article class="input_product_subcategory">
                            <p class="product_title_info">Selecione uma categoria<span class="mandatory_space">*</span></p>
                            <select name="categoria" class="input_product_info" id="categoria" required>
                                <option value="" selected disabled>Selecione uma categoria</option>
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?= $cat['id_categoria'] ?>"><?= htmlspecialchars($cat['cat_nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </article>

                        <article class="input_product_subcategory">
                            <p class="product_title_info">Selecione a subcategoria<span class="mandatory_space">*</span></p>
                            <select name="subcategoria" class="input_product_info" id="subcategoria" required disabled>
                                <option value="" selected disabled>Selecione uma subcategoria</option>
                            </select>
                        </article>

                    </div>

                    <div class="product_details_collumn">

                        <article class="input_product_quantity">
                            <p class="product_title_info">Insira a descrição do produto<span class="mandatory_space">*</span></p>
                            <textarea id="descricao" name="descricao" wrap="soft" placeholder="Descrição..." class="input_product_info product_details" required></textarea>
                        </article>

                        <article class="input_product_quantity">
                            <p class="product_title_info">Peso do animal<span class="mandatory_space">*</span></p>
                            <input type="number" placeholder="Peso em quilos" class="input_product_info" name="peso" required min="0" disabled>
                        </article>

                        <article class="input_product_quantity">
                            <p class="product_title_info">Idade do animal<span class="mandatory_space">*</span></p>
                            <input type="date" class="input_product_info" name="idade" required disabled>
                        </article>

                        <article class="input_product_category">
                            <p class="product_title_info">Sexo do animal<span class="mandatory_space">*</span></p>
                            <select class="product_info_select" name="sexo" required disabled>
                                <option value="" selected disabled>Selecione uma opção</option>
                                <option value="M">Macho</option>
                                <option value="F">Fêmea</option>
                                <option value="Não se aplica">Não se aplica (Produto)</option>
                            </select>
                        </article>

                        <article class="input_product_champion">
                            <p class="product_title_info">Categoria é um campeão?<span class="mandatory_space">*</span></p>
                            <select id="is_champion" class="product_info_select" name="campeao" required disabled>
                                <option value="" selected disabled>Selecione uma opção</option>
                                <option value="sim">Sim</option>
                                <option value="nao">Não</option>
                            </select>
                        </article>

                    </div>
                </aside>
            </section>

            <div class="add_product_submit_button">
                <?php
                $texto = "Avançar";
                include 'botao_adm.php';
                ?>
            </div>
        </form>
    </div>

   <script>
    window.subMapData = <?= json_encode($subMap, JSON_UNESCAPED_UNICODE); ?>;
   </script>
<?php include 'footer.php'; ?>
</body>
</html>