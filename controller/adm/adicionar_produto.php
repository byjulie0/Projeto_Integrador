<?php
include '../utils/autenticado_adm.php';
include 'menu_inicial.php';

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
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Adicionar Produto</title>

<link rel="stylesheet" href="../../view/public/css/adm/adicionar_produto.css">
<link rel="stylesheet" href="../../view/public/css/adm/pop_up_resultado.css">

<script defer src="../../view/js/adm/adicionar_produto.js"></script>
<script defer src="../../view/public/js/pop_up_resultado.js"></script>

</head>
<body>

<?php
session_start();
if (isset($_SESSION['popup_titulo'])) {
    $popup_titulo   = $_SESSION['popup_titulo'];
    $popup_mensagem = $_SESSION['popup_mensagem'];
    $popup_tipo     = $_SESSION['popup_tipo'];

    include '../overlays/pop_up_resultado.php';

    unset($_SESSION['popup_titulo'], $_SESSION['popup_mensagem'], $_SESSION['popup_tipo']);
}
?>

<div class="area_add_product">
    <div class="title_page_add_product">
        <a href="#" onclick="history.back(); return false;" class="arrow_add_product">
            <i class="bi bi-chevron-left"></i>
        </a>
        <h1 class="tile_add_product">Adicionar Produto</h1>
    </div>

<form action="../utils/adicionar_produto_backend.php" method="POST" enctype="multipart/form-data">

<section class="add_product_area">

<!-- IMAGENS -->
<article class="add_product_image">
<p class="product_title_info_img">Imagens do produto (máx.4) *</p>

<div class="carousel-container">
    <button type="button" class="carousel-btn prev" onclick="changeSlide(-1)">
        <i class="bi bi-chevron-left"></i>
    </button>

    <button type="button" class="carousel-btn next" onclick="changeSlide(1)">
        <i class="bi bi-chevron-right"></i>
    </button>

    <div class="carousel-placeholder" id="carouselPlaceholder">
        Clique em um quadrado para adicionar
    </div>

    <img id="mainPreview" class="carousel-img" style="display:none;">
</div>

<div class="mini-container">
    <?php for ($i=0;$i<4;$i++): ?>
    <label class="custom-file-upload" for="input<?= $i ?>">
        <div class="upload-box" id="box<?= $i ?>">
            <img class="mini-img" id="miniImg<?= $i ?>" style="display:none;">
            <div class="upload-content" id="content<?= $i ?>">
                <i class="bi bi-camera"></i>
                <span>Adicionar</span>
            </div>
            <button type="button" class="remove-mini" id="remove<?= $i ?>" style="display:none;">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <input type="file" name="imagens[]" accept="image/*" class="file-input-hidden" id="input<?= $i ?>">
    </label>
    <?php endfor; ?>
</div>

</article>

<aside class="add_product_details">

<!-- COLUNA 1 -->
<div class="product_details_collumn">
    <article class="input_product_name">
        <p class="product_title_info">Nome *</p>
        <input type="text" class="input_product_info" name="nome" required>
    </article>

    <article class="input_product_price">
        <p class="product_title_info">Valor *</p>
        <input type="number" min="0.01" step="0.01" class="input_product_info" name="valor" required>
    </article>

    <article class="input_product_quantity">
        <p class="product_title_info">Quantidade *</p>
        <input type="number" min="0" class="input_product_info" name="quantidade" required>
    </article>

    <article>
        <p class="product_title_info">Categoria *</p>
        <select name="categoria" id="categoria" class="input_product_info" required>
            <option disabled selected>Selecione</option>
            <?php foreach ($categorias as $c): ?>
            <option value="<?= $c['id_categoria'] ?>"><?= htmlspecialchars($c['cat_nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </article>

    <article>
        <p class="product_title_info">Subcategoria *</p>
        <select name="subcategoria" id="subcategoria" class="input_product_info" required disabled>
            <option disabled selected>Selecione</option>
        </select>
    </article>
</div>

<!-- COLUNA 2 -->
<div class="product_details_collumn">

    <article>
        <p class="product_title_info">Descrição *</p>
        <textarea name="descricao" class="input_product_info product_details" required></textarea>
    </article>

    <div id="area_animal">
        <article>
            <p class="product_title_info">Peso *</p>
            <input type="number" name="peso" min="0" class="input_product_info">
        </article>

        <article>
            <p class="product_title_info">Idade *</p>
            <input type="date" name="idade" class="input_product_info">
        </article>

        <article>
            <p class="product_title_info">Sexo *</p>
            <select name="sexo" class="input_product_info">
                <option disabled selected>Selecione</option>
                <option value="Macho">Macho</option>
                <option value="Fêmea">Fêmea</option>
            </select>
        </article>

        <article>
            <p class="product_title_info">Campeão *</p>
            <select name="campeao" class="input_product_info">
                <option disabled selected>Selecione</option>
                <option value="sim">Sim</option>
                <option value="nao">Não</option>
            </select>
        </article>
    </div>
</div>

</aside>

</section>

<div class="add_product_submit_button">
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

</body>
</html>

