document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu_adm_toggle');
    const navLinks = document.querySelector('.nav_link_menu_adm');
    const searchContainer = document.querySelector('.search_container_menu_adm');
    
    menuToggle.addEventListener('click', function() {
      // Toggle mobile-active class on both elements
      navLinks.classList.toggle('mobile-active');
      searchContainer.classList.toggle('mobile-active');
      
      // Change icon between hamburger and X
      const icon = this.querySelector('i');
      if (navLinks.classList.contains('mobile-active')) {
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-xmark');
        
        // Fechar todos os dropdowns quando o menu mobile abre
        document.querySelectorAll('.submenu_adm').forEach(submenu => {
          submenu.style.display = 'none';
        });
      } else {
        icon.classList.remove('fa-xmark');
        icon.classList.add('fa-bars');
      }
    });
    
    // Close menu when clicking on a link (optional)
    document.querySelectorAll('.nav_item_pg_inicial_adm').forEach(link => {
      link.addEventListener('click', () => {
        navLinks.classList.remove('mobile-active');
        searchContainer.classList.remove('mobile-active');
        menuToggle.querySelector('i').classList.remove('fa-xmark');
        menuToggle.querySelector('i').classList.add('fa-bars');
      });
    });
    
    // Fechar menu quando a tama nho da janela aumenta
    window.addEventListener('resize', function() {
      if (window.innerWidth > 1199) {
        navLinks.classList.remove('mobile-active');
        searchContainer.classList.remove('mobile-active');
        menuToggle.querySelector('i').classList.remove('fa-xmark');
        menuToggle.querySelector('i').classList.add('fa-bars');
        
        // Resetar dropdowns no desktop
        document.querySelectorAll('.submenu_adm').forEach(submenu => {
          submenu.style.display = 'none';
        });
      }
    });
    
    // Fechar menu ao clicar fora (opcional)
    document.addEventListener('click', function(event) {
      if (!event.target.closest('.menu_adm') && 
          !event.target.closest('.nav_link_menu_adm') && 
          !event.target.closest('.search_container_menu_adm')) {
        navLinks.classList.remove('mobile-active');
        searchContainer.classList.remove('mobile-active');
        menuToggle.querySelector('i').classList.remove('fa-xmark');
        menuToggle.querySelector('i').classList.add('fa-bars');
      }
    });
  });