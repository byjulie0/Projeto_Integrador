<?php
include '../../model/DB/conexao.php';

try {
    if (!isset($con)) {
        throw new Exception("Conexão com o banco de dados não estabelecida.");
    }

    $sql = "
        SELECT 
            p.id_pedido,
            p.data_pedido,
            p.status_pedido,
            c.cliente_nome,
            c.cpf_cnpj,
            COALESCE(SUM(pr.valor * i.qtd_produto), 0) AS valor_pedido
        FROM pedido p
        INNER JOIN cliente c ON p.id_cliente = c.id_cliente
        LEFT JOIN item i ON p.id_pedido = i.id_pedido
        LEFT JOIN produto pr ON i.id_produto = pr.id_produto
        GROUP BY p.id_pedido, p.data_pedido, p.status_pedido, c.cliente_nome, c.cpf_cnpj
        ORDER BY p.data_pedido DESC
    ";

    $resultado = $con->query($sql);

    $pedidos = [];

    if ($resultado && $resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $pedidos[] = $row;
        }
    }

} catch (Exception $e) {
    echo 'Erro ao listar pedidos: ' . $e->getMessage();
    $pedidos = [];
}
?>

