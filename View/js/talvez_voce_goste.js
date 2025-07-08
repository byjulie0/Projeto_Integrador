document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('carrossel-cards-talvez-voce-goste');
    const cards = container.querySelectorAll('.card_cliente');
    const leftArrow = document.getElementById('arrow-esquerda-talvez-voce-goste');
    const rightArrow = document.getElementById('arrow-direita-talvez-voce-goste');
  
    if (!container || cards.length === 0) return;
  
    const cardWidth = cards[0].offsetWidth;
    const gap = parseInt(getComputedStyle(container).gap) || 15;
    const scrollAmount = cardWidth + gap;
  
    leftArrow.addEventListener('click', () => {
      container.scrollBy({
        left: -scrollAmount,
        behavior: 'smooth'
      });
    });
  
    rightArrow.addEventListener('click', () => {
      container.scrollBy({
        left: scrollAmount,
        behavior: 'smooth'
      });
    });
  
    container.addEventListener('scroll', () => {
      const maxScroll = container.scrollWidth - container.clientWidth;
      leftArrow.style.display = container.scrollLeft > 0 ? 'flex' : 'none';
      rightArrow.style.display = container.scrollLeft < maxScroll - 1 ? 'flex' : 'none';
    });
  
    // Inicialmente esconde a seta esquerda
    container.dispatchEvent(new Event('scroll'));
});