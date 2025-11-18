<?php
include '../../model/DB/conexao.php';

function extrairPrimeiraImagem($path)
{
    if (empty($path)) {
        return "../../View/Public/imagens/default-thumbnail.jpg";
    }

    $path = trim($path);


    if ($path[0] === '[') {
        $lista = json_decode($path, true);
        if (is_array($lista)) {
            foreach ($lista as $img) {
                if (!empty($img) && $img !== "null") {
                    return "../../View/Public/" . str_replace("\\", "", $img);
                }
            }
        }
    }

    if (str_contains($path, ',')) {
        $lista = explode(',', $path);
        $img = trim(str_replace("\\", "", $lista[0]));
        return "../../View/Public/" . $img;
    }


    return "../../View/Public/" . str_replace("\\", "", $path);
}



function getProdutosAleatorios($limite = 5)
{
    global $con;

    $sql = "SELECT id_produto, path_img, peso, prod_nome, idade, valor 
            FROM produto 
            WHERE produto_ativo = 1 
            ORDER BY RAND() 
            LIMIT ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $limite);
    $stmt->execute();
    $result = $stmt->get_result();

    $produtos = [];

    while ($row = $result->fetch_assoc()) {
        $row['imagem'] = extrairPrimeiraImagem($row['path_img']);
        $produtos[] = $row;
    }

    return $produtos;
}
