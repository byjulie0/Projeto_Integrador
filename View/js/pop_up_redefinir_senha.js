
document.getElementById('formRedefinirSenha').addEventListener('submit', function(e) {
    e.preventDefault();
    const novaSenha = document.getElementById('novaSenha').value;
    const confirmarSenha = document.getElementById('confirmarSenha').value;
    
    if (novaSenha !== confirmarSenha) {
        alert('As senhas não coincidem!');
        return;
    }
    // adicionar lógica AJAX para enviar ao servidor
    document.getElementById('popupSucesso').style.display = 'flex';
});

document.getElementById('btnLogin').addEventListener('click', function() {
    window.location.href = 'login.php';
});