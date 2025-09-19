<?php
include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome         = mysqli_real_escape_string($con, $_POST["nome"]);
    $valor        = mysqli_real_escape_string($con, $_POST['valor']);
    $quantidade   = mysqli_real_escape_string($con, $_POST['quantidade']);
    $descricao    = mysqli_real_escape_string($con, $_POST['descricao']);
    $sexo         = mysqli_real_escape_string($con, $_POST['sexo']);
    $peso         = mysqli_real_escape_string($con, $_POST['peso']);
    $campeao      = mysqli_real_escape_string($con, $_POST['campeao']);
    $categoria    = mysqli_real_escape_string($con, $_POST['categoria']);
    $subcategoria = mysqli_real_escape_string($con, $_POST['subcategoria']);

    /* === Upload da imagem === */
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {

        $nomeImagem = basename($_FILES['imagem']['name']);
        $caminhoTemp = $_FILES['imagem']['tmp_name'];

        $pastaUpload = '../../view/public/uploads/';
        if (!file_exists($pastaUpload)) {
            mkdir($pastaUpload, 0777, true);
        }

        // Cria um nome único para evitar conflito
        $ext = pathinfo($nomeImagem, PATHINFO_EXTENSION);
        $nomeUnico = uniqid() . "." . $ext;
        $caminhoFinal = $pastaUpload . $nomeUnico;

        if (move_uploaded_file($caminhoTemp, $caminhoFinal)) {
            // Salva no banco usando o caminho relativo
            $caminhoRelativo = 'uploads/' . $nomeUnico;

            $query = "INSERT INTO produto 
                (prod_nome, valor, quant_estoque, path_img, descricao, sexo, peso, campeao, id_categoria, id_subcategoria) 
                VALUES 
                ('$nome', '$valor', '$quantidade', '$caminhoRelativo', '$descricao', '$sexo', '$peso', '$campeao', '$categoria', '$subcategoria')";

            if (mysqli_query($con, $query)) {
                echo "Produto cadastrado com sucesso!";
            } else {
                echo "Erro ao cadastrar produto: " . mysqli_error($con);
            }
        } else {
            echo "Erro ao mover a imagem para a pasta de destino.";
        }
    } else {
        echo "Nenhuma imagem foi enviada ou ocorreu um erro no upload.";
    }
}

// $query = "insert into produto (prod_nome, valor, quant_estoque, path_img, descricao, sexo, peso, campeao, id_categoria, id_subcategoria) values ('{$nome}', '{$valor}',
// '{$quantidade}', 'caminho' , '{$descricao}', '{$sexo}' , '{$peso}', '{$campeao}', '{$categoria}', '{$subcategoria}')";

// $result= mysqli_query($con, $query);