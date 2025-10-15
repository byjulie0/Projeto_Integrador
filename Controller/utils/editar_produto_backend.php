<?php
include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = intval($_POST['id_produto'] ?? 0);
    $nome = mysqli_real_escape_string($con, $_POST['nome'] ?? '');
    $valor = floatval($_POST['valor'] ?? 0);
    $quantidade = intval($_POST['quantidade'] ?? 0);
    $categoria = intval($_POST['categoria'] ?? 0);
    $subcategoria = intval($_POST['subcategoria'] ?? 0);
    $descricao = mysqli_real_escape_string($con, $_POST['descricao'] ?? '');
    $peso = floatval($_POST['peso'] ?? 0);
    $idade = mysqli_real_escape_string($con, $_POST['idade'] ?? '');
    $sexo = mysqli_real_escape_string($con, $_POST['sexo'] ?? '');
    $campeao = mysqli_real_escape_string($con, $_POST['campeao'] ?? '');

    if (!empty($_FILES['imagem']['name'])) {
        $nomeImagem = basename($_FILES['imagem']['name']);
        $caminho = '../../uploads/' . $nomeImagem;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho);
        $imgQuery = ", path_img = '$nomeImagem'";
    } else {
        $imgQuery = "";
    }

    $sql = "UPDATE produto SET 
                prod_nome = '$nome',
                valor = '$valor',
                quant_estoque = '$quantidade',
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
        echo '<pre>Erro SQL: ' . mysqli_error($con) . '</pre>';
        echo "<script>alert('Erro ao atualizar produto.'); window.history.back();</script>";
    }

} else {
    echo "<script>alert('Acesso inválido!'); window.history.back();</script>";
    exit;
}
?>