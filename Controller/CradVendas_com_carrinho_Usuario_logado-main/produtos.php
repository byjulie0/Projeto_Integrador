<?php
include "db.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;}
$user_id = (int) $_SESSION['user_id']; // pega o ID do usuário logado

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 200px;
            margin: 10px;
            display: inline-block;
            text-align: center;
            padding: 10px;
        }
        .card img { width: 100%; height: 150px; object-fit: cover; }
        .btn { display: block; margin-top: 10px; padding: 8px; background: green; color: #fff; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h1>
    <a href="carrinho.php" style="float:right; margin:10px;">🛒 Ver Carrinho</a>
    <a href="logout.php" style="float:right; margin:10px;">Sair</a>
    <div style="clear:both;"></div>

    <?php
    $sql = "SELECT * FROM produtos";
    $result = $mysqli->query($sql);

    while ($row = $result->fetch_assoc()):
    ?>
        <div class="card">
            <img src="<?php echo $row['imagem']; ?>" alt="<?php echo $row['nome']; ?>">
            <h3><?php echo $row['nome']; ?></h3>
            <p>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></p>
            <a class="btn" href="salvar_carrinho.php?id=<?php echo $row['id']; ?>">Adicionar ao carrinho</a>
        </div>
    <?php endwhile; ?>
</body>
</html>
