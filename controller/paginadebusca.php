<?php
include 'menu-pg-inicial.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Rooster - Busca</title>
    
    <!-- Importação de ícones -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Importação dos estilos -->
    <link rel="stylesheet" href="../view/public/css/paginadebusca.css">
</head>
<body>
    <!-- Seção de filtros e paginação -->
    <div class="filtros-paginacao-wrapper">
        <div class="filtros-container">
            <span class="filtros-titulo">Classificar por:</span>
            <button class="filtro-btn" onclick="filtrar('relevancia')">Relevância</button>
            <button class="filtro-btn" onclick="filtrar('mais_recente')">Mais Recente</button>
            <button class="filtro-btn" onclick="filtrar('em_destaque')">Em Destaque</button>
            <select class="filtro-select" onchange="filtrar(this.value)">
                <option value="preco">Preço</option>
                <option value="menor_preco">Menor Preço</option>
                <option value="maior_preco">Maior Preço</option>
            </select>
        </div>
        <!-- Paginação no canto superior direito -->
        <div class="paginacao-container">
            <span class="pagina-texto">Página</span>
            <button class="paginacao-btn" onclick="navegarPagina(-1)"><i class="fas fa-chevron-left"></i></button>
            <span class="pagina-atual">1</span>
            <button class="paginacao-btn" onclick="navegarPagina(1)"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
    
    <!-- Seção de resultados -->
    <div class="container_pagina_de_busca">
        <h2>Resultados</h2>
        <p>20 resultados encontrados para 'gado nelore'</p>

        <div class="lotes_container_pagina_de_busca">
            <?php 
            $lotes = [
                ["imagem" => "../view/public/imagens/nelore1.webp"],
                ["imagem" => "../view/public/imagens/nelore2.webp"],
                ["imagem" => "../view/public/imagens/nelore3.webp"],
                ["imagem" => "../view/public/imagens/nelore4.jpg"],
                ["imagem" => "../view/public/imagens/nelore1.webp"],
                ["imagem" => "../view/public/imagens/nelore2.webp"],
                ["imagem" => "../view/public/imagens/nelore3.webp"],
                ["imagem" => "../view/public/imagens/nelore4.jpg"],
                ["imagem" => "../view/public/imagens/nelore1.webp"],
                ["imagem" => "../view/public/imagens/nelore2.webp"],
                
            ];
            foreach ($lotes as $lote) { ?>
                <div class="lote-card">
                    <img src="<?php echo $lote['imagem']; ?>" alt="Lote de Gado">
                    <p>Peso: N/A</p>
                    <p>Raça: Nelore</p>
                    <p>Genealogia: N/A</p>
                    <p>Idade: N/A</p>
                    <p><strong>R$: 00,00</strong></p>
                    <button>Conferir</button>
                </div>
            <?php } ?>
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
    </script>

    <!-- Rodapé -->
    <footer>
        <?php include 'footer_cliente.php'; ?>
    </footer>
</body>
</html>
