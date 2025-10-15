<?php
include 'menu_inicial.php';
include '../../model/DB/conexao.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('Produto não informado!'); window.location.href='listar_produtos.php';</script>";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM produto WHERE id_produto = $id";
$res = mysqli_query($con, $sql);

if (!$res || mysqli_num_rows($res) == 0) {
    echo "<script>alert('Produto não encontrado!'); window.location.href='listar_produtos.php';</script>";
    exit;
}

$produto = mysqli_fetch_assoc($res);

$sqlCat = "SELECT id_categoria, cat_nome FROM categoria";
$resCat = mysqli_query($con, $sqlCat);

$sqlSub = "SELECT id_subcategoria, subcat_nome, id_categoria FROM subcategoria";
$resSub = mysqli_query($con, $sqlSub);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../adm.css">
    <link rel="stylesheet" href="../../view/public/css/adm/editar_produto.css">
</head>

<body>
    <div class="area_edit_product">
        <div class="title_page_edit_product">
            <a href="listar_produtos.php" class="arrow_edit_product">&#8592;</a>
            <h2 class="tile_edit_product">Editar Produto</h2>
        </div>

        <div class="info_edit_product">
            <form action="editar_produto_backend.php" method="POST" enctype="multipart/form-data" class="edit_product_area">
                <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">

                <!-- Coluna Esquerda - Imagem -->
                <div class="product_img_section">
                    <h3 class="product_title_info_img">Imagem do Produto</h3>

                    <div class="img_holder">
                        <img id="previewImg" src="../../uploads/<?= htmlspecialchars($produto['path_img']) ?>" alt="Imagem do produto">
                    </div>

                    <input type="file" id="imagemInput" name="imagem" accept="image/*" class="img_input">
                    <button type="button" class="img_holder_button" onclick="document.getElementById('imagemInput').click();">
                        <span>Escolher nova imagem</span>
                    </button>
                </div>

                <!-- Coluna Direita - Informações -->
                <div class="product_details_collumn">
                    <div class="edit_product_details">
                        <div>
                            <label>Nome:</label>
                            <input type="text" name="nome" class="input_product_info" value="<?= htmlspecialchars($produto['prod_nome']) ?>" required>

                            <label>Valor:</label>
                            <input type="number" step="0.01" name="valor" class="input_product_info" value="<?= $produto['valor'] ?>" required>

                            <label>Quantidade:</label>
                            <input type="number" name="quantidade" class="input_product_info" value="<?= $produto['quant_estoque'] ?>" required>

                            <label>Peso:</label>
                            <input type="text" name="peso" class="input_product_info" value="<?= htmlspecialchars($produto['peso']) ?>">
                        </div>

                        <div>
                            <label>Categoria:</label>
                            <select name="categoria" class="product_info_select" required>
                                <option value="">Selecione...</option>
                                <?php while ($cat = mysqli_fetch_assoc($resCat)) { ?>
                                    <option value="<?= $cat['id_categoria'] ?>" <?= ($cat['id_categoria'] == $produto['id_categoria']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat['cat_nome']) ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <label>Subcategoria:</label>
                            <select name="subcategoria" class="product_info_select" required>
                                <option value="">Selecione...</option>
                                <?php while ($sub = mysqli_fetch_assoc($resSub)) { ?>
                                    <option value="<?= $sub['id_subcategoria'] ?>" <?= ($sub['id_subcategoria'] == $produto['id_subcategoria']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($sub['subcat_nome']) ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <label>Sexo:</label>
                            <select name="sexo" class="product_info_select">
                                <option value="">Selecione...</option>
                                <option value="Masculino" <?= ($produto['sexo'] == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                                <option value="Feminino" <?= ($produto['sexo'] == 'Feminino') ? 'selected' : '' ?>>Feminino</option>
                                <option value="Unissex" <?= ($produto['sexo'] == 'Unissex') ? 'selected' : '' ?>>Unissex</option>
                            </select>

                            <label>Campeão:</label>
                            <select name="campeao" class="product_info_select">
                                <option value="">Selecione...</option>
                                <option value="Sim" <?= ($produto['campeao'] == 'Sim') ? 'selected' : '' ?>>Sim</option>
                                <option value="Não" <?= ($produto['campeao'] == 'Não') ? 'selected' : '' ?>>Não</option>
                            </select>
                        </div>
                    </div>

                    <label>Descrição:</label>
                    <textarea name="descricao" class="product_details"><?= htmlspecialchars($produto['descricao']) ?></textarea>

                    <label>Idade:</label>
                    <input type="text" name="idade" class="input_product_info" value="<?= htmlspecialchars($produto['idade']) ?>">

                    <div class="edit_product_submit_button">
                        <button type="submit" class="edit_product_button">Salvar Alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const input = document.getElementById('imagemInput');
        const preview = document.getElementById('previewImg');

        input.addEventListener('change', () => {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    preview.src = reader.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>