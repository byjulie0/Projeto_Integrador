<?php
// Obter o parâmetro de filtro da URL
$filtro = isset($_GET['classificar']) ? $_GET['classificar'] : '';

$query = "SELECT p.*, s.subcat_nome
          FROM produto p
          LEFT JOIN subcategoria s ON p.id_subcategoria = s.id_subcategoria
          WHERE p.id_categoria = 5 AND p.produto_ativo = 1";

switch ($filtro) {
    case 'racao_suplementos':
        $query .= " AND p.id_subcategoria = 23"; // Rações e suplementos alimentares
        break;
    case 'medicamentos':
        $query .= " AND p.id_subcategoria = 24"; // Medicamentos veterinários
        break;
    case 'higiene_cuidado':
        $query .= " AND p.id_subcategoria = 25"; // Produtos de higiene e cuidado
        break;
    case 'equipamentos':
        $query .= " AND p.id_subcategoria = 26"; // Equipamentos e utensílios
        break;
    case 'suplementos_nutricionais':
        $query .= " AND p.id_subcategoria = 27"; // Suplementos nutricionais e aditivos
        break;
    case 'menor_preco':
        $query .= " ORDER BY p.valor ASC";
        break;
    case 'maior_preco':
        $query .= " ORDER BY p.valor DESC";
        break;
    case 'preco':
    default:
        $query .= " ORDER BY p.prod_nome ASC"; // Ordem padrão
        break;
}

$result = $con->query($query);
?>