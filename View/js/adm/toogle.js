
document.querySelectorAll('.icon-toggle-btn').forEach(button => {
  button.addEventListener('click', function() {
    const isPressed = this.getAttribute('aria-pressed') === 'true';
    this.setAttribute('aria-pressed', !isPressed);
  });
});
console.log("Chegou")