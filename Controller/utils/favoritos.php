<?php
session_start();
require_once '../../model/DB/conexao.php';

// if (!isset($_SESSION['id_cliente'])) {
//     header("Location: login.php");
//     exit;
// }

$id_cliente = $_SESSION['id_cliente'];
// $id_produto = $_POST['id_produto'] ?? null;

if ($id_cliente ){
    // Verifica se o produto já está nos favoritos
    $sql = "select * from favorito join produto on produto_id_produto = id_produto join cliente on cliente_id_cliente = id_cliente join subcategoria on subcategoria.id_subcategoria = produto.id_subcategoria where cliente_id_cliente = {$id_cliente};";
    $stmt = mysqli_query($con,$sql);}

    while ($row = mysqli_fetch_array($stmt)):
    ?>
<div class="lote-card">
    <a href="detalhes_produto.php?id=<?= $row["produto_id_produto"] ?>">
     <?echo  "../../View/Public/".$imagem ?>

        <img src="../../View/Public/<?= $imagem ?>" alt="Imagem do Animal">
        <div class="info-grid">
            <p>Nome:</p><p><?= $row["prod_nome"] ?></p>
            <p>Peso:</p><p><?= $row["peso"]  ?></p>
            <p>Raça:</p><p><?= $row["subcat_nome"]  ?></p>
            <p>Idade:</p><p><?= $row["idade"]  ?></p>
            <p class="preco">R$ <?= $row["valor"]  ?></p>
        </div>
        <div class="stars-pag-fav"><a href="#">★ Favorito</a></div>
    </a>
</div>
    <?php endwhile; ?>

   




     <
    // if ($stmt->rowCount() > 0) {
    //     // Remove dos favoritos
    //     $sql = "DELETE FROM favorito WHERE cliente_id_cliente = ? AND produto_id_produto = ?";
    //     $stmt = $pdo->prepare($sql);
    //     $stmt->execute([$id_cliente, $id_produto]);
    //     $msg = "Produto removido dos favoritos!";
    // } else {
    //     // Adiciona aos favoritos
    //     $sql = "INSERT INTO favorito (cliente_id_cliente, produto_id_produto) VALUES (?, ?)";
    //     $stmt = $pdo->prepare($sql);
    //     $stmt->execute([$id_cliente, $id_produto]);
    //     $msg = "Produto adicionado aos favoritos!";
    // }

    header("Location: detalhes_produto.php?id=$id_produto&msg=" . urlencode($msg));


?>

