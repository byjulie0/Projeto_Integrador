<?php
    include 'menu_pg_inicial.php';
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
        <div class="titulo-container_categoria_produtos">
            <a class="btn-voltar" href="#" onclick="window.history.back(); return false;">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <h2 class="h2_categoria_produtos">Produtos</h2>
        </div>
        <div class="filtros_container_categoria_produtos">
            <span class="filtros_titulo_categoria_produtos">Classificar por:</span>
            <button class="filtro_btn_produtos" onclick="filtrar('alimentos')">Alimentos</button>
            <button class="filtro_btn_produtos" onclick="filtrar('acessorios')">Acessórios</button>
            <button class="filtro_btn_produtos" onclick="filtrar('ferramentas')">Ferramentas</button>
            <button class="filtro_btn_produtos" onclick="filtrar('maquinarios')">Maquinários</button>
            <select class="filtro_select_categoria_produtos" onchange="filtrar(this.value)">
                <option value="preco_categoria_produtos">Preço</option>
                <option value="menor_preco">Menor Preço</option>
                <option value="maior_preco">Maior Preço</option>
            </select>
        </div>
        <div class="lotes_wrapper_categoria_produtos">
            <div class="lotes_container_categoria_produtos" id="lotesContainer">
                <?php 
                $lotes = [
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "380 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "24 meses", "preco" => "5.200,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "420 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "28 meses", "preco" => "5.800,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "350 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "22 meses", "preco" => "4.900,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "400 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "26 meses", "preco" => "5.500,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "380 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "24 meses", "preco" => "5.200,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "420 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "28 meses", "preco" => "5.800,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "350 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "22 meses", "preco" => "4.900,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "400 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "26 meses", "preco" => "5.500,00"],
                    ["imagem" => "../../view/public/imagens/nelore1.webp", "peso" => "400 kg", "raca" => "Nelore", "genealogia" => "PO", "idade" => "26 meses", "preco" => "5.500,00"],
                ];
                foreach ($lotes as $lote) { ?>
                    <div class="lote_card_categoria_produtos">
                        <img src="<?php echo $lote['imagem']; ?>" alt="Lote de Produtos">
                        <div class="info_grid_categoria_produtos">
                            <p>Peso:</p>
                            <p><?php echo $lote['peso']; ?></p>
                            <p>Raça:</p>
                            <p><?php echo $lote['raca']; ?></p>
                            <p>Genealogia:</p>
                            <p><?php echo $lote['genealogia']; ?></p>
                            <p>Idade:</p>
                            <p><?php echo $lote['idade']; ?></p>
                            <p class="preco">R$ <?php echo $lote['preco']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <button class="nav_button_categoria_produtos next" onclick="navegarLotes(1)">❯</button>
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
            const container = document.getElementById('lotesContainer');
            const scrollAmount = 300;
            container.scrollBy({
                left: direcao * scrollAmount,
                behavior: 'smooth'
            });
        }
    </script>

    <footer>
        <?php
            include 'footer_cliente.php';
        ?>
    </footer>
</body>
</html>