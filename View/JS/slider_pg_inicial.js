let currentIndex = 0;
const cardsContainer = document.getElementById('carrossel-cards');
const cards = document.querySelectorAll('.card-cat-math');
const cardCount = cards.length;
const cardWidth = 230; // Fixed card width
const gapWidth = 20; // Gap between cards

function showSlide(index) {
    const scrollPosition = index * (cardWidth + gapWidth);
    cardsContainer.scrollTo({
        left: scrollPosition,
        behavior: 'smooth'
    });
    currentIndex = index;
}

function prevSlide() {
    currentIndex = Math.max(currentIndex - 1, 0);
    showSlide(currentIndex);
}

function nextSlide() {
    currentIndex = Math.min(currentIndex + 1, cardCount - 1);
    showSlide(currentIndex);
}

// Touch support for mobile devices
let touchStartX = 0;
let touchEndX = 0;

cardsContainer.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
}, {passive: true});

cardsContainer.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
}, {passive: true});

function handleSwipe() {
    const difference = touchStartX - touchEndX;
    if (difference > 50) { // Swipe left
        nextSlide();
    } else if (difference < -50) { // Swipe right
        prevSlide();
    }
}

// Keyboard navigation
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') {
        prevSlide();
    } else if (e.key === 'ArrowRight') {
        nextSlide();
    }
});

// Show appropriate arrows based on scroll position
cardsContainer.addEventListener('scroll', () => {
    const arrows = document.querySelectorAll('.arrow-cat-math');
    const scrollLeft = cardsContainer.scrollLeft;
    const maxScroll = cardsContainer.scrollWidth - cardsContainer.clientWidth;
    
    arrows[0].style.display = scrollLeft > 0 ? 'flex' : 'none';
    arrows[1].style.display = scrollLeft < maxScroll - 1 ? 'flex' : 'none';
});

// Initialize arrow visibility
document.querySelector('.arrow-cat-math:first-child').style.display = 'none';