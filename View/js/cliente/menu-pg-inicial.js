document.addEventListener('DOMContentLoaded', function() {
  const menuToggle = document.querySelector('.menu-toggle');
  const navLinks = document.querySelector('.nav-link-pg-inicial');
  const searchContainer = document.querySelector('.search-container-pg-inicial');
  const menuPaginicial = document.querySelector('.menu-pg-inicial');
  
  // Create mobile menu container
  const mobileMenuContainer = document.createElement('div');
  mobileMenuContainer.className = 'mobile-menu-container';
  menuPaginicial.appendChild(mobileMenuContainer);
  
  menuToggle.addEventListener('click', function() {
    const isMobileView = window.matchMedia('(max-width: 767px)').matches;
    const isTabletView = window.matchMedia('(min-width: 768px) and (max-width: 1023px)').matches;
    
    mobileMenuContainer.classList.toggle('active');
    
    if (mobileMenuContainer.classList.contains('active')) {
      // Move elements into container when active
      mobileMenuContainer.appendChild(navLinks);
      mobileMenuContainer.appendChild(searchContainer);
      
      // Add appropriate classes based on view
      if (isMobileView) {
        navLinks.classList.add('mobile-active');
        searchContainer.classList.add('mobile-active');
      } else if (isTabletView) {
        navLinks.classList.add('tablet-menu-active');
        searchContainer.classList.add('tablet-menu-active');
      }
    } else {
      // Move elements back to their original positions
      document.querySelector('.menu-content-pg-inicial').insertBefore(navLinks, menuToggle);
      document.querySelector('.menu-content-pg-inicial').insertBefore(searchContainer, menuToggle);
      
      // Remove active classes
      navLinks.classList.remove('mobile-active', 'tablet-menu-active');
      searchContainer.classList.remove('mobile-active', 'tablet-menu-active');
    }
    
    // Change icon
    const icon = this.querySelector('i');
    icon.classList.toggle('fa-bars');
    icon.classList.toggle('fa-xmark');
  });
  
  // Close menu when clicking on a link
  document.querySelectorAll('.nav-item-pg-inicial, .search-container-pg-inicial button').forEach(element => {
    element.addEventListener('click', () => {
      closeMobileMenu();
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


// Close menu when clicking outside
document.addEventListener('click', function(event) {
  if (!menuPaginicial.contains(event.target)) {
    closeMobileMenu();
  }
});
  
// Handle window resize
window.addEventListener('resize', function() {
  if (window.innerWidth >= 1024) {
    closeMobileMenu();
  }
});

function closeMobileMenu() {
  // Move elements back to original positions
  const menuContent = document.querySelector('.menu-content-pg-inicial');
  if (!navLinks.parentNode.isSameNode(menuContent)) {
    menuContent.insertBefore(navLinks, menuToggle);
  }
  if (!searchContainer.parentNode.isSameNode(menuContent)) {
    menuContent.insertBefore(searchContainer, menuToggle);
  }
  
  // Remove active states
  mobileMenuContainer.classList.remove('active');
  navLinks.classList.remove('mobile-active', 'tablet-menu-active');
  searchContainer.classList.remove('mobile-active', 'tablet-menu-active');
  
  // Reset icon
  const icon = menuToggle.querySelector('i');
  icon.classList.remove('fa-xmark');
  icon.classList.add('fa-bars');
}
  // Close menu when clicking outside
document.addEventListener('click', function(event) {
  if (!menuPaginicial.contains(event.target)) {
    closeMobileMenu();
  }
});

// Handle window resize
window.addEventListener('resize', function() {
  if (window.innerWidth >= 1024) {
    closeMobileMenu();
  }
});
  
function closeMobileMenu() {
  // Move elements back to original positions
  const menuContent = document.querySelector('.menu-content-pg-inicial');
  if (!navLinks.parentNode.isSameNode(menuContent)) {
    menuContent.insertBefore(navLinks, menuToggle);
  }
  if (!searchContainer.parentNode.isSameNode(menuContent)) {
    menuContent.insertBefore(searchContainer, menuToggle);
  }

  // Remove active states
  mobileMenuContainer.classList.remove('active');
  navLinks.classList.remove('mobile-active', 'tablet-menu-active');
  searchContainer.classList.remove('mobile-active', 'tablet-menu-active');

  // Reset icon
  const icon = menuToggle.querySelector('i');
  icon.classList.remove('fa-xmark');
  icon.classList.add('fa-bars');
};
