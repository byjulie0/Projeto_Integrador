<?php
include '../utils/autenticado.php';
if ($usuario_nao_logado) {
    include '../overlays/pop_up_login.php';
    exit;
}
include 'menu_pg_inicial.php';

$query = "SELECT
            produto.id_produto,
            produto.prod_nome,
            produto.path_img,
            produto.peso,
            produto.idade,
            produto.valor,
            subcategoria.subcat_nome
          FROM favorito
          JOIN produto ON favorito.id_produto = produto.id_produto
          JOIN subcategoria ON produto.id_subcategoria = subcategoria.id_subcategoria
          WHERE favorito.id_cliente = ?";

$stmt = $con->prepare($query);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Página Favoritos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../view/public/css/cliente/pg_favoritos.css">
</head>

<body>
    <div class="seta_titulo_pg_favoritos">
        <a class="btn_voltar_favoritos" href="#" onclick="window.history.back(); return false;">
            <i class="bi bi-chevron-left"></i>
        </a>
        <h2 class="h2_pg_favoritos">Favoritos</h2>
    </div>

    <div class="container_pg_favoritos">
        <div class="lotes-wrapper">
            <div class="lotes_container_pg_favoritos" id="lotesContainerFavoritos">
                <?php
                while ($row = $result->fetch_assoc()) {
                    $nome = $row['prod_nome'];
                    $id_produto = $row['id_produto'];
                    $peso = $row['peso'];
                    $raca = $row['subcat_nome'];
                    $idade = $row['idade'];
                    $preco = $row['valor'];
                    include 'card_favoritos.php';
                }
                $stmt->close();
                ?>
            </div>
        </div>
    </div>
</body>

</html>
<?php include 'footer_cliente.php'; ?>