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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
    <p class="product_title_info_img">Imagens do produto (máx.4)<span class="mandatory_space">*</span></p>

    <div class="carousel-container">
        <button type="button" class="carousel-btn prev" onclick="changeSlide(-1)">❮</button>
        <button type="button" class="carousel-btn next" onclick="changeSlide(1)">❯</button>
        <div class="carousel-placeholder" id="carouselPlaceholder">Clique em um quadrado para adicionar</div>
        <img src="" alt="" class="carousel-img" id="mainPreview" style="display: none;">
    </div>

    <div class="mini-container">
        <?php for ($i = 0; $i < 4; $i++): ?>
            <label class="custom-file-upload" for="input<?= $i ?>">
            <div class="upload-box" id="box<?= $i ?>">
                <img src="" alt="" class="mini-img" id="miniImg<?= $i ?>" style="display: none;">
                <div class="upload-content" id="content<?= $i ?>">
                    <i class="bi bi-camera-fill"></i>
                    <span>Adicionar</span>
                </div>
                <button type="button" class="remove-mini" id="remove<?= $i ?>" style="display: none;">×</button>
            </div>
                <input type="file" name="imagens[]" accept="image/*" class="file-input-hidden" id="input<?= $i ?>">
            </label>
        <?php endfor; ?>
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
                            <textarea id="descricao" name="descricao" placeholder="Descrição..." class="input_product_info product_details" required></textarea>
                        </article>

                        <article class="input_product_quantity">
                            <p class="product_title_info">Peso do animal<span class="mandatory_space">*</span></p>
                            <input type="number" placeholder="Peso em quilos" class="input_product_info" name="peso" required min="0">
                        </article>

                        <article class="input_product_quantity">
                            <p class="product_title_info">Idade do animal<span class="mandatory_space">*</span></p>
                            <input type="date" class="input_product_info" name="idade" required>
                        </article>

                        <article class="input_product_category">
                            <p class="product_title_info">Sexo do animal<span class="mandatory_space">*</span></p>
                            <select class="product_info_select" name="sexo" required>
                                <option value="" selected disabled>Selecione uma opção</option>
                                <option value="M">Macho</option>
                                <option value="F">Fêmea</option>
                                <option value="Não se aplica">Não se aplica (Produto)</option>
                            </select>
                        </article>

                        <article class="input_product_champion">
                            <p class="product_title_info">Categoria é um campeão?<span class="mandatory_space">*</span></p>
                            <select class="product_info_select" name="campeao" required>
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
                include 'botao_verde_adm.php';
                ?>
            </div>
        </form>
    </div>

    <script>
        window.subMapData = <?= json_encode($subMap, JSON_UNESCAPED_UNICODE); ?>;
    </script>
    <?php include 'footer.php'; ?>
    <script>
    const subMapData = <?= json_encode($subMap, JSON_UNESCAPED_UNICODE); ?>;
    let currentSlide = 0;
    const previews = [];

    document.querySelectorAll('.file-input-hidden').forEach((input, index) => {
        input.addEventListener('change', () => handleFileSelect(input, index));
    });
    
    document.querySelectorAll('.custom-file-upload').forEach(label => {
    label.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-mini')) {
            e.preventDefault();
            return;
        }
        });
    });

    document.querySelectorAll('.remove-mini').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const index = btn.id.replace('remove', '');
            clearImage(index);
        });
    });

    function handleFileSelect(input, index) {
    const file = input.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        const imgData = e.target.result;
        previews[index] = imgData;

        // Atualiza visual
        const miniImg = document.getElementById(`miniImg${index}`);
        const content = document.getElementById(`content${index}`);
        const remove = document.getElementById(`remove${index}`);

        miniImg.src = imgData;
        miniImg.style.display = 'block';
        content.style.display = 'none';
        remove.style.display = 'flex';

        updateCarousel();
    };
    reader.readAsDataURL(file);
}

   function clearImage(index) {
    const input = document.getElementById(`input${index}`);
    input.value = '';

    const miniImg = document.getElementById(`miniImg${index}`);
    const content = document.getElementById(`content${index}`);
    const remove = document.getElementById(`remove${index}`);

    miniImg.src = '';
    miniImg.style.display = 'none';
    content.style.display = 'flex';
    remove.style.display = 'none';

    previews[index] = null;
    updateCarousel();
}

    function updateCarousel() {
        const mainImg = document.getElementById('mainPreview');
        const placeholder = document.getElementById('carouselPlaceholder');

        const filledPreviews = previews.filter(p => p);
        if (filledPreviews.length === 0) {
            mainImg.style.display = 'none';
            placeholder.style.display = 'block';
            return;
        }

        const imgSrc = filledPreviews[currentSlide] || filledPreviews[0];
        mainImg.src = imgSrc;
        mainImg.style.display = 'block';
        placeholder.style.display = 'none';
    }

    function changeSlide(direction) {
        const filled = previews.filter(p => p);
        if (filled.length === 0) return;

        currentSlide = (currentSlide + direction + filled.length) % filled.length;
        updateCarousel();
    }

    document.getElementById('categoria').addEventListener('change', function() {
        const catId = this.value;
        const subSelect = document.getElementById('subcategoria');
        subSelect.innerHTML = '<option value="" selected disabled>Selecione uma subcategoria</option>';
        subSelect.disabled = true;

        if (subMapData[catId]) {
            subMapData[catId].forEach(sub => {
                const opt = document.createElement('option');
                opt.value = sub.id_subcategoria;
                opt.textContent = sub.subcat_nome;
                subSelect.appendChild(opt);
            });
            subSelect.disabled = false;
        }
    });
</script>
</body>
</html>