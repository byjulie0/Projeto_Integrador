let currentIndex = 0;
const cards = document.getElementById('carrossel-cards');
const cardCount = cards.children.length;
function showSlide(index) {
    const cardWidth = 220;
    cards.style.transform = `translateX(${-index * cardWidth}px)`;
}
function prevSlide() {
    currentIndex = (currentIndex > 0) ? currentIndex - 1 : cardCount - 1;
    showSlide(currentIndex);
}
function nextSlide() {
    currentIndex = (currentIndex < cardCount - 1) ? currentIndex + 1 : 0;
    showSlide(currentIndex);
}