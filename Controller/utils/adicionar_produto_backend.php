<?php
include '../../model/DB/conexao.php';

$popup_titulo = '';
$popup_mensagem = '';
$popup_tipo = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome         = trim($_POST['nome'] ?? '');
    $valor        = floatval($_POST['valor'] ?? 0);
    $quantidade   = intval($_POST['quantidade'] ?? 0);
    $descricao    = trim($_POST['descricao'] ?? '');
    $sexo         = $_POST['sexo'] ?? '';
    $peso         = floatval($_POST['peso'] ?? 0);
    $idade        = $_POST['idade'] ?? '';
    $campeao      = $_POST['campeao'] ?? '';
    $categoria    = intval($_POST['categoria'] ?? 0);
    $subcategoria = intval($_POST['subcategoria'] ?? 0);

    if (empty($nome) || $valor <= 0 || $quantidade < 0 || $categoria <= 0) {
        $popup_titulo = "Erro!";
        $popup_mensagem = "Preencha todos os campos obrigatórios.";
        $popup_tipo = "erro";
    } else {

        $imagens_nomes = [null, null, null, null];
        $pastaUpload = '../../view/public/uploads/';
        $uploadOk = false;

        if (!is_dir($pastaUpload)) mkdir($pastaUpload, 0777, true);

        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        // Recebe os 4 arquivos (mesmo vazios)
        $files = $_FILES['imagens'] ?? [];
        for ($i = 0; $i < 4; $i++) {
            if (
                isset($files['error'][$i]) &&
                $files['error'][$i] === UPLOAD_ERR_OK &&
                !empty($files['name'][$i])
            ) {
                $file_tmp = $files['tmp_name'][$i];
                $file_name = $files['name'][$i];
                $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                if (in_array($ext, $allowed) && filesize($file_tmp) <= 5 * 1024 * 1024) {
                    $novo_nome = 'img' . ($i + 1) . '.' . $ext;
                    $destino = $pastaUpload . $novo_nome;
                   if (move_uploaded_file($file_tmp, $destino)) {
                          $imagens_nomes[$i] = 'uploads/' . $novo_nome;  // novo_nome = img1.jpg, img2.jpg...
                           $uploadOk = true;
                    }
                }
            }
        }

        if (!$uploadOk) {
            $popup_titulo = "Imagem obrigatória!";
            $popup_mensagem = "Adicione pelo menos uma imagem.";
            $popup_tipo = "erro";
        } else {
            // SALVA NO CAMPO path_img COMO JSON
            $imagens_json = mysqli_real_escape_string($con, json_encode($imagens_nomes, JSON_UNESCAPED_UNICODE));

            $sql = "INSERT INTO produto 
                    (prod_nome, valor, quant_estoque, path_img, descricao, sexo, peso, idade, campeao, id_categoria, id_subcategoria)
                    VALUES 
                    ('$nome', '$valor', '$quantidade', '$imagens_json', '$descricao', '$sexo', '$peso', '$idade', '$campeao', '$categoria', '$subcategoria')";

            if (mysqli_query($con, $sql)) {
                $popup_titulo = "Sucesso!";
                $popup_mensagem = "Produto cadastrado com imagens!";
                $popup_tipo = "sucesso";
            } else {
                $popup_titulo = "Erro no banco!";
                $popup_mensagem = "Erro: " . mysqli_error($con);
                $popup_tipo = "erro";
            }
        }
    }
}
?>

<?php if (!empty($popup_titulo)): ?>
<div id="popup_resultado" class="popup_resultado" style="display:flex;">
    <div class="area_popup_resultado <?= $popup_tipo ?>">
        <h2><?= htmlspecialchars($popup_titulo) ?></h2>
        <p><?= nl2br(htmlspecialchars($popup_mensagem)) ?></p>
        <button onclick="location.href='../adm/catalogo_produtos.php'" class="botao_popup_cancelar fechar_popup_resultado">Fechar</button>
    </div>
</div>
<link rel="stylesheet" href="../../view/public/css/adm/pop_up_resultado.css">
<script src="../../view/public/js/pop_up_resultado.js"></script>
<?php endif; ?>