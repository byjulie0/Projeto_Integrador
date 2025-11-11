<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premiados</title>
    <script defer src="../../view/js/cliente/campeoes.js"></script>
    <link rel="stylesheet" href="../../view/public/css/cliente/carrosseis_inicial.css">
</head>

<body class="body_pg_carrossel_campeoes">
    <section id="campeoes">
        <div class="carrossel_campeoes_cor">
            <h1 class="pg_campeoes" id="campeoes">Animais premiados</h1>

            <div class="carrossel_campeoes">
                <div class="arrow_campeoes" id="arrow-esquerda3">&#10094;</div>

                <div class="cards_campeoes" id="carrossel-cards3">
                    <?php
                    include_once '../../model/DB/conexao.php';
                    $sql = "SELECT id_produto, prod_nome, valor, path_img, peso, idade, descricao 
                            FROM produto 
                            WHERE campeao = 1 AND produto_ativo = 1";
                    $resultado = $con->query($sql);

                    if ($resultado && $resultado->num_rows > 0) {
                        while ($row = $resultado->fetch_assoc()) {
                            $id_produto = $row['id_produto'];
                            $raca = htmlspecialchars($row['prod_nome']);
                            $peso = number_format($row['peso'], 2, ',', '.') . " kg";
                            $idade = date('Y', strtotime($row['idade'])) < 2000 ? "Não informada" : date('d/m/Y', strtotime($row['idade']));
                            $preco = number_format($row['valor'], 2, ',', '.');
                            $descricao = htmlspecialchars($row['descricao']);

                            
                            $imagem = '../../View/Public/imagens/default-thumbnail.jpg'; 
                            if (!empty($row['path_img'])) {
                                $path = trim(string: $row['path_img']);
                                
                                if ($path[0] === '[') {
                                    
                                    $listaImagens = json_decode($path, true);
                                    if (is_array($listaImagens) && !empty($listaImagens[0])) {
                                        $imagem = '../../View/Public/' . trim(str_replace('\\', '', $listaImagens[0]));
                                    }
                                } elseif (str_contains($path, ',')) {
                                    
                                    $partes = explode(',', $path);
                                    $primeira = trim(str_replace('\\', '', $partes[0]));
                                    $imagem = '../../View/Public/' . $primeira;
                                } else {
                                    
                                    $imagem = '../../View/Public/' . str_replace('\\', '', $path);
                                }
                            }
                            
                            echo '<a href="detalhes_produto.php?id=' . $id_produto . '">';
                            include 'card_carrossel.php';
                            echo '</a>';
                        }
                    } else {
                        echo '<p style="text-align:center;">Nenhum produto premiado encontrado.</p>';
                    }

                    $con->close();
                    ?>
                </div>

                <div class="arrow_campeoes" id="arrow-direita3">&#10095;</div>
            </div>
        </div>
    </section>
</body>
</html>
