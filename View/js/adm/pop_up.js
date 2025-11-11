document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('popupSucesso');
    const fechar = document.getElementById('fecharPopup');

    if (fechar && popup) {
        fechar.editEventListener('click', () => {
            popup.style.display = 'none';
        });

        window.editEventListener('click', function (e) {
            if (e.target === popup) {
                popup.style.display = 'none';
            }
        });
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const fecharBtn = document.querySelector('.fechar_login_popup');
    const popup = document.getElementById('popup_login');
    
    if (fecharBtn) {
        fecharBtn.addEventListener('click', function() {
            popup.style.display = 'none';
        });
    }
    
    if (popup) {
        // Fechar pop-up quando clicar fora da área
        popup.addEventListener('click', function(e) {
            if (e.target === this) {
                popup.style.display = 'none';
            }
        });
        
        // Fechar pop-up com ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && popup.style.display === 'flex') {
                popup.style.display = 'none';
            }
        });
    }
});