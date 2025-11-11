document.addEventListener('DOMContentLoaded', function() {
    // Remove a mensagem de sucesso/erro após 3 segundos
    const alerts = document.querySelectorAll('.alert-dismissible');
    if (alerts.length > 0) {
        setTimeout(function() {
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 3000);
    }

    // Animação no botão de favoritar ao clicar
    const favoritarLink = document.querySelector('.botao-favorito');
    if (favoritarLink) {
        favoritarLink.addEventListener('click', function(e) {
            // Adiciona animação de pulse no ícone
            const icone = this.querySelector('i');
            icone.style.transform = 'scale(1.3)';
            icone.style.transition = 'transform 0.2s';
            
            setTimeout(function() {
                icone.style.transform = 'scale(1)';
            }, 200);
        });
    }

    // Troca a imagem principal ao clicar na miniatura
    const miniaturas = document.querySelectorAll('.miniaturas-detalhes-produto img');
    const imagemPrincipal = document.getElementById('imagem-principal');
    
    if (miniaturas.length > 0 && imagemPrincipal) {
        miniaturas.forEach(function(img) {
            img.addEventListener('click', function() {
                // Animação de fade
                imagemPrincipal.style.opacity = '0.5';
                imagemPrincipal.style.transition = 'opacity 0.2s';
                
                setTimeout(function() {
                    imagemPrincipal.src = img.src;
                    imagemPrincipal.style.opacity = '1';
                }, 200);
                
                // Remove borda ativa de todas as miniaturas
                miniaturas.forEach(function(m) {
                    m.style.border = '2px solid transparent';
                });
                
                // Adiciona borda na miniatura clicada
                img.style.border = '2px solid #007bff';
            });
        });
        
        // Marca a primeira miniatura como ativa
        if (miniaturas[0]) {
            miniaturas[0].style.border = '2px solid #007bff';
        }
    }
});