<?php include 'menu_pg_inicial.php';?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Categorias dos Equinos</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../view/public/css/cliente/categoria_equinos.css">
</head>
<body class="body_categoria_equinos">
    <div class="container_categoria_equinos">
        <div class="titulo_categoria_equinos">
            <a class="btn_voltar" href="#" onclick="window.history.back(); return false;">
                <i class="bi bi-chevron-left"></i>
            </a>
            <h2 class="h2_categoria_equinos">Equinos</h2>
        </div>
        <div class="filtros_categoria_equinos">
            <span class="filtros_titulo">Classificar por:</span>
            <button class="filtro_btn" onclick="filtrar('arabe')">Árabe</button>
            <button class="filtro_btn" onclick="filtrar('draft_belga')">Draft Belga</button>
            <button class="filtro_btn" onclick="filtrar('mustang')">Mustang</button>
            <button class="filtro_btn" onclick="filtrar('paint_horse')">Paint Horse</button>
            <button class="filtro_btn" onclick="filtrar('percheron')">Percheron</button>
            <button class="filtro_btn" onclick="filtrar('puro_sangue_ingles')">Puro Sangue Inglês</button>
            <select class="filtro_select" onchange="filtrar(this.value)">
                <option value="preco">Preço</option>
                <option value="menor_preco">Menor Preço</option>
                <option value="maior_preco">Maior Preço</option>
            </select>
        </div>

        <div class="lotes_geral">
            <div class="lotes_container" id="lotesContainer_equinos">
                <?php
                $lotes = [
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "nome" => "Cavalo", "peso" => "380 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "24 meses", "preco" => "5.200,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "nome" => "Cavalo", "peso" => "420 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "28 meses", "preco" => "5.800,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "nome" => "Cavalo", "peso" => "350 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "22 meses", "preco" => "4.900,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "nome" => "Cavalo", "peso" => "400 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "26 meses", "preco" => "5.500,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "nome" => "Cavalo", "peso" => "380 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "24 meses", "preco" => "5.200,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "nome" => "Cavalo", "peso" => "420 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "28 meses", "preco" => "5.800,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "nome" => "Cavalo", "peso" => "350 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "22 meses", "preco" => "4.900,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "nome" => "Cavalo", "peso" => "400 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "26 meses", "preco" => "5.500,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "nome" => "Cavalo", "peso" => "400 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "26 meses", "preco" => "5.500,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "nome" => "Cavalo", "peso" => "400 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "26 meses", "preco" => "5.500,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "nome" => "Cavalo", "peso" => "400 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "26 meses", "preco" => "5.500,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "nome" => "Cavalo", "peso" => "400 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "26 meses", "preco" => "5.500,00"],
                ];
                foreach ($lotes as $item) { 
                    $imagem = $item['imagem'];
                    $nome = $item['nome'];
                    $peso = $item['peso'];
                    $raca = $item['raca'];
                    $genealogia = $item['genealogia'];
                    $idade = $item['idade'];
                    $preco = $item['preco'];
                    include 'card_telas.php';
                }
                ?>
            </div>
            <button class="nav_button next" onclick="navegarLotes(1)">❯</button>
        </div>
    </div>

    <script>
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
            const container = document.getElementById('lotesContainer_equinos');
            const scrollAmount = 300;
            container.scrollBy({
                left: direcao * scrollAmount,
                behavior: 'smooth'
            });
        }
    </script>

</body>
</html>
<?php include 'footer_cliente.php';?>