<?php
require_once(__DIR__ . "/../../model/DB/conexao.php");

$q = isset($_GET['q']) ? $con->real_escape_string($_GET['q']) : '';

if ($q != "") {
    $sql = "SELECT id_produto, prod_nome, valor 
            FROM produto 
            WHERE prod_nome LIKE '%$q%' 
            LIMIT 10";

    $result = $con->query($sql);

    if (!$result) {
        die("Erro na consulta: " . $con->error);
    }

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='item'>
                    <strong>".$row['prod_nome']."</strong> - R$ ".number_format($row['valor'],2,",",".").
                 "</div>";
        }
    } else {
        echo "<div class='item'>Nenhum produto encontrado.</div>";
    }
}
?>
