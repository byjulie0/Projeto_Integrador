<?php
include 'menu_pg_inicial.php';
include '../../model/DB/conexao.php';

// Obter o parâmetro de filtro da URL
$filtro = isset($_GET['classificar']) ? $_GET['classificar'] : '';

// Query base para produtos da categoria 5 (Produtos Gerais)
$query = "SELECT p.*, s.subcat_nome 
          FROM produto p 
          LEFT JOIN subcategoria s ON p.id_subcategoria = s.id_subcategoria 
          WHERE p.id_categoria = 5";

// Aplicar filtros baseados no parâmetro
switch($filtro) {
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

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Categorias</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../view/public/css/cliente/categoria_produtos.css">
</head>

<body class="body_categoria_produtos">
    <div class="container_categoria_produtos">
        <div class="titulo_categoria_produtos">
            <a class="btn_voltar" href="#" onclick="window.history.back(); return false;">
                <i class="bi bi-chevron-left"></i>
            </a>
            <h2 class="h2_categoria_produtos">Produtos Gerais
                <?php if($filtro): ?>
                    <span style="font-size: 0.8em; color: #666;">
                        - <?php echo obterNomeFiltro($filtro); ?>
                    </span>
                <?php endif; ?>
            </h2>
        </div>

        <div class="filtros_container_categoria_produtos">
            <span class="filtros_titulo">Filtrar por:</span>
            <button class="filtro_btn <?php echo $filtro == 'racao_suplementos' ? 'active' : ''; ?>" onclick="filtrar('racao_suplementos')">
                Rações e Suplementos
            </button>
            <button class="filtro_btn <?php echo $filtro == 'medicamentos' ? 'active' : ''; ?>" onclick="filtrar('medicamentos')">
                Medicamentos
            </button>
            <button class="filtro_btn <?php echo $filtro == 'higiene_cuidado' ? 'active' : ''; ?>" onclick="filtrar('higiene_cuidado')">
                Higiene e Cuidado
            </button>
            <button class="filtro_btn <?php echo $filtro == 'equipamentos' ? 'active' : ''; ?>" onclick="filtrar('equipamentos')">
                Equipamentos
            </button>
            <button class="filtro_btn <?php echo $filtro == 'suplementos_nutricionais' ? 'active' : ''; ?>" onclick="filtrar('suplementos_nutricionais')">
                Suplementos Nutricionais
            </button>
            
            <span class="filtros_titulo" style="margin-left: 20px;">Ordenar por:</span>
            <select class="filtro_select" onchange="filtrar(this.value)">
                <option value="preco" <?php echo $filtro == 'preco' ? 'selected' : ''; ?>>Padrão</option>
                <option value="menor_preco" <?php echo $filtro == 'menor_preco' ? 'selected' : ''; ?>>Menor Preço</option>
                <option value="maior_preco" <?php echo $filtro == 'maior_preco' ? 'selected' : ''; ?>>Maior Preço</option>
            </select>
            
            <!-- Botão para limpar filtros -->
            <?php if($filtro): ?>
                <button class="filtro_btn limpar" onclick="limparFiltros()">
                    <i class="bi bi-x-circle"></i> Limpar Filtros
                </button>
            <?php endif; ?>
        </div>

        <div class="lotes_geral">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()): ?>
                    <div class="lotes_container">
                        <?php
                        $legenda = $row['prod_nome'];
                        $imagem = $row['path_img'];
                        $nome = $row['prod_nome'];
                        $valor = number_format($row['valor'], 2, ',', '.');
                        $subcategoria = $row['subcat_nome']; // Para possível uso no card
                        include 'card_telas.php';
                        ?>
                    </div>
                <?php endwhile;
            } else {
                echo "<p class='sem-produtos'>Nenhum produto encontrado ";
                if($filtro) {
                    echo "para " . obterNomeFiltro($filtro);
                }
                echo "</p>";
                
                // Se há filtro ativo, mostra opção para limpar
                if($filtro): ?>
                    <div style="text-align: center; margin-top: 20px;">
                        <button class="filtro_btn limpar" onclick="limparFiltros()" style="margin: 0 auto;">
                            <i class="bi bi-arrow-counterclockwise"></i> Ver Todos os Produtos
                        </button>
                    </div>
                <?php endif;
            }
            ?>
        </div>
        
        <button class="nav_button next" onclick="navegarLotes(1)">❯</button>
    </div>

    <script>
        function filtrar(tipo) {
            window.location.href = "?classificar=" + tipo;
        }

        function limparFiltros() {
            window.location.href = window.location.pathname; // Remove parâmetros da URL
        }

        function navegarLotes(direcao) {
            const container = document.querySelector('.lotes_geral');
            const scrollAmount = 300;
            container.scrollBy({
                left: direcao * scrollAmount,
                behavior: 'smooth'
            });
        }
    </script>

    <footer>
        <?php include 'footer_cliente.php'; ?>
    </footer>
</body>
</html>

<?php
// Função para obter o nome amigável do filtro
function obterNomeFiltro($filtro) {
    $nomes = [
        'racao_suplementos' => 'Rações e Suplementos',
        'medicamentos' => 'Medicamentos Veterinários',
        'higiene_cuidado' => 'Produtos de Higiene e Cuidado',
        'equipamentos' => 'Equipamentos e Utensílios',
        'suplementos_nutricionais' => 'Suplementos Nutricionais',
        'menor_preco' => 'Menor Preço',
        'maior_preco' => 'Maior Preço',
        'preco' => 'Padrão'
    ];
    
    return isset($nomes[$filtro]) ? $nomes[$filtro] : ucfirst(str_replace('_', ' ', $filtro));
}
?>