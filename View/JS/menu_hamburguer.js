document.addEventListener('DOMContentLoaded', function() {
    // Seleciona o botão do hambúrguer
    const menuToggle = document.querySelector('.menu-toggle');

    // Seleciona o body para adicionar/remover a classe que controla o menu
    const body = document.body;

    // Seleciona os elementos que serão mostrados/ocultados
    const navLinks = document.querySelector('.nav-link-pg-inicial');
    const searchContainer = document.querySelector('.search-container-pg-inicial');

    // Função para alternar a classe 'menu-ativo'
    function toggleMenuVisibility() {
        body.classList.toggle('menu-ativo');

        // Adiciona/remove aria-expanded para acessibilidade
        const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true'; // Se está true, era true. Se não, é false.
        menuToggle.setAttribute('aria-expanded', !isExpanded); // Inverte o valor
    }

    // Adiciona o event listener ao botão do hambúrguer
    if (menuToggle) { // Verifica se o elemento existe antes de adicionar o listener
        menuToggle.addEventListener('click', toggleMenuVisibility);
    }

    // Opcional: Fechar o menu ao clicar fora dele
    document.addEventListener('click', function(event) {
        // Verifica se o clique não foi no menu-toggle e nem dentro dos elementos do menu
        const isClickInsideMenu = navLinks.contains(event.target) || searchContainer.contains(event.target) || menuToggle.contains(event.target);

        if (!isClickInsideMenu && body.classList.contains('menu-ativo')) {
            body.classList.remove('menu-ativo');
            menuToggle.setAttribute('aria-expanded', 'false');
        }
    });

    // Opcional: Fechar o menu se a janela for redimensionada para desktop
    window.addEventListener('resize', function() {
        // Usa o mesmo breakpoint do CSS mobile-pequeno para desktop
        if (window.innerWidth > 390 && body.classList.contains('menu-ativo')) {
            body.classList.remove('menu-ativo');
            menuToggle.setAttribute('aria-expanded', 'false');
        }
    });
});