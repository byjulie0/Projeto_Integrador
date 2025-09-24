<?php 
include 'menu_inicial.php';
require_once __DIR__ .'/../../model/DB/conexao.php';
?>

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
                <i class="bi bi-chevron-left"></i>
            </a>
            <h1 class="tile_add_product">Adicionar Produto</h1>
        </div>

        <section class="add_product_area">

            <!-- Campo de Imagem -->
            <article class="add_product_image">
                <div class="img_holder">
                    <label class="img_holder_button">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <span>Selecione uma imagem</span>
                        <input type="file" accept="image/*" name="imagem" required style="display:none;">
                    </label>
                </div>
            </article>

            <aside class="add_product_details">
                <div class="product_details_collumn">

                    <!-- Nome -->
                    <article class="input_product_name">
                        <p class="product_title_info">Insira o nome do produto<span class="mandatory_space">*</span></p>
                        <input type="text" class="input_product_info" placeholder="Nome do produto" name="nome" required>
                        <span class="error-message">Por favor, preencha este campo</span>
                    </article>

                    <!-- Campeão -->
                    <article class="input_product_champion">
                        <p class="product_title_info">Categoria é um campeão?<span class="mandatory_space">*</span></p>
                        <select id="is_champion" class="product_info_select" name="campeao" required>
                            <option value="" selected disabled>Selecione uma opção</option>
                            <option value="sim">Sim</option>
                            <option value="nao">Não</option>
                        </select>
                        <span class="error-message">Por favor, selecione uma opção</span>
                    </article>

                    <!-- Quantidade -->
                    <article class="input_product_quantity">
                        <p class="product_title_info">Quantidade do produto<span class="mandatory_space">*</span></p>
                        <input type="number" placeholder="Quantidade do produto" class="input_product_info" name="quantidade" required min="0">
                        <span class="error-message">Por favor, preencha este campo</span>
                    </article>

                    <!-- Categoria/Subcategoria -->
                    <?php
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
 
                    <article class="input_product_subcategory"> 
                        <p class="product_title_info">Selecione uma categoria<span class="mandatory_space">*</span></p>
                        <select name="categoria" class="input_product_info" id="categoria" required>
                            <option value="" selected disabled>Selecione uma categoria</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?= $cat['id_categoria'] ?>">
                                    <?= htmlspecialchars($cat['cat_nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <span class="error-message">Por favor, selecione uma opção</span>
                    </article>

                    <article class="input_product_subcategory"> 
                        <p class="product_title_info">Selecione a subcategoria a qual o <br> produto pertence<span class="mandatory_space">*</span></p>
                        <select name="subcategoria" class="input_product_info" id="subcategoria" required disabled>
                            <option value="" selected disabled>Selecione uma subcategoria</option>
                        </select>
                        <span class="error-message">Por favor, selecione uma opção</span>
                    </article>

                    <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const subMap = <?= json_encode($subMap, JSON_UNESCAPED_UNICODE); ?>;
                        const catSel = document.getElementById('categoria');
                        const subSel = document.getElementById('subcategoria');

                        catSel.addEventListener('change', () => {
                            const catId = catSel.value;
                            subSel.innerHTML = '<option value="" selected disabled>Selecione uma subcategoria</option>';

                            if (subMap[catId]) {
                                subMap[catId].forEach(sub => {
                                    const opt = document.createElement('option');
                                    opt.value = sub.id_subcategoria;
                                    opt.textContent = sub.subcat_nome;
                                    subSel.appendChild(opt);
                                });
                                subSel.disabled = false;
                            } else {
                                subSel.disabled = true;
                            }
                        });
                    });
                    </script>

                </div>

                <div class="product_details_collumn">

                    <!-- Valor -->
                    <article class="input_product_price">
                        <p class="product_title_info">Defina o valor do produto<span class="mandatory_space">*</span></p>
                        <input type="number" placeholder="Valor do produto" class="input_product_info" name="valor" required min="0.01" step="0.01">
                        <span class="error-message">Informe um valor válido (maior que zero)</span>
                    </article>

                    <!-- Peso -->
                    <article class="input_product_quantity">
                        <p class="product_title_info">Peso do animal em kg<span class="mandatory_space">*</span></p>
                        <input type="number" placeholder="Se for produto digite 0" class="input_product_info" name="peso" required min="0">
                        <span class="error-message">Por favor, preencha este campo</span>
                    </article>

                    <!-- Sexo -->
                    <article class="input_product_category">
                        <p class="product_title_info">Sexo do animal<span class="mandatory_space">*</span></p>
                        <select id="categories" class="product_info_select" name="sexo" required>
                            <option value="" selected disabled>Selecione uma opção</option>
                            <option value="M" class="product_categories">Macho</option>
                            <option value="F" class="product_categories">Fêmea</option>
                            <option value="Não se aplica" class="product_categories">Não se aplica (Produto)</option>
                        </select>
                        <span class="error-message">Por favor, selecione uma opção</span>
                    </article>

                    <!-- Descrição -->
                    <article class="input_product_quantity">
                        <p class="product_title_info">Insira a descrição do produto<span class="mandatory_space">*</span></p>
                        <textarea id="descricao" name="descricao" wrap="soft" placeholder="Descrição..." class="input_product_info product_details" required></textarea>
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
</body>

</html>

<?php include 'footer.php'; ?>