<?php
include '../utils/autenticado.php';
if ($usuario_nao_logado) {
    include '../overlays/pop_up_login.php';
    exit;
}
include 'menu_pg_inicial.php';

// Verificar se há mensagens de pop-up na sessão
if (isset($_SESSION['popup_message'])) {
    $titulo = $_SESSION['titulo'];
    $texto = $_SESSION['popup_message'];

    // Verificar se é sucesso
    if ($_SESSION['type'] == 'success') {
        $sucesso = true;
    }
    include '../overlays/pop_up_erro.php';

    // Limpar a sessão
    unset($_SESSION['titulo']);
    unset($_SESSION['popup_message']);
    unset($_SESSION['type']);
}

$query = "SELECT
            produto.id_produto,
            produto.id_categoria,
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

$query = $con->prepare($query);
$query->bind_param("i", $id_cliente);
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Página Favoritos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/cliente/pg_favoritos.css">
</head>

<body>
    <div class="container_pg_favoritos">
        <div class="seta_titulo_pg_favoritos">
            <a class="btn_voltar_favoritos" href="#" onclick="window.history.back(); return false;">
                <i class="bi bi-chevron-left"></i>
            </a>
        <h2 class="h2_pg_favoritos">Favoritos</h2>
    </div>
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
                    $id_categoria = $row['id_categoria'];
                    include 'card_favoritos.php';
                }
                $query->close();
                ?>
            </div>
        </div>
    </div>
</body>

</html>
<?php include 'footer_cliente.php'; ?>