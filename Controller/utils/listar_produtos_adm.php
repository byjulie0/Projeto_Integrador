<?php
require_once(__DIR__ . "/../../model/DB/conexao.php");

$sql = "SELECT 
            p.id_produto,
            p.prod_nome AS produto,
            c.cat_nome AS categoria,
            s.subcat_nome AS subcategoria,
            p.valor AS preco,
            p.produto_ativo
        FROM produto p
        LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
        LEFT JOIN subcategoria s ON p.id_subcategoria = s.id_subcategoria
        ORDER BY p.prod_nome ASC";

$result = $con->query($sql);

$produtos = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }
}

?>