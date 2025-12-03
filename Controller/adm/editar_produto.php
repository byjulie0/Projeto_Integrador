<?php
include '../utils/autenticado_adm.php';
if ($adm_nao_logado) {
    include '../overlays/pop_up_login_adm.php';
    exit;
}
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'menu_inicial.php';

if (!isset($_GET['id_produto']) || !is_numeric($_GET['id_produto'])) { // Aparece, porém, não fecha
    $_SESSION['titulo'] = 'Não é possivel editar!';
    $_SESSION['popup_message'] = 'O produto não foi existe ou o endereço está errado.';
    $_SESSION['type'] = 'error';

    header("Location: ../adm/catalogo_produtos.php");
    exit;
}

// Verificar se há mensagens de pop-up na sessão
if (isset($_SESSION['popup_message'])) {
    $titulo = $_SESSION['titulo'];
    $texto = $_SESSION['popup_message'];

    // Verificar se é sucesso
    if ($_SESSION['type'] == 'success') {
        $sucesso = true;
    }
    include '../overlays/pop_up_erro.php';

    // Limpar a sessão
    unset($_SESSION['titulo']);
    unset($_SESSION['popup_message']);
    unset($_SESSION['type']);
}

$id_produto = (int) $_GET['id_produto'];
$sqlProd = "SELECT * FROM produto WHERE id_produto = $id_produto";
$resProd = mysqli_query($con, $sqlProd);

