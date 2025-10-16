<?php
include '../../model/DB/conexao.php';


$busca = isset($_POST['busca']) ? trim($_POST['busca']) : '';
$inativos = isset($_POST['inativos']) ? (int)$_POST['inativos'] : 0;


$sql = "SELECT
            p.id_produto,
            p.prod_nome AS produto,
            c.cat_nome AS categoria,
            s.subcat_nome AS subcategoria,
            p.valor AS preco,
            p.produto_ativo
        FROM produto p
        LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
        LEFT JOIN subcategoria s ON p.id_subcategoria = s.id_subcategoria";


$where = [];


if ($inativos === 1) {
    $where[] = "p.produto_ativo = 1"; 
} elseif ($inativos === 2) {
    $where[] = "p.produto_ativo = 0"; 
}


if (!empty($busca)) {
    $busca_esc = $con->real_escape_string($busca);
    $where[] = "p.prod_nome LIKE '$busca_esc%'";
}

if (count($where) > 0) {
    $sql .= " WHERE " . implode(' AND ', $where);
}


$sql .= " ORDER BY p.prod_nome ASC";


$result = $con->query($sql);

$produtos = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($produtos);
exit;
