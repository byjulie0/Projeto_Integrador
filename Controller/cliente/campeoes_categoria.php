<?php 
    include 'menu_pg_inicial.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Rooster - Campeões</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../view/public/css/cliente.css">
</head>
<body class="body_pg_busca">
    <!-- Seção de resultados -->
    <div class="container_pagina_de_busca">
        <a class="btn-voltar" href="pg_inicial_cliente.php">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <h2 class="h2-pag-busca">Campeões</h2>
        <div class="filtros-container">
            <span class="filtros-titulo">Classificar por:</span>
            <button class="filtro-btn" onclick="filtrar('relevancia')">Bovino</button>
            <button class="filtro-btn" onclick="filtrar('mais_recente')">Equino</button>
            <button class="filtro-btn" onclick="filtrar('em_destaque')">Galináceo</button>
        </div>
        <div class="lotes-wrapper">
            <div class="lotes_container_pagina_de_busca" id="lotesContainer">
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
                    <div class="lote-card">
                        <img src="<?php echo $lote['imagem']; ?>" alt="Lote de Gado">
                        <div class="info-grid">
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
            <button class="nav-button next" onclick="navegarLotes(1)">❯</button>
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
