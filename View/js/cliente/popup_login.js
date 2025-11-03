// Funções para controle do pop-up de login
function verificarLoginCarrinho() {
    // Esta variável será definida no PHP no arquivo HTML
    if (typeof usuarioLogado !== 'undefined' && usuarioLogado) {
        document.getElementById('formCarrinho').submit();
    } else {
        document.getElementById('popup_login').style.display = 'flex';
    }
}

function verificarLoginCompra(event) {
    if (typeof usuarioLogado === 'undefined' || !usuarioLogado) {
        event.preventDefault();
        document.getElementById('popup_login').style.display = 'flex';
        return false;
    }
    return true;
}

// Fechar pop-up quando clicar no X
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