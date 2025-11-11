<?php
include '../../model/DB/conexao.php';

/**
 * Retorna uma lista aleatória de produtos.
 * @param mysqli $con Conexão ativa com o banco de dados.
 * @param int $limite Quantos produtos serão retornados (padrão: 10).
 * @return array Lista de produtos.
 */
function buscarProdutosAleatorios($con, $limite = 10) {
    // Garante que o resultado mude a cada acesso, mesmo dentro da mesma sessão
    $seed = microtime(true) * 1000000;
    mt_srand($seed);

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
            WHERE p.produto_ativo = 1
            ORDER BY RAND() 
            LIMIT $limite";

    $result = $con->query($sql);
    $produtos = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
        }
    }

    return $produtos;
}
?>
