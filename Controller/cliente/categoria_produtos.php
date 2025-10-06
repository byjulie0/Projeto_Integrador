<?php
include 'menu_pg_inicial.php';
include '../../model/DB/conexao.php';

$query = "SELECT * FROM produto WHERE id_categoria = 5;";
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
            <h2 class="h2_categoria_produtos">Produtos</h2>
        </div>

        <div class="lotes_geral"><?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()): ?>
                    <div class="lotes_container"><?php
                    $legenda = $row['prod_nome'];
                    $imagem = $row['path_img'];
                    $nome = $row['prod_nome'];
                    $valor = number_format($row['valor'], 2, ',', '.');
                    include 'card_telas.php'; ?>
                    </div>
                    <?php endwhile;
        } else {
            echo "<p>Nenhum produto encontrado para esta categoria</p>";
        } ?>

</div>
<button class="nav_button next" onclick="navegarLotes(1)">❯</button>
</div>

<footer>
    <?php
        include 'footer_cliente.php';
        ?>
    </footer>
</body>
</html>

<!-- <div class="filtros_container_categoria_produtos">
    <span class="filtros_titulo">Classificar por:</span>
    <button class="filtro_btn" onclick="filtrar('alimentos')">Alimentos</button>
    <button class="filtro_btn" onclick="filtrar('acessorios')">Acessórios</button>
    <button class="filtro_btn" onclick="filtrar('ferramentas')">Ferramentas</button>
    <button class="filtro_btn" onclick="filtrar('maquinarios')">Maquinários</button>
    <select class="filtro_select" onchange="filtrar(this.value)">
        <option value="preco">Preço</option>
        <option value="menor_preco">Menor Preço</option>
        <option value="maior_preco">Maior Preço</option>
    </select>
</div> -->

<!-- <script>
        function filtrar(tipo) {
            window.location.href = "?classificar=" + tipo;
        }

        function navegarPagina(direcao) {
            let paginaAtual = parseInt(document.querySelector(".pagina-atual").innerText);
            let novaPagina = paginaAtual + direcao;
            if (novaPagina > 0) {
                document.querySelector(".pagina-atual").innerText = novaPagina;
            }
        }

        function navegarLotes(direcao) {
            const container = document.getElementById('lotesContainer_produtos');
            const scrollAmount = 300;
            container.scrollBy({
                left: direcao * scrollAmount,
                behavior: 'smooth'
            });
        }
    </script> -->