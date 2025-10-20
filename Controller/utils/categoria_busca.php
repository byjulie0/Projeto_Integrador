<?php
include '../../model/DB/conexao.php';

// Obter parâmetros
$id_categoria = $_GET['id_categoria'] ?? 0;
$filtro = $_GET['classificar'] ?? '';

// Validar categoria
if (!$id_categoria) {
    die("Categoria não especificada");
}

// Buscar nome da categoria
$cat_query = $con->query("SELECT cat_nome FROM categoria WHERE id_categoria = $id_categoria");
$categoria = $cat_query->fetch_assoc();
$nome_categoria = $categoria['cat_nome'] ?? 'Categoria';

// Query base para produtos
$sql = "SELECT p.*, s.subcat_nome, c.cat_nome
        FROM produto p
        LEFT JOIN subcategoria s ON p.id_subcategoria = s.id_subcategoria
        LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
        WHERE p.id_categoria = $id_categoria AND p.produto_ativo = 1";

// Aplicar filtros específicos por categoria
switch ($id_categoria) {
    case 5: // Produtos Gerais
        switch ($filtro) {
            case 'racao_suplementos':
                $sql .= " AND p.id_subcategoria = 23";
                break;
            case 'medicamentos':
                $sql .= " AND p.id_subcategoria = 24";
                break;
            case 'higiene_cuidado':
                $sql .= " AND p.id_subcategoria = 25";
                break;
            case 'equipamentos':
                $sql .= " AND p.id_subcategoria = 26";
                break;
            case 'suplementos_nutricionais':
                $sql .= " AND p.id_subcategoria = 27";
                break;
        }
        break;

    case 1: // Bovinos
    case 2: // Equinos
    case 3: // Galináceos
        // Filtros por subcategoria para animais
        if (is_numeric($filtro) && $filtro > 0) {
            $sql .= " AND p.id_subcategoria = $filtro";
        }
        break;

    case 4: // Campeões
        // Filtros específicos para campeões
        break;
}

// Ordenação
switch ($filtro) {
    case 'menor_preco':
        $sql .= " ORDER BY p.valor ASC";
        break;
    case 'maior_preco':
        $sql .= " ORDER BY p.valor DESC";
        break;
    case 'preco':
    default:
        $sql .= " ORDER BY p.prod_nome ASC";
        break;
}

$result = $con->query($sql);

// Buscar subcategorias para a categoria atual
$subcategorias_query = $con->query("SELECT id_subcategoria, subcat_nome FROM subcategoria WHERE id_categoria = $id_categoria");
$subcategorias = [];
while ($sub = $subcategorias_query->fetch_assoc()) {
    $subcategorias[] = $sub;
}
?>