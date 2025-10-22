<?php
include '../../model/DB/conexao.php';

$id = $_POST['id_produto'];
$nome = $_POST['nome'];
$valor = $_POST['valor'];
$quantidade = $_POST['quantidade'];
$categoria = $_POST['categoria'];
$subcategoria = $_POST['subcategoria'];
$descricao = $_POST['descricao'];
$peso = $_POST['peso'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo'];
$campeao = $_POST['campeao'];

if (!empty($_FILES['imagem']['name'])) {
    $nomeImagem = basename($_FILES['imagem']['name']);
    $caminho = '../../uploads/' . $nomeImagem;
    move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho);
    $imgQuery = ", imagem = '$nomeImagem'";
} else {
    $imgQuery = "";
}

$sql = "UPDATE produto SET
            nome = '$nome',
            valor = '$valor',
            quantidade = '$quantidade',
            id_categoria = '$categoria',
            id_subcategoria = '$subcategoria',
            descricao = '$descricao',
            peso = '$peso',
            idade = '$idade',
            sexo = '$sexo',
            campeao = '$campeao'
            $imgQuery
        WHERE id_produto = $id";

if (mysqli_query($con, $sql)) {
    echo "<script>alert('Produto atualizado com sucesso!'); window.location.href='../pages/listar_produtos.php';</script>";
} else {
    echo "<script>alert('Erro ao atualizar produto.'); window.history.back();</script>";
}