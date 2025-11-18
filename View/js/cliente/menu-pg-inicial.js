document.addEventListener('DOMContentLoaded', function() {
  const menuToggle = document.querySelector(".menu-toggle");
  const navLinks = document.querySelector(".nav-link-pg-inicial");
  const icon = menuToggle?.querySelector("i");
  
  if (!menuToggle || !navLinks || !icon) return;

  const isMobile = () => window.innerWidth <= 768;

  const openMenu = () => {
    navLinks.classList.add("mobile-active");
    icon.classList.remove("fa-bars");
    icon.classList.add("fa-xmark");
    menuToggle.setAttribute("aria-label", "Fechar menu");
    
    setTimeout(() => {
      const buscaMobile = document.getElementById('busca-mobile');
      if (buscaMobile && isMobile()) {
        buscaMobile.focus();
      }
    }, 300);
  };

  const closeMenu = () => {
    navLinks.classList.remove("mobile-active");
    icon.classList.remove("fa-xmark");
    icon.classList.add("fa-bars");
    menuToggle.setAttribute("aria-label", "Abrir menu");
    
    if (isMobile()) {
      document.querySelectorAll('.dropdown_menu_inicial').forEach(dropdown => {
        dropdown.classList.remove('mobile-dropdown-active');
      });
    }
  };

  const toggleMenu = () => {
    if (!isMobile()) return;
    if (navLinks.classList.contains("mobile-active")) {
      closeMenu();
    } else {
        openMenu();
    }
  };

  menuToggle.addEventListener("click", (e) => {
    e.preventDefault();
    e.stopPropagation();
    toggleMenu();
  });

  document.addEventListener("click", (e) => {
    if (isMobile() && navLinks.classList.contains("mobile-active")) {
      if (!e.target.closest(".menu-pg-inicial")) {
          closeMenu();
      }
    }
  });

  window.addEventListener("resize", () => {
    if (!isMobile()) {
      closeMenu();
      document.querySelectorAll('.dropdown_menu_inicial').forEach(dropdown => {
        dropdown.classList.remove('mobile-dropdown-active');
      });
    }
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && isMobile()) {
      closeMenu();
    }
  });

  document.querySelectorAll('.dropdown_menu_inicial').forEach(dropdown => {
    const link = dropdown.querySelector('.nav-item-pg-inicial, .nav-btns-pg-inicial');
    
    if (link) {
      link.addEventListener('click', (e) => {
        if (isMobile()) {
          e.preventDefault();
          e.stopPropagation();
          
          document.querySelectorAll('.dropdown_menu_inicial').forEach(otherDropdown => {
            if (otherDropdown !== dropdown) {
              otherDropdown.classList.remove('mobile-dropdown-active');
            }
          });
          
          dropdown.classList.toggle('mobile-dropdown-active');
        }
      });
    }
  });

  document.querySelectorAll('.submenu_inicial a').forEach(link => {
    link.addEventListener('click', () => {
      if (isMobile()) {
        closeMenu();
      }
    });
  });

  document.addEventListener('click', (e) => {
    if (isMobile() && navLinks.classList.contains("mobile-active")) {
      if (e.target.closest('.nav-link-pg-inicial') && !e.target.closest('.dropdown_menu_inicial')) {
        document.querySelectorAll('.dropdown_menu_inicial').forEach(dropdown => {
          dropdown.classList.remove('mobile-dropdown-active');
        });
      }
    }
  });
});