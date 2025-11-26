<?php

function listar_produtos() {
    include '../../model/DB/conexao.php';

    $status = $_GET['status'] ?? 'todos';
    $busca  = $_GET['busca'] ?? '';

    $sql = "SELECT
                p.id_produto,
                p.prod_nome AS produto,
                c.cat_nome AS categoria,
                s.subcat_nome AS subcategoria,
                p.valor AS preco,
                p.produto_ativo,
                p.quant_estoque
            FROM produto p
            LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
            LEFT JOIN subcategoria s ON p.id_subcategoria = s.id_subcategoria";

    $where = [];

    if ($status === 'ativos') {
        $where[] = "p.produto_ativo = 1";
    } elseif ($status === 'inativos') {
        $where[] = "p.produto_ativo = 0";
    }

    if (!empty($busca)) {
        $busca_esc = $con->real_escape_string($busca);
        $where[] = "(p.prod_nome LIKE '%$busca_esc%')";
    }

    if (!empty($where)) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }

    $sql .= " ORDER BY p.prod_nome ASC";

    $result = $con->query($sql);

    $produtos = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
        }
    }

    return $produtos;
}
