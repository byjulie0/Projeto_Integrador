<?php
include '../utils/categoria_busca.php';
include 'menu_pg_inicial.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($nome_categoria); ?> - John Rooster</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../view/public/css/cliente/categoria_produtos.css">
</head>
<body class="body_categoria_produtos">
    <div class="container_categoria_produtos">
        <div class="titulo_categoria_produtos">
            <a class="btn_voltar" href="pg_inicial_cliente.php">
                <i class="bi bi-chevron-left"></i>
            </a>
            <h2 class="h2_categoria_produtos"><?php echo htmlspecialchars($nome_categoria); ?>
                <?php if ($filtro): ?>
                    <span style="font-size: 0.8em; color: #666;">
                        - <?php echo obterNomeFiltro($filtro, $id_categoria); ?>
                    </span>
                <?php endif; ?>
            </h2>
        </div>
        <div class="filtros_container_categoria_produtos">
            <span class="filtros_titulo">Filtrar por:</span>

            <?php if ($id_categoria == 5): ?>
                <!-- Filtros específicos para Produtos Gerais -->
                <button class="filtro_btn <?php echo $filtro == 'racao_suplementos' ? 'active' : ''; ?>"
                    onclick="filtrar('racao_suplementos')">
                    Rações e Suplementos
                </button>
                <button class="filtro_btn <?php echo $filtro == 'medicamentos' ? 'active' : ''; ?>"
                    onclick="filtrar('medicamentos')">
                    Medicamentos
                </button>
                <button class="filtro_btn <?php echo $filtro == 'higiene_cuidado' ? 'active' : ''; ?>"
                    onclick="filtrar('higiene_cuidado')">
                    Higiene e Cuidado
                </button>
                <button class="filtro_btn <?php echo $filtro == 'equipamentos' ? 'active' : ''; ?>"
                    onclick="filtrar('equipamentos')">
                    Equipamentos
                </button>
                <button class="filtro_btn <?php echo $filtro == 'suplementos_nutricionais' ? 'active' : ''; ?>"
                    onclick="filtrar('suplementos_nutricionais')">
                    Suplementos Nutricionais
                </button>
            <?php else: ?>
                <!-- Filtros por subcategoria para outras categorias -->
                <button class="filtro_btn <?php echo $filtro == '' ? 'active' : ''; ?>" onclick="filtrar('')">
                    Todos
                </button>
                <?php foreach ($subcategorias as $sub): ?>
                    <button class="filtro_btn <?php echo $filtro == $sub['id_subcategoria'] ? 'active' : ''; ?>"
                        onclick="filtrar(<?php echo $sub['id_subcategoria']; ?>)">
                        <?php echo htmlspecialchars($sub['subcat_nome']); ?>
                    </button>
                <?php endforeach; ?>
            <?php endif; ?>

            <span class="filtros_titulo" style="margin-left: 20px;">Ordenar por:</span>
            <select class="filtro_select" onchange="filtrar(this.value)">
                <option value="preco">Preço</option>
                <option value="menor_preco">Menor Preço</option>
                <option value="maior_preco">Maior Preço</option>
            </select>

            <?php if ($filtro): ?>
                <button class="filtro_btn limpar" onclick="limparFiltros()">
                    <i class="bi bi-x-circle"></i> Limpar Filtros
                </button>
            <?php endif; ?>
        </div>
        <div class="lotes_geral">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php include 'card_telas.php'; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <p class='sem-produtos'>Nenhum produto encontrado em <?php echo htmlspecialchars($nome_categoria); ?>
                    <?php if ($filtro): ?>
                        para "<?php echo obterNomeFiltro($filtro, $id_categoria); ?>"
                    <?php endif; ?>
                </p>

                <?php if ($filtro): ?>
                    <div style="text-align: center; margin-top: 20px;">
                        <button class="filtro_btn limpar" onclick="limparFiltros()" style="margin: 0 auto;">
                            <i class="bi bi-arrow-counterclockwise"></i> Ver Todos os Produtos
                        </button>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <button class="nav_button next" onclick="navegarLotes(1)">❯</button>
    </div>

    <script>
        function filtrar(tipo) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('classificar', tipo);
            window.location.href = '?' + urlParams.toString();
        }

        function limparFiltros() {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.delete('classificar');
            window.location.href = '?' + urlParams.toString();
        }
        
        function navegarLotes(direcao) {
            const container = document.getElementById('lotesContainer_produtos');
            const scrollAmount = 300;
            container.scrollBy({
                left: direcao * scrollAmount,
                behavior: 'smooth'
            });
        }
    </script>
</body>

<?php include 'footer_cliente.php'; ?>

</html>

<?php
function obterNomeFiltro($filtro, $id_categoria)
{
    // Mapeamento para Produtos Gerais
    if ($id_categoria == 5) {
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
        return $nomes[$filtro] ?? ucfirst(str_replace('_', ' ', $filtro));
    }

    // Para outras categorias, buscar nome da subcategoria
    if (is_numeric($filtro)) {
        global $con;
        $sub_query = $con->query("SELECT subcat_nome FROM subcategoria WHERE id_subcategoria = $filtro");
        if ($sub = $sub_query->fetch_assoc()) {
            return $sub['subcat_nome'];
        }
    }

    return ucfirst(str_replace('_', ' ', $filtro));
}
?>
