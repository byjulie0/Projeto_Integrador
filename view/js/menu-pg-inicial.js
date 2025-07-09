document.addEventListener('DOMContentLoaded', function() {
  const menuToggle = document.querySelector('.menu-toggle');
  const navLinks = document.querySelector('.nav-link-pg-inicial');
  const searchContainer = document.querySelector('.search-container-pg-inicial');
  
  menuToggle.addEventListener('click', function() {
    // Toggle mobile-active class on both elements
    navLinks.classList.toggle('mobile-active');
    searchContainer.classList.toggle('mobile-active');
    
    // Change icon between hamburger and X
    const icon = this.querySelector('i');
    if (navLinks.classList.contains('mobile-active')) {
      icon.classList.remove('fa-bars');
      icon.classList.add('fa-xmark');
    } else {
      icon.classList.remove('fa-xmark');
      icon.classList.add('fa-bars');
    }
  });
  
  // Close menu when clicking on a link (optional)
  document.querySelectorAll('.nav-item-pg-inicial').forEach(link => {
    link.addEventListener('click', () => {
      navLinks.classList.remove('mobile-active');
      searchContainer.classList.remove('mobile-active');
      menuToggle.querySelector('i').classList.remove('fa-xmark');
      menuToggle.querySelector('i').classList.add('fa-bars');
    });
  });

  // Muda posição da tela
  document.querySelectorAll('.nav-item-pg-inicial').forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      const targetElement = document.querySelector(targetId);
      const currentPath = window.location.pathname;
      
      const isCorrectPage = currentPath.endsWith('/pg_inicial_cliente.php') || currentPath.endsWith('/pg_inicial_cliente');
      console.log('Is correct page:', isCorrectPage);
      
      if (isCorrectPage && targetElement) {
        console.log('Scrolling to section');
        window.scrollTo({
          top: targetElement.offsetTop - 10,
          behavior: 'smooth',
        });
        history.pushState(null, null, targetId);

      } else {
        console.log('Redirecting to pg_inicial_cliente.php with hash');
        window.location.href = 'pg_inicial_cliente.php' + targetId;
      }
    });
  });

});
