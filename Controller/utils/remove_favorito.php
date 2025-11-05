<?php include 'sessao_ativa.php';

if (!isset(($_SESSION['id_cliente']))) {
    header("Location: ../cliente/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $id_cliente = $_SESSION["id_cliente"];
    $id = $_GET['id'];

        $sql = "DELETE FROM favorito WHERE id = ?";
        $query = $con->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();
        $query->close();
        header("Location: ../cliente/pg_favoritos.php");
        exit;
    }
$con->close();
?>