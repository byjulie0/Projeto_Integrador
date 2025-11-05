<?php
include '../../model/DB/conexao.php';

$popup_titulo = '';
$popup_mensagem = '';
$popup_tipo = '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../adm/catalogo_produtos.php');
    exit;
}

$id_produto = intval($_POST['id_produto'] ?? 0);
if ($id_produto <= 0) {
    $popup_titulo = "Erro!";
    $popup_mensagem = "ID inválido.";
    $popup_tipo = "erro";
    include '../adm/popup.php';
    exit;
}

// VALIDAÇÃO
$nome = trim($_POST['nome'] ?? '');
$valor = floatval($_POST['valor'] ?? 0);
$quantidade = intval($_POST['quantidade'] ?? 0);
$descricao = trim($_POST['descricao'] ?? '');
$sexo = $_POST['sexo'] ?? '';
$peso = floatval($_POST['peso'] ?? 0);
$idade = $_POST['idade'] ?? null;
$campeao = (strtolower($_POST['campeao'] ?? '') === 'sim') ? 1 : 0;
$categoria = intval($_POST['categoria'] ?? 0);
$subcategoria = intval($_POST['subcategoria'] ?? 0);

if (empty($nome) || $valor <= 0 || $quantidade < 0 || $categoria <= 0 || $subcategoria <= 0 || empty($sexo)) {
    $popup_titulo = "Erro!";
    $popup_mensagem = "Preencha todos os campos obrigatórios.";
    $popup_tipo = "erro";
    include '../adm/popup.php';
    exit;
}

// IMAGENS ATUAIS
$sql = "SELECT path_img FROM produto WHERE id_produto = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_produto);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$imagensAtuais = json_decode($row['path_img'] ?? '[]', true);
$imagensAtuais = is_array($imagensAtuais) ? $imagensAtuais : array_fill(0, 4, null);
$stmt->close();

// PROCESSA IMAGENS
$imagensFinais = array_fill(0, 4, null);
$temImagem = false;
$pastaUpload = '../../view/public/img/produtos/';
if (!is_dir($pastaUpload)) mkdir($pastaUpload, 0777, true);
$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

// 1. Mantém
if (isset($_POST['manter_imagem'])) {
    foreach ($_POST['manter_imagem'] as $i => $manter) {
        if ($manter === '1' && empty($_FILES['imagens']['name'][$i])) {
            $imagensFinais[$i] = $imagensAtuais[$i] ?? null;
            if ($imagensFinais[$i]) $temImagem = true;
        }
    }
}

// 2. Uploads
if (isset($_FILES['imagens']) && is_array($_FILES['imagens']['name'])) {
    for ($i = 0; $i < 4; $i++) {
        if (!empty($_FILES['imagens']['name'][$i]) && $_FILES['imagens']['error'][$i] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['imagens']['tmp_name'][$i];
            $file_name = $_FILES['imagens']['name'][$i];
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if (in_array($ext, $allowed) && $_FILES['imagens']['size'][$i] <= 5 * 1024 * 1024) {
                $novo_nome = "produto_{$id_produto}_img" . ($i + 1) . "_" . time() . ".$ext";
                $destino = $pastaUpload . $novo_nome;

                if (move_uploaded_file($file_tmp, $destino)) {
                    $imagensFinais[$i] = 'img/produtos/' . $novo_nome;
                    $temImagem = true;

                    if (!empty($imagensAtuais[$i])) {
                        $antigo = '../../view/public/' . $imagensAtuais[$i];
                        if (file_exists($antigo)) unlink($antigo);
                    }
                }
            }
        }
    }
}

// 3. Remove
if (isset($_POST['remover_imagem'])) {
    foreach ($_POST['remover_imagem'] as $i => $del) {
        if ($del === '1' && !empty($imagensAtuais[$i])) {
            $antigo = '../../view/public/' . $imagensAtuais[$i];
            if (file_exists($antigo)) unlink($antigo);
            $imagensFinais[$i] = null;
        }
    }
}

if (!$temImagem) {
    $popup_titulo = "Erro!";
    $popup_mensagem = "Adicione pelo menos uma imagem.";
    $popup_tipo = "erro";
    include '../adm/popup.php';
    exit;
}

// SALVA
$imagensJson = json_encode($imagensFinais, JSON_UNESCAPED_UNICODE);

$stmt = $con->prepare("UPDATE produto SET 
    prod_nome = ?, valor = ?, quant_estoque = ?, path_img = ?, descricao = ?, 
    sexo = ?, peso = ?, idade = ?, campeao = ?, id_categoria = ?, id_subcategoria = ?
    WHERE id_produto = ?");

$stmt->bind_param(
    "sdisssdssiii",
    $nome, $valor, $quantidade, $imagensJson, $descricao,
    $sexo, $peso, $idade, $campeao, $categoria, $subcategoria, $id_produto
);

if ($stmt->execute()) {
    $popup_titulo = "Sucesso!";
    $popup_mensagem = "Produto atualizado!";
    $popup_tipo = "sucesso";
} else {
    $popup_titulo = "Erro!";
    $popup_mensagem = "Erro: " . $stmt->error;
    $popup_tipo = "erro";
}
$stmt->close();
?>

<?php if (!empty($popup_titulo)): ?>
<div id="popup_resultado" class="popup_resultado" style="display:flex;">
    <div class="area_popup_resultado <?= $popup_tipo ?>">
        <span class="fechar_popup_resultado">X</span>
        <h2><?= htmlspecialchars($popup_titulo) ?></h2>
        <p><?= nl2br(htmlspecialchars($popup_mensagem)) ?></p>
        <button onclick="location.href='../adm/catalogo_produtos.php'" class="botao_popup_cancelar fechar_popup_resultado">Fechar</button>
    </div>
</div>
<link rel="stylesheet" href="../../view/public/css/cliente/pop_up_resultado.css">
<script src="../../view/public/js/pop_up_resultado.js"></script>
<?php endif; ?>