if (!$resProd || mysqli_num_rows($resProd) == 0) {
    $_SESSION['titulo'] = 'Atualização negada!';
    $_SESSION['popup_message'] = 'O produto produto não existe ou o endereço está errado.';
    $_SESSION['type'] = 'error';

    header("Location: ../adm/catalogo_produtos.php");
    exit;
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

$imgs = json_decode($produto['path_img'], true);
if (!is_array($imgs))
    $imgs = [null, null, null, null];
while (count($imgs) < 4)
    $imgs[] = null;
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

        <form action="../utils/editar_produto_backend.php" method="POST" enctype="multipart/form-data"
            id="formEditarProduto">
            <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">

            <section class="add_product_area">
                <article class="add_product_image">
                    <p class="product_title_info_img">Imagens do produto (máx.4)<span class="mandatory_space">*</p>
                    <div class="carousel-container">
                        <button type="button" class="carousel-btn prev" onclick="changeSlide(-1)"><i
                                class="bi bi-chevron-left"></i></button>
                        <button type="button" class="carousel-btn next" onclick="changeSlide(1)"><i
                                class="bi bi-chevron-right"></i></button>

                        <div class="carousel-placeholder" id="carouselPlaceholder">Nenhuma imagem</div>
                        <img src="" alt="" class="carousel-img" id="mainPreview" style="display:none;">
                    </div>
                    <div class="mini-container" id="miniContainer">
                        <?php for ($i = 0; $i < 4; $i++):
                            $src = $imgs[$i] ? '../../view/public/' . $imgs[$i] : '';
                            ?>
                            <label class="custom-file-upload mini-label" data-index="<?= $i ?>">
                                <div class="upload-box" id="box<?= $i ?>">
                                    <img src="<?= $src ?>" alt="" class="mini-img" id="miniImg<?= $i ?>"
                                        style="<?= $src ? '' : 'display:none;' ?>">
                                    <div class="upload-content" id="content<?= $i ?>"
                                        style="<?= $src ? 'display:none;' : '' ?>">
                                        <i class="bi bi-camera"></i>
                                        <span>Adicionar</span>
                                    </div>
                                    <button type="button" class="remove-mini" id="remove<?= $i ?>"
                                        style="<?= $src ? '' : 'display:none;' ?>"> <i class="bi bi-x"></i> </button>
                                </div>
                                <input type="file" name="imagens[]" accept="image/*" class="file-input-hidden"
                                    id="input<?= $i ?>">
                                <input type="hidden" name="remove_img[<?= $i ?>]" id="remove_input_<?= $i ?>" value="0">
                                <input type="hidden" name="old_img[<?= $i ?>]"
                                    value="<?= htmlspecialchars($imgs[$i] ?? '', ENT_QUOTES) ?>">
                            </label>
                        <?php endfor; ?>
                    </div>
                </article>

                <aside class="add_product_details">
                    <div class="product_details_collumn">

                        <article class="input_product_name">
                            <p class="product_title_info">Nome do produto<span class="mandatory_space">*</span></p>
                            <input type="text" class="input_product_info" placeholder="Nome do produto" name="nome"
                                value="<?= htmlspecialchars($produto['prod_nome']) ?>" required>
                        </article>

                        <article class="input_product_price">
                            <p class="product_title_info">Valor do produto<span class="mandatory_space">*</span></p>
                            <input type="number" placeholder="Valor" class="input_product_info" name="valor"
                                value="<?= htmlspecialchars($produto['valor']) ?>" required min="0.01" step="0.01">
                        </article>

                        <input type="hidden" name="quant_estoque" value="<?= $produto['quant_estoque'] ?>">

                        <article class=" input_product_quantity">
                            <p class="product_title_info">Quantidade<span class="mandatory_space">*</span></p>
                            <input type="number" placeholder="Quantidade" class="input_product_info" name="quantidade"
                                value="<?= htmlspecialchars($produto['quant_estoque']) ?>" required min="0">
                        </article>

                        <article class="input_product_subcategory">
                            <p class="product_title_info">Categoria<span class="mandatory_space">*</span></p>
                            <select name="categoria" class="input_product_info" id="categoria" required>
                                <option value="" disabled>Selecione uma categoria</option>
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?= $cat['id_categoria'] ?>"
                                        <?= $cat['id_categoria'] == $produto['id_categoria'] ? 'selected' : '' ?>>
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
                            <textarea id="descricao" name="descricao" wrap="soft" placeholder="Descrição..."
                                class="input_product_info product_details"
                                required><?= htmlspecialchars($produto['descricao']) ?></textarea>
                        </article>

                        <article class="input_product_quantity">
                            <p class="product_title_info">Peso do animal<span class="mandatory_space">*</span></p>
                            <input type="decimal" placeholder="Peso em quilos" class="input_product_info" name="peso"
                                value="<?= htmlspecialchars($produto['peso']) ?>" min="0" <?= $produto['id_categoria'] == 4 ? 'disabled' : '' ?>>
                        </article>

                        <article class="input_product_quantity">
                            <p class="product_title_info">Idade do animal<span class="mandatory_space">*</span></p>
                            <input type="date" class="input_product_info" name="idade"
                                value="<?= htmlspecialchars($produto['idade']) ?>" <?= $produto['id_categoria'] == 4 ? 'disabled' : '' ?>>
                        </article>

                        <article class="input_product_category">
                            <p class="product_title_info">Sexo do animal<span class="mandatory_space">*</span></p>
                            <select class="product_info_select" name="sexo" <?= $produto['id_categoria'] == 4 ? 'disabled' : '' ?>>
                                <option value="" disabled>Selecione</option>
                                <option value="M" <?= $produto['sexo'] == 'M' ? 'selected' : '' ?>>Macho</option>
                                <option value="F" <?= $produto['sexo'] == 'F' ? 'selected' : '' ?>>Fêmea</option>
                            </select>
                        </article>

                        <article class="input_product_champion">
                            <p class="product_title_info">Esse animal é um campeão?<span class="mandatory_space">*</span></p>
                            <select id="is_champion" class="product_info_select" name="campeao"
                                <?= $produto['id_categoria'] == 4 ? 'disabled' : '' ?>>
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
                include 'botao_verde_adm.php';
                ?>
            </div>
        </form>
    </div>

    <script>
        // Prevenir cache do navegador
        window.onpageshow = function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        };

        window.subMapData = <?= json_encode($subMap, JSON_UNESCAPED_UNICODE); ?>;
        window.produtoCategoria = <?= (int) $produto['id_categoria']; ?>;
        window.produtoSubcategoria = <?= (int) $produto['id_subcategoria']; ?>;
        window.produtoImgs = <?= json_encode($imgs, JSON_UNESCAPED_UNICODE); ?>;
    </script>
</body>

</html>