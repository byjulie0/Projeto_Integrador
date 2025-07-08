function initCarrossel() {
    const container = document.getElementById('carrossel-cards');
    if (!container) return;

    const cards = container.querySelectorAll('.card_cliente');
    const leftArrow = document.getElementById('arrow-esquerda');
    const rightArrow = document.getElementById('arrow-direita');

    // Verifica se existem cards e setas
    if (cards.length === 0 || !leftArrow || !rightArrow) return;

    // Configurações do carrossel
    const cardWidth = cards[0].offsetWidth;
    const gap = parseInt(getComputedStyle(container).gap) || 15;
    const scrollAmount = cardWidth + gap;
    let isScrolling = false;

    // Função para rolar suavemente
    function smoothScroll(amount) {
        if (isScrolling) return;
        
        isScrolling = true;
        container.scrollBy({
            left: amount,
            behavior: 'smooth'
        });

        // Libera o scroll após a animação
        setTimeout(() => {
            isScrolling = false;
        }, 500);
    }

    // Event listeners para as setas
    leftArrow.addEventListener('click', () => smoothScroll(-scrollAmount));
    rightArrow.addEventListener('click', () => smoothScroll(scrollAmount));

    // Atualiza a visibilidade das setas
    function updateArrows() {
        const maxScroll = container.scrollWidth - container.clientWidth;
        leftArrow.style.display = container.scrollLeft > 0 ? 'flex' : 'none';
        rightArrow.style.display = container.scrollLeft < maxScroll - 1 ? 'flex' : 'none';
    }

    // Atualiza setas durante scroll
    container.addEventListener('scroll', updateArrows);

    // Inicialização
    updateArrows();
}

// Inicializa quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', initCarrossel);

// Verifica periodicamente se o carrossel foi carregado via include PHP
(function checkForCarrossel() {
    // Se o container existir mas as setas ainda não estiverem configuradas
    if (document.getElementById('carrossel-cards') && 
        !document.getElementById('arrow-esquerda').hasAttribute('data-initialized')) {
        initCarrossel();
        document.getElementById('arrow-esquerda').setAttribute('data-initialized', 'true');
        document.getElementById('arrow-direita').setAttribute('data-initialized', 'true');
    }
    
    // Continua verificando a cada 100ms por até 5 segundos
    if (typeof checkForCarrossel.interval === 'undefined') {
        checkForCarrossel.interval = setInterval(checkForCarrossel, 100);
        setTimeout(() => {
            clearInterval(checkForCarrossel.interval);
        }, 5000);
    }
})();