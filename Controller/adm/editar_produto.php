<?php
include 'menu_inicial.php';
include '../../model/DB/conexao.php';

// Verifica se o ID foi enviado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Produto não encontrado.'); window.history.back();</script>";
    exit;
}

$id_produto = intval($_GET['id']);

// Busca os dados do produto
$sqlProd = "SELECT * FROM produto WHERE id_produto = $id_produto";
$resProd = mysqli_query($con, $sqlProd);

if (!$resProd || mysqli_num_rows($resProd) == 0) {
    echo "<script>alert('Produto não encontrado.'); window.history.back();</script>";
    exit;
}

$produto = mysqli_fetch_assoc($resProd);

// Busca categorias
$sqlCat = "SELECT id_categoria, cat_nome FROM categoria";
$resCat = mysqli_query($con, $sqlCat);
$categorias = [];
while ($r = mysqli_fetch_assoc($resCat)) {
    $categorias[] = $r;
}

// Busca subcategorias
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
    <script defer src="../../view/js/adm/adicionar_produto.js"></script>
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
        <!-- ID oculto -->
        <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">

        <section class="add_product_area">
            <article class="add_product_image">
                <div class="img_holder">
                    <label class="img_holder_button">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <span>Alterar imagem</span>
                        <input type="file" class="input_product_info" accept="image/*" name="imagem" style="display:none;">
                    </label>
                </div>
                <?php if (!empty($produto['imagem'])): ?>
                    <div style="text-align:center; margin-top:10px;">
                        <img src="../../uploads/<?= htmlspecialchars($produto['imagem']) ?>" alt="Imagem atual" style="width:150px; border-radius:8px;">
                    </div>
                <?php endif; ?>
            </article>

            <aside class="add_product_details">
                <div class="product_details_collumn">

                    <article class="input_product_name">
                        <p class="product_title_info">Nome do produto<span class="mandatory_space">*</span></p>
                        <input type="text" class="input_product_info" name="nome" required value="<?= htmlspecialchars($produto['nome']) ?>">
                    </article>

                    <article class="input_product_price">
                        <p class="product_title_info">Valor<span class="mandatory_space">*</span></p>
                        <input type="number" class="input_product_info" name="valor" required min="0.01" step="0.01" value="<?= htmlspecialchars($produto['valor']) ?>">
                    </article>

                    <article class="input_product_quantity">
                        <p class="product_title_info">Quantidade<span class="mandatory_space">*</span></p>
                        <input type="number" class="input_product_info" name="quantidade" required min="0" value="<?= htmlspecialchars($produto['quantidade']) ?>">
                    </article>

                    <article class="input_product_subcategory">
                        <p class="product_title_info">Categoria<span class="mandatory_space">*</span></p>
                        <select name="categoria" class="input_product_info" id="categoria" required>
                            <option value="" disabled>Selecione uma categoria</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?= $cat['id_categoria'] ?>" <?= ($cat['id_categoria'] == $produto['id_categoria']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['cat_nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </article>

                    <article class="input_product_subcategory">
                        <p class="product_title_info">Subcategoria<span class="mandatory_space">*</span></p>
                        <select name="subcategoria" class="input_product_info" id="subcategoria" required>
                            <option value="" disabled>Selecione uma subcategoria</option>
                            <?php
                            if (isset($subMap[$produto['id_categoria']])) {
                                foreach ($subMap[$produto['id_categoria']] as $sub) {
                                    $selected = ($sub['id_subcategoria'] == $produto['id_subcategoria']) ? 'selected' : '';
                                    echo "<option value='{$sub['id_subcategoria']}' $selected>" . htmlspecialchars($sub['subcat_nome']) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </article>

                </div>

                <div class="product_details_collumn">

                    <article>
                        <p class="product_title_info">Descrição<span class="mandatory_space">*</span></p>
                        <textarea name="descricao" class="input_product_info product_details" required><?= htmlspecialchars($produto['descricao']) ?></textarea>
                    </article>

                    <article>
                        <p class="product_title_info">Peso (kg)<span class="mandatory_space">*</span></p>
                        <input type="number" class="input_product_info" name="peso" min="0" value="<?= htmlspecialchars($produto['peso']) ?>">
                    </article>

                    <article>
                        <p class="product_title_info">Idade<span class="mandatory_space">*</span></p>
                        <input type="date" class="input_product_info" name="idade" value="<?= htmlspecialchars($produto['idade']) ?>">
                    </article>

                    <article>
                        <p class="product_title_info">Sexo<span class="mandatory_space">*</span></p>
                        <select class="product_info_select" name="sexo" required>
                            <option value="M" <?= ($produto['sexo'] == 'M') ? 'selected' : '' ?>>Macho</option>
                            <option value="F" <?= ($produto['sexo'] == 'F') ? 'selected' : '' ?>>Fêmea</option>
                            <option value="Não se aplica" <?= ($produto['sexo'] == 'Não se aplica') ? 'selected' : '' ?>>Não se aplica (Produto)</option>
                        </select>
                    </article>

                    <article>
                        <p class="product_title_info">É campeão?<span class="mandatory_space">*</span></p>
                        <select class="product_info_select" name="campeao" required>
                            <option value="sim" <?= ($produto['campeao'] == 'sim') ? 'selected' : '' ?>>Sim</option>
                            <option value="nao" <?= ($produto['campeao'] == 'nao') ? 'selected' : '' ?>>Não</option>
                        </select>
                    </article>

                </div>
            </aside>
        </section>

        <div class="add_product_submit_button">
            <button type="submit" class="add_product_button">
                <i class="bi bi-save"></i> Salvar Alterações
            </button>
        <div class="edit_product_submit_button">
            <?php
            $texto = "Avançar";
            include 'botao_verde_adm.php';
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