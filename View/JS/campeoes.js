function initCarrossel() {
    const container = document.getElementById('carrossel-cards3');
    if (!container) return;
  
    const cards = container.querySelectorAll('.card_cliente');
    const leftArrow2 = document.getElementById('arrow-esquerda3');
    const rightArrow2 = document.getElementById('arrow-direita3');
  
    if (cards.length === 0 || !leftArrow2 || !rightArrow2) return;

    const cardWidth = cards[0].offsetWidth;
    const gap = parseInt(getComputedStyle(container).gap) || 15;
    const scrollAmount = cardWidth + gap;
    let isScrolling = false;

    function smoothScroll(amount) {
        if (isScrolling) return;
        
        isScrolling = true;
        container.scrollBy({
            left: amount,
            behavior: 'smooth'
        });
  
        
        setTimeout(() => {
            isScrolling = false;
        }, 500);
    }
  
    leftArrow2.addEventListener('click', () => smoothScroll(-scrollAmount));
    rightArrow2.addEventListener('click', () => smoothScroll(scrollAmount));
  
    function updateArrows() {
        const maxScroll = container.scrollWidth - container.clientWidth;
        leftArrow2.style.display = container.scrollLeft > 0 ? 'flex' : 'none';
        rightArrow2.style.display = container.scrollLeft < maxScroll - 1 ? 'flex' : 'none';
    }
  
    container.addEventListener('scroll', updateArrows);
  
    updateArrows();
  }
  
  document.addEventListener('DOMContentLoaded', initCarrossel);
  
  (function checkForCarrossel() {
    if (document.getElementById('carrossel-cards') &&
        !document.getElementById('arrow-esquerda').hasAttribute('data-initialized')) {
        initCarrossel();
        document.getElementById('arrow-esquerda').setAttribute('data-initialized', 'true');
        document.getElementById('arrow-direita').setAttribute('data-initialized', 'true');
    }
    
    if (typeof checkForCarrossel.interval === 'undefined') {
        checkForCarrossel.interval = setInterval(checkForCarrossel, 100);
        setTimeout(() => {
            clearInterval(checkForCarrossel.interval);
        }, 5000);
    }
  })();