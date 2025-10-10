<?php
include '../../model/DB/conexao.php';

$popup_titulo = '';
$popup_mensagem = '';
$popup_tipo = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome         = mysqli_real_escape_string($con, $_POST["nome"]);
    $valor        = mysqli_real_escape_string($con, $_POST['valor']);
    $quantidade   = mysqli_real_escape_string($con, $_POST['quantidade']);
    $descricao    = mysqli_real_escape_string($con, $_POST['descricao']);
    $sexo         = mysqli_real_escape_string($con, $_POST['sexo']);
    $peso         = mysqli_real_escape_string($con, $_POST['peso']);
    $idade        = mysqli_real_escape_string($con, $_POST['idade']);
    $campeao      = mysqli_real_escape_string($con, $_POST['campeao']);
    $categoria    = mysqli_real_escape_string($con, $_POST['categoria']);
    $subcategoria = mysqli_real_escape_string($con, $_POST['subcategoria']);

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {

        $nomeImagem = basename($_FILES['imagem']['name']);
        $caminhoTemp = $_FILES['imagem']['tmp_name'];
        $pastaUpload = '../../view/public/uploads/';
        if (!file_exists($pastaUpload)) mkdir($pastaUpload, 0777, true);

        $ext = pathinfo($nomeImagem, PATHINFO_EXTENSION);
        $nomeUnico = uniqid() . "." . $ext;
        $caminhoFinal = $pastaUpload . $nomeUnico;

        if (move_uploaded_file($caminhoTemp, $caminhoFinal)) {
            $caminhoRelativo = 'uploads/' . $nomeUnico;

            $query = "INSERT INTO produto 
                (prod_nome, valor, quant_estoque, path_img, descricao, sexo, peso, idade, campeao, id_categoria, id_subcategoria) 
                VALUES 
                ('$nome', '$valor', '$quantidade', '$caminhoRelativo', '$descricao', '$sexo', '$peso', '$idade', '$campeao', '$categoria', '$subcategoria')";

            if (mysqli_query($con, $query)) {
                $popup_titulo = "Produto cadastrado!";
                $popup_mensagem = "O produto foi adicionado com sucesso.";
                $popup_tipo = "sucesso";
            } else {
                $popup_titulo = "Erro ao cadastrar!";
                $popup_mensagem = "Não foi possível salvar o produto.";
                $popup_tipo = "erro";
            }

        } else {
            $popup_titulo = "Erro no upload!";
            $popup_mensagem = "Não foi possível mover a imagem para a pasta de destino.";
            $popup_tipo = "erro";
        }

    } else {
        $popup_titulo = "Imagem obrigatória!";
        $popup_mensagem = "Você precisa enviar uma imagem para o produto.";
        $popup_tipo = "erro";
    }
}
?>

<?php if (!empty($popup_titulo)): ?>
<div id="popup_resultado" class="popup_resultado" style="display:flex;">
    <div class="area_popup_resultado <?= $popup_tipo ?>">
        <span class="fechar_popup_resultado">&times;</span>
        <h2><?= htmlspecialchars($popup_titulo, ENT_QUOTES, 'UTF-8') ?></h2>
        <p><?= nl2br(htmlspecialchars($popup_mensagem, ENT_QUOTES, 'UTF-8')) ?></p>
        <div class="botoes_popup_resultado">
            <button class="botao_popup_cancelar fechar_popup_resultado">Fechar</button>
        </div>
    </div>
</div>

<link rel="stylesheet" href="../../view/public/css/cliente/pop_up_resultado.css">
<script src="../../view/public/js/pop_up_resultado.js"></script>
<?php endif; ?>