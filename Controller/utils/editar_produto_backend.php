<?php
include 'gerar_notificacao.php';
include '../../model/DB/conexao.php';

$popup_titulo = '';
$popup_mensagem = '';
$popup_tipo = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_produto   = (int)$_POST["id_produto"];
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











    // criar notificação inicio

    $sql= "SELECT quant_estoque,prod_nome,path_img FROM produto WHERE id_produto = $id_produto";
    $qtd_inicial=$con->query($sql);

    $sql_encontrar_cliente="SELECT id_cliente FROM carrinho WHERE id_produto = $id_produto";
    $qtd_cliente=$con->query($sql_encontrar_cliente);
    $clientes=[];

    if ($qtd_cliente && $qtd_cliente->num_rows > 0){

        

         while ($cliente_row = $qtd_cliente->fetch_assoc()) { 
        $clientes[] = $cliente_row['id_cliente'];}

    }

    if ($qtd_inicial && $qtd_inicial->num_rows > 0) {
        $row = $qtd_inicial->fetch_assoc();
        $quant_estoque_inicial = $row['quant_estoque'];
        $img_produto = $row['path_img'];
        $nome_produto = $row['prod_nome'];
    }

    if ($quant_estoque_inicial == 0 && $quantidade > 0){
        foreach($clientes as $x){
            $usuario_id= $x;
            $produto_id= $id_produto;
            $mensagem="Cliente, a {$nome_produto} que você estava de olho voltou ao estoque, dê uma olhada!";
            $categoria="Produtos";
            if (Criar_notificacao($con, $usuario_id, $produto_id, $mensagem, $categoria)) {
                echo "Notificação enviada com sucesso!";
        } 
            else {
                echo "Erro ao enviar notificação.";
        }

    }


    }
    // criar notificação fim



    $caminhoRelativo = null;
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
        } else {
            $popup_titulo = "Erro no upload!";
            $popup_mensagem = "Não foi possível mover a imagem.";
            $popup_tipo = "erro";
        }
    }

    if ($popup_tipo !== "erro") {
        $setParts = [
            "prod_nome = '$nome'",
            "valor = '$valor'",
            "quant_estoque = '$quantidade'",
            "descricao = '$descricao'",
            "sexo = '$sexo'",
            "peso = '$peso'",
            "idade = '$idade'",
            "campeao = '$campeao'",
            "id_categoria = '$categoria'",
            "id_subcategoria = '$subcategoria'"
        ];

        if ($caminhoRelativo) {
            $setParts[] = "path_img = '$caminhoRelativo'";
        }
        $setQuery = implode(', ', $setParts);
        $query = "UPDATE produto SET $setQuery WHERE id_produto = $id_produto";

        if (mysqli_query($con, $query)) {
            $popup_titulo = "Produto atualizado!";
            $popup_mensagem = "As alterações foram salvas com sucesso.";
            $popup_tipo = "sucesso";
        } else {
            $popup_titulo = "Erro ao atualizar!";
            $popup_mensagem = "Não foi possível salvar as alterações.";
            $popup_tipo = "erro";
        }
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
            <button onclick="location.href='../adm/catalogo_produtos.php'" class="botao_popup_cancelar fechar_popup_resultado">Fechar</button>
        </div>
    </div>
</div>

<link rel="stylesheet" href="../../view/public/css/cliente/pop_up_resultado.css">
<script src="../../view/public/js/pop_up_resultado.js"></script>
<?php endif; ?>
