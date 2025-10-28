<?php include 'sessao_ativa.php';

if (!isset(($_SESSION['id_cliente']))) {
    header("Location: ../cliente/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $id_cliente = $_SESSION["id_cliente"];
    $id_carrinho = $_GET['id_carrinho'];

        $sql = "DELETE FROM carrinho WHERE id_carrinho = ? AND id_cliente = ?";
        $query = $con->prepare($sql);
        $query->bind_param("ii", $id_carrinho, $id_cliente);
        $query->execute();
        $query->close();
        header("Location: ../cliente/carrinho.php");
        exit;
    }
$con->close();
?>