<?php
include 'menu_inicial.php';
include '../../model/DB/conexao.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de produto inválido.");
}
$id_produto = (int)$_GET['id'];

$sqlProd = "SELECT * FROM produto WHERE id_produto = $id_produto";
$resProd = mysqli_query($con, $sqlProd);
if (!$resProd || mysqli_num_rows($resProd) == 0) {
    die("Produto não encontrado.");
}
$produto = mysqli_fetch_assoc($resProd);

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
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../../view/public/css/adm/editar_produto.css">
    <script defer src="../../view/js/adm/editar_produto.js"></script>
</head>
<body class="body_add_product">

    <div class="area_add_product">
        <div class="title_page_add_product">
            <a href="#" onclick="window.history.back(); return false;" class="arrow_add_product">
                <i class="bi bi-chevron-left"></i>
            </a>
            <h1 class="tile_add_product">Editar Produto</h1>
        </div>
        
        <form action="../utils/editar_produto_backend.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">

            <section class="add_product_area">
                <article class="add_product_image">
  <div class="img_holder">
    <?php
      $imagemProduto = !empty($produto['path_img'])
        ? '../../view/public/' . htmlspecialchars($produto['path_img'])
        : '';
    ?>
    
    <img 
      id="previewImagem" 
      src="<?php echo $imagemProduto; ?>" 
      alt="Imagem do produto"
      style="<?php echo !empty($imagemProduto) ? '' : 'display:none;'; ?>"
    >

    <label class="img_holder_button">
      <i class="fa-solid fa-arrow-up-from-bracket"></i>
      <span>Trocar imagem</span>
      <input type="file" id="inputImagem" class="input_product_info" accept="image/*" name="imagem">
    </label>
  </div>
  <p style="font-size:0.8rem; color:#666; text-align:center;">
    (Deixe em branco para manter a imagem atual)
  </p>
</article>


                <aside class="add_product_details">
                    <div class="product_details_collumn">

                        <article class="input_product_name">
                            <p class="product_title_info">Nome do produto<span class="mandatory_space">*</span></p>
                            <input type="text" class="input_product_info" placeholder="Nome do produto" name="nome" value="<?= htmlspecialchars($produto['prod_nome']) ?>" required>
                        </article>

                        <article class="input_product_price">
                            <p class="product_title_info">Valor do produto<span class="mandatory_space">*</span></p>
                            <input type="number" placeholder="Valor" class="input_product_info" name="valor" value="<?= htmlspecialchars($produto['valor']) ?>" required min="0.01" step="0.01">
                        </article>

                        <article class="input_product_quantity">
                            <p class="product_title_info">Quantidade<span class="mandatory_space">*</span></p>
                            <input type="number" placeholder="Quantidade" class="input_product_info" name="quantidade" value="<?= htmlspecialchars($produto['quant_estoque']) ?>" required min="0">
                        </article>

                        <article class="input_product_subcategory">
                            <p class="product_title_info">Categoria<span class="mandatory_space">*</span></p>
                            <select name="categoria" class="input_product_info" id="categoria" required>
                                <option value="" disabled>Selecione uma categoria</option>
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?= $cat['id_categoria'] ?>" <?= $cat['id_categoria'] == $produto['id_categoria'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat['cat_nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </article>

                        <article class="input_product_subcategory">
                            <p class="product_title_info">Subcategoria<span class="mandatory_space">*</span></p>
                            <select name="subcategoria" class="input_product_info" id="subcategoria" required>
                                <option value="" selected disabled>Selecione uma subcategoria</option>
                                <?php
                                if (!empty($subMap[$produto['id_categoria']])) {
                                    foreach ($subMap[$produto['id_categoria']] as $sub) {
                                        $selected = ($sub['id_subcategoria'] == $produto['id_subcategoria']) ? 'selected' : '';
                                        echo "<option value='{$sub['id_subcategoria']}' $selected>{$sub['subcat_nome']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </article>

                    </div>

                    <div class="product_details_collumn">

                        <article class="input_product_quantity">
                            <p class="product_title_info">Descrição<span class="mandatory_space">*</span></p>
                            <textarea id="descricao" name="descricao" wrap="soft" placeholder="Descrição..." class="input_product_info product_details" required><?= htmlspecialchars($produto['descricao']) ?></textarea>
                        </article>

                        <article class="input_product_quantity">
                            <p class="product_title_info">Peso do animal<span class="mandatory_space">*</span></p>
                            <input type="number" placeholder="Peso em quilos" class="input_product_info" name="peso" value="<?= htmlspecialchars($produto['peso']) ?>" min="0" <?= $produto['id_categoria'] == 5 ? 'disabled' : '' ?>>
                        </article>

                        <article class="input_product_quantity">
                            <p class="product_title_info">Idade do animal<span class="mandatory_space">*</span></p>
                            <input type="date" class="input_product_info" name="idade" value="<?= htmlspecialchars($produto['idade']) ?>" <?= $produto['id_categoria'] == 5 ? 'disabled' : '' ?>>
                        </article>

                        <article class="input_product_category">
                            <p class="product_title_info">Sexo do animal<span class="mandatory_space">*</span></p>
                            <select class="product_info_select" name="sexo" <?= $produto['id_categoria'] == 5 ? 'disabled' : '' ?>>
                                <option value="" disabled>Selecione</option>
                                <option value="M" <?= $produto['sexo'] == 'M' ? 'selected' : '' ?>>Macho</option>
                                <option value="F" <?= $produto['sexo'] == 'F' ? 'selected' : '' ?>>Fêmea</option>
                                <option value="Não se aplica" <?= $produto['sexo'] == 'Não se aplica' ? 'selected' : '' ?>>Não se aplica (Produto)</option>
                            </select>
                        </article>

                        <article class="input_product_champion">
                            <p class="product_title_info">É campeão?<span class="mandatory_space">*</span></p>
                            <select id="is_champion" class="product_info_select" name="campeao" <?= $produto['id_categoria'] == 5 ? 'disabled' : '' ?>>
                                <option value="" disabled>Selecione</option>
                                <option value="sim" <?= $produto['campeao'] == 'sim' ? 'selected' : '' ?>>Sim</option>
                                <option value="nao" <?= $produto['campeao'] == 'nao' ? 'selected' : '' ?>>Não</option>
                            </select>
                        </article>

                    </div>
                </aside>
            </section>

            <div class="add_product_submit_button">
                <?php
                $texto = "Salvar Alterações";
                include 'botao_adm.php';
                ?>
            </div>
        </form>
    </div>

    <script>
    window.subMapData = <?= json_encode($subMap, JSON_UNESCAPED_UNICODE); ?>;
    window.produtoCategoria = <?= (int)$produto['id_categoria']; ?>;
    window.produtoSubcategoria = <?= (int)$produto['id_subcategoria']; ?>;
    </script>
<?php include 'footer.php'; ?>
</body>
</html>