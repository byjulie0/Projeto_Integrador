<?php
require_once(__DIR__ . "/../../model/DB/conexao.php");

if (isset($_POST['toggle_produto'])) {
    $id = intval($_POST['id_produto']);
    $statusAtual = intval($_POST['status_atual']);
    $novoStatus = $statusAtual ? 0 : 1;

    mysqli_query($con, "UPDATE produto SET produto_ativo = $novoStatus WHERE id_produto = $id");

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

$id = $p['id_produto'];
$status = $p['produto_ativo'];

$icone = $status ? 'fa-toggle-off' : 'fa-toggle-on';
$ariaPressed = $status ? 'false' : 'true';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toogle Ativar-Inativar </title>
    <script defer src="../../view/js/adm/toogle.js"></script>
    <link rel="stylesheet" href="../../view/public/css/adm/toogle.css">
</head>
<body>
    <form method="POST" style="display:inline;">
        <input type="hidden" name="id_produto" value="<?= $id ?>">
        <input type="hidden" name="status_atual" value="<?= $status ?>">
        <button type="submit" name="toggle_produto" class="icon-toggle-btn" aria-pressed="<?= $ariaPressed ?>">
            <i class="fa-solid <?= $icone ?>"></i>
        </button>
    </form>
</body>
</html>
