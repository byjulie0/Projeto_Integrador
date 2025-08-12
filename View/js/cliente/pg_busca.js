document.addEventListener('DOMContentLoaded', function() {
    // Configuração dos filtros
    const botoesFiltro = document.querySelectorAll('.filtro-btn');
    const selectFiltro = document.querySelector('.filtro-select');
    const botaoNavegar = document.querySelector('.nav-button.next');
    
    // Adiciona eventos aos botões de filtro
    botoesFiltro.forEach(botao => {
        botao.addEventListener('click', function() {
            const tipoFiltro = this.getAttribute('data-filtro');
            filtrar(tipoFiltro);
        });
    });
    
    // Adiciona evento ao select de filtro
    selectFiltro.addEventListener('change', function() {
        filtrar(this.value);
    });
    
    // Adiciona evento ao botão de navegação
    botaoNavegar.addEventListener('click', function() {
        navegarLotes(1);
    });
    
    // Função de filtragem
    function filtrar(tipo) {
        window.location.href = "?classificar=" + tipo;
    }
    
    // Função de navegação entre lotes
    function navegarLotes(direcao) {
        const container = document.getElementById('lotesContainer');
        const scrollAmount = 300;
        container.scrollBy({
            left: direcao * scrollAmount,
            behavior: 'smooth'
        });
    }
    
    // Função de navegação entre páginas (se necessário)
    function navegarPagina(direcao) {
        let paginaAtual = parseInt(document.querySelector(".pagina-atual")?.innerText);
        if (paginaAtual) {
            let novaPagina = paginaAtual + direcao;
            if (novaPagina > 0) {
                document.querySelector(".pagina-atual").innerText = novaPagina;
            }
        }
    }
});