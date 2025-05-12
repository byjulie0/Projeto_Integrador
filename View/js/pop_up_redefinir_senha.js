
document.getElementById('formRedefinirSenha').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Validação das senhas
    const novaSenha = document.getElementById('novaSenha').value;
    const confirmarSenha = document.getElementById('confirmarSenha').value;
    
    if (novaSenha !== confirmarSenha) {
        alert('As senhas não coincidem!');
        return;
    }
    
    // Simulação de envio bem-sucedido
    // Aqui você pode adicionar sua lógica AJAX para enviar ao servidor
    
    // Mostra o popup
    document.getElementById('popupSucesso').style.display = 'flex';
});

// Fechar popup e redirecionar para login
document.getElementById('btnLogin').addEventListener('click', function() {
    window.location.href = 'login.php'; // Altere para sua página de login
});