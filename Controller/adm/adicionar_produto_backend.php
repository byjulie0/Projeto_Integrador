<?php

include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = mysqli_real_escape_string($con, $_POST["nome"]);
    $valor = mysqli_real_escape_string($con, $_POST['valor']);
    $quantidade = mysqli_real_escape_string($con, $_POST['quantidade']);
    $descricao = mysqli_real_escape_string($con, $_POST['descricao']);
    $sexo = mysqli_real_escape_string($con, $_POST['sexo']);
    $peso = mysqli_real_escape_string($con, $_POST['peso']);
    $campeao = mysqli_real_escape_string($con, $_POST['campeao']);
    $categoria = mysqli_real_escape_string($con, $_POST['categoria']);
    $subcategoria = mysqli_real_escape_string($con, $_POST['subcategoria']);

}

// echo "nome = ".$nome;
// echo "valor = ".$valor;
// echo "qtde = ".$quantidade;
// echo "descr = ".$descricao;
// echo "sexo = ".$sexo;
// echo "peso = ".$peso;
// echo "camp = ".$campeao;
echo "cat = ".$categoria;
echo "sub = ".$subcategoria;



// if (empty($nome) || empty($valor) || empty($descricao) || empty($sexo) || empty($categoria) || empty($subcategoria)) {
//          die("Por favor, preencha todos os campos obrigatórios.");
        
//          header ("location: adicionar_produto.php");
//      }

$query = "insert into produto (prod_nome, valor, quant_estoque, path_img, descricao, sexo, peso, campeao, id_categoria, id_subcategoria) values ('{$nome}', '{$valor}',
'{$quantidade}', 'caminho' , '{$descricao}', '{$sexo}' , '{$peso}', '{$campeao}', '{$categoria}', '{$subcategoria}')";

$result= mysqli_query($con, $query);