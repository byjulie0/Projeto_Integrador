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
  };

  const closeMenu = () => {
    navLinks.classList.remove("mobile-active");
    icon.classList.remove("fa-xmark");
    icon.classList.add("fa-bars");
    menuToggle.setAttribute("aria-label", "Abrir menu");
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
    }
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && isMobile()) {
      closeMenu();
    }
  });
});