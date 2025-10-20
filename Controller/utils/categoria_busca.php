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
        switch ($filtro) {
            case '1':
                $sql .= " AND p.id_subcategoria = 1"; // Angus
                break;
            case '2':
                $sql .= " AND p.id_subcategoria = 2"; // Brahman
                break;
            case '3':
                $sql .= " AND p.id_subcategoria = 3"; // Brangus
                break;
            case '4':
                $sql .= " AND p.id_subcategoria = 4"; // Hereford
                break;
            case '5':
                $sql .= " AND p.id_subcategoria = 5"; // Nelore
                break;
            case '6':
                $sql .= " AND p.id_subcategoria = 6"; // Senepol
                break;
        }
        break;

    case 2: // Equinos
        switch ($filtro) {
            case '7':
                $sql .= " AND p.id_subcategoria = 7"; // Árabe
                break;
            case '8':
                $sql .= " AND p.id_subcategoria = 8"; // Draft Belga
                break;
            case '9':
                $sql .= " AND p.id_subcategoria = 9"; // Mustang
                break;
            case '10':
                $sql .= " AND p.id_subcategoria = 10"; // Paint Horse
                break;
            case '11':
                $sql .= " AND p.id_subcategoria = 11"; // Percheron
                break;
            case '12':
                $sql .= " AND p.id_subcategoria = 12"; // Puro Sangue Inglês
                break;
        }
        break;

    case 3: // Galináceos
        switch ($filtro) {
            case '13':
                $sql .= " AND p.id_subcategoria = 13"; // Legorne
                break;
            case '14':
                $sql .= " AND p.id_subcategoria = 14"; // Léon
                break;
            case '15':
                $sql .= " AND p.id_subcategoria = 15"; // Orpington
                break;
            case '16':
                $sql .= " AND p.id_subcategoria = 16"; // Playmouth Rock
                break;
            case '17':
                $sql .= " AND p.id_subcategoria = 17"; // Rhode Island Red
                break;
        }
        break;

    case 4: // Campeões
        switch ($filtro) {
            case '18':
                $sql .= " AND p.id_subcategoria = 18"; // Campeão júnior
                break;
            case '19':
                $sql .= " AND p.id_subcategoria = 19"; // Grande campeão
                break;
            case '20':
                $sql .= " AND p.id_subcategoria = 20"; // Melhor apresentação
                break;
            case '21':
                $sql .= " AND p.id_subcategoria = 21"; // Melhor desempenho
                break;
            case '22':
                $sql .= " AND p.id_subcategoria = 22"; // Melhor exemplar
                break;
        }
        break;

    default:
        // Para outras categorias não mapeadas
        if (is_numeric($filtro) && $filtro > 0) {
            $sql .= " AND p.id_subcategoria = $filtro";
        }
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