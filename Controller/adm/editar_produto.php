<?php
include 'menu_inicial.php';
include '../../model/DB/conexao.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}
$id_produto = (int)$_GET['id'];

$sqlProd = "SELECT * FROM produto WHERE id_produto = $id_produto";
$resProd = mysqli_query($con, $sqlProd);
if (!$resProd || mysqli_num_rows($resProd) == 0) {
    die("Produto não encontrado.");
}
$produto = mysqli_fetch_assoc($resProd);

$imagensJson = $produto['path_img'] ?? '[]';
$imagensSalvas = json_decode($imagensJson, true);
$imagensSalvas = is_array($imagensSalvas) ? $imagensSalvas : array_fill(0, 4, null);

$sqlCat = "SELECT id_categoria, cat_nome FROM categoria";
$resCat = mysqli_query($con, $sqlCat);
$categorias = mysqli_fetch_all($resCat, MYSQLI_ASSOC);

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
    <link rel="stylesheet" href="../../view/public/css/adm/adicionar_produto.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
            <input type="hidden" name="id_produto" value="<?= $id_produto ?>">

            <section class="add_product_area">
                <article class="add_product_image">
                    <p class="product_title_info_img">Imagens do produto (máx. 4)<span class="mandatory_space">*</span></p>

                    <div class="carousel-container">
                        <button type="button" class="carousel-btn prev" onclick="changeSlide(-1)">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button type="button" class="carousel-btn next" onclick="changeSlide(1)">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                        <div class="carousel-placeholder" id="carouselPlaceholder">Clique em um quadrado para adicionar</div>
                        <img src="" alt="" class="carousel-img" id="mainPreview" style="display: none;">
                    </div>

                    <div class="mini-container">
                        <?php for ($i = 0; $i < 4; $i++): ?>
    <?php $imgPath = $imagensSalvas[$i] ?? null; ?>
    <label class="custom-file-upload" for="input<?= $i ?>">
        <div class="upload-box" id="box<?= $i ?>">
            <img src="<?= $imgPath ? '../../view/public/' . $imgPath : '' ?>" 
                 alt="" class="mini-img" id="miniImg<?= $i ?>" 
                 style="<?= $imgPath ? 'display:block;' : 'display:none;' ?>">
            <div class="upload-content" id="content<?= $i ?>" 
                 style="<?= $imgPath ? 'display:none;' : 'display:flex;' ?>">
                <i class="bi bi-camera-fill"></i>
                <span>Adicionar</span>
            </div>
            <button type="button" class="remove-mini" id="remove<?= $i ?>" 
                    style="<?= $imgPath ? 'display:flex;' : 'display:none;' ?>">X</button>
            <input type="hidden" name="manter_imagem[<?= $i ?>]" id="manter<?= $i ?>" value="<?= $imgPath ? '1' : '0' ?>">
            <input type="hidden" name="remover_imagem[<?= $i ?>]" id="del<?= $i ?>" value="0">
        </div>
        <input type="file" name="imagens[]" accept="image/*" class="file-input-hidden" id="input<?= $i ?>">
    </label>
<?php endfor; ?>
                    </div>
                </article>

                <aside class="add_product_details">
                    <div class="product_details_collumn">
                        <article class="input_product_name">
                            <p class="product_title_info">Nome do produto<span class="mandatory_space">*</span></p>
                            <input type="text" name="nome" class="input_product_info" value="<?= htmlspecialchars($produto['prod_nome']) ?>" required>
                        </article>

                        <article class="input_product_price">
                            <p class="product_title_info">Valor<span class="mandatory_space">*</span></p>
                            <input type="number" name="valor" class="input_product_info" value="<?= $produto['valor'] ?>" required min="0.01" step="0.01">
                        </article>

                        <article class="input_product_quantity">
                            <p class="product_title_info">Quantidade<span class="mandatory_space">*</span></p>
                            <input type="number" name="quantidade" class="input_product_info" value="<?= $produto['quant_estoque'] ?>" required min="0">
                        </article>

                        <article class="input_product_subcategory">
                            <p class="product_title_info">Categoria<span class="mandatory_space">*</span></p>
                            <select name="categoria" id="categoria" class="product_info_select" required>
                                <option value="">Selecione</option>
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?= $cat['id_categoria'] ?>" <?= $cat['id_categoria'] == $produto['id_categoria'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat['cat_nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </article>

                        <article class="input_product_subcategory">
                            <p class="product_title_info">Subcategoria<span class="mandatory_space">*</span></p>
                            <select name="subcategoria" id="subcategoria" class="product_info_select" required>
                                <option value="">Selecione</option>
                            </select>
                        </article>
                    </div>

                    <div class="product_details_collumn">
                        <article class="input_product_quantity">
                            <p class="product_title_info">Descrição<span class="mandatory_space">*</span></p>
                            <textarea name="descricao" class="input_product_info" required><?= htmlspecialchars($produto['descricao']) ?></textarea>
                        </article>

                        <article class="input_product_quantity">
                            <p class="product_title_info">Peso<span class="mandatory_space">*</span></p>
                            <input type="number" name="peso" class="input_product_info" value="<?= $produto['peso'] ?>" min="0" <?= $produto['id_categoria'] == 5 ? 'disabled' : '' ?>>
                        </article>

                        <article class="input_product_quantity">
                            <p class="product_title_info">Idade<span class="mandatory_space">*</span></p>
                            <input type="date" name="idade" class="input_product_info" value="<?= $produto['idade'] ?>" <?= $produto['id_categoria'] == 5 ? 'disabled' : '' ?>>
                        </article>

                        <article class="input_product_category">
                            <p class="product_title_info">Sexo<span class="mandatory_space">*</span></p>
                            <select name="sexo" class="product_info_select" <?= $produto['id_categoria'] == 5 ? 'disabled' : '' ?>>
                                <option value="M" <?= $produto['sexo'] == 'M' ? 'selected' : '' ?>>Macho</option>
                                <option value="F" <?= $produto['sexo'] == 'F' ? 'selected' : '' ?>>Fêmea</option>
                                <option value="Não se aplica" <?= $produto['sexo'] == 'Não se aplica' ? 'selected' : '' ?>>Não se aplica</option>
                            </select>
                        </article>

                        <article class="input_product_champion">
                            <p class="product_title_info">Campeão?<span class="mandatory_space">*</span></p>
                            <select name="campeao" class="product_info_select" <?= $produto['id_categoria'] == 5 ? 'disabled' : '' ?>>
                                <option value="sim" <?= $produto['campeao'] == 'sim' ? 'selected' : '' ?>>Sim</option>
                                <option value="nao" <?= $produto['campeao'] == 'nao' ? 'selected' : '' ?>>Não</option>
                            </select>
                        </article>
                    </div>
                </aside>
            </section>

            <div class="add_product_submit_button">
                <?php $texto = "Salvar Alterações"; include 'botao_verde_adm.php'; ?>
            </div>
        </form>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        window.subMapData = <?= json_encode($subMap, JSON_UNESCAPED_UNICODE); ?>;
        window.produtoCategoria = <?= (int)$produto['id_categoria']; ?>;
        window.produtoSubcategoria = <?= (int)$produto['id_subcategoria']; ?>;
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof initEditProduct === 'function') {
                initEditProduct();
            }
        });
    </script>
</body>
</html>