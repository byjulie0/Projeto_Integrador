<?php
include '../../model/DB/conexao.php'; 

try {
    // Consulta SQL com JOIN na tabela produto
    $sql = "
        SELECT 
            p.id_pedido,
            p.data_pedido,
            p.status_pedido,
            c.cliente_nome,
            c.cpf_cnpj,
            pr.prod_nome as nome_produto,
            pr.valor as valor_pedido
        FROM pedido p
        INNER JOIN cliente c ON p.cliente_id_cliente = c.id_cliente
        INNER JOIN produto pr ON p.id_produto = pr.id_produto
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