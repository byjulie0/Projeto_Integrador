function initCarrossel() {
    const container = document.getElementById('carrossel-cards3');
    if (!container) return;
  
    const cards = container.querySelectorAll('.card_cliente');
    const leftArrow3 = document.getElementById('arrow-esquerda3');
    const rightArrow3 = document.getElementById('arrow-direita3');
  
    if (cards.length === 0 || !leftArrow3 || !rightArrow3) return;

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
    leftArrow3.addEventListener('click', () => smoothScroll(-scrollAmount));
    rightArrow3.addEventListener('click', () => smoothScroll(scrollAmount));
    function updateArrows() {
        const maxScroll = container.scrollWidth - container.clientWidth;
        leftArrow3.style.display = container.scrollLeft > 0 ? 'flex' : 'none';
        rightArrow3.style.display = container.scrollLeft < maxScroll - 1 ? 'flex' : 'none';
    }
  
    container.addEventListener('scroll', updateArrows);
  
    updateArrows();
  }
  
  document.addEventListener('DOMContentLoaded', initCarrossel);
  
  (function checkForCarrossel() {
    if (document.getElementById('carrossel-cards3') &&
        !document.getElementById('arrow-esquerda3').hasAttribute('data-initialized')) {
        initCarrossel();
        document.getElementById('arrow-esquerda3').setAttribute('data-initialized', 'true');
        document.getElementById('arrow-direita3').setAttribute('data-initialized', 'true');
    }
    
    if (typeof checkForCarrossel.interval === 'undefined') {
        checkForCarrossel.interval = setInterval(checkForCarrossel, 100);
        setTimeout(() => {
            clearInterval(checkForCarrossel.interval);
        }, 5000);
    }
  })();