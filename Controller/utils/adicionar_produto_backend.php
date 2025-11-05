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
    $idade        = $_POST['idade'] ?? null;
    $campeao      = strtolower($_POST['campeao'] ?? '') === 'sim' ? 1 : 0;
    $categoria    = intval($_POST['categoria'] ?? 0);
    $subcategoria = intval($_POST['subcategoria'] ?? 0);

    if (empty($nome) || $valor <= 0 || $quantidade < 0 || $categoria <= 0 || $subcategoria <= 0 || empty($sexo)) {
        $popup_titulo = "Erro!";
        $popup_mensagem = "Preencha todos os campos obrigatórios corretamente.";
        $popup_tipo = "erro";
    } else {

        $pastaUpload = '../../view/public/uploads/';
        if (!is_dir($pastaUpload)) mkdir($pastaUpload, 0777, true);

        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $imagens_nomes = array_fill(0, 4, null);
        $uploadOk = false;

        if (isset($_FILES['imagens']) && is_array($_FILES['imagens']['name'])) {
            for ($i = 0; $i < 4; $i++) {
                if (
                    isset($_FILES['imagens']['error'][$i]) &&
                    $_FILES['imagens']['error'][$i] === UPLOAD_ERR_OK &&
                    !empty($_FILES['imagens']['name'][$i])
                ) {
                    $file_tmp = $_FILES['imagens']['tmp_name'][$i];
                    $file_name = $_FILES['imagens']['name'][$i];
                    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                    if (in_array($ext, $allowed) && $_FILES['imagens']['size'][$i] <= 5 * 1024 * 1024) {
                        $novo_nome = "img" . ($i + 1) . "_" . time() . ".$ext";
                        $destino = $pastaUpload . $novo_nome;

                        if (move_uploaded_file($file_tmp, $destino)) {
                            $imagens_nomes[$i] = 'uploads/' . $novo_nome;
                            $uploadOk = true;
                        }
                    }
                }
            }
        }

        if (!$uploadOk) {
            $popup_titulo = "Imagem obrigatória!";
            $popup_mensagem = "Adicione pelo menos uma imagem.";
            $popup_tipo = "erro";
        } else {
            $imagens_json = json_encode($imagens_nomes, JSON_UNESCAPED_UNICODE);

            $stmt = $con->prepare("INSERT INTO produto 
                (prod_nome, valor, quant_estoque, path_img, descricao, sexo, peso, idade, campeao, id_categoria, id_subcategoria)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param(
                "sdisssdssii",
                $nome, $valor, $quantidade, $imagens_json, $descricao, $sexo, $peso, $idade, $campeao, $categoria, $subcategoria
            );

            if ($stmt->execute()) {
                $popup_titulo = "Sucesso!";
                $popup_mensagem = "Produto cadastrado com sucesso!";
                $popup_tipo = "sucesso";
            } else {
                $popup_titulo = "Erro no banco!";
                $popup_mensagem = "Erro: " . $stmt->error;
                $popup_tipo = "erro";
            }
            $stmt->close();
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