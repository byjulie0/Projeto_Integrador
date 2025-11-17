document.addEventListener("DOMContentLoaded", () => {
    const menuToggle = document.querySelector(".menu-toggle");
    const navLinks = document.querySelector(".nav-link-pg-adm");
    const icon = menuToggle?.querySelector("i");
    const dropdowns = document.querySelectorAll(".dropdown_menu_adm");

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
        
        closeAllSubmenus();
    };

    const toggleMenu = () => {
        if (!isMobile()) return;
        if (navLinks.classList.contains("mobile-active")) {
            closeMenu();
        } else {
            openMenu();
        }
    };

    const openSubmenu = (submenu) => {
        closeAllSubmenus();
        submenu.classList.add("mobile-active");
    };

    const closeSubmenu = (submenu) => {
        submenu.classList.remove("mobile-active");
    };

    const closeAllSubmenus = () => {
        document.querySelectorAll(".submenu_adm.mobile-active").forEach(submenu => {
            submenu.classList.remove("mobile-active");
        });
    };

    const toggleSubmenu = (dropdown) => {
        const submenu = dropdown.querySelector(".submenu_adm");
        if (!submenu) return;

        if (submenu.classList.contains("mobile-active")) {
            closeSubmenu(submenu);
        } else {
            openSubmenu(submenu);
        }
    };

    dropdowns.forEach(dropdown => {
        const trigger = dropdown.querySelector("a");
        const submenu = dropdown.querySelector(".submenu_adm");

        if (!trigger || !submenu) return;

        trigger.addEventListener("click", (e) => {
            if (isMobile()) {
                e.preventDefault();
                e.stopPropagation();
                toggleSubmenu(dropdown);
            }
        });

        if (!isMobile()) {
            dropdown.addEventListener("mouseenter", () => {
                submenu.style.display = 'block';
            });

            dropdown.addEventListener("mouseleave", () => {
                submenu.style.display = 'none';
            });
        }
    });

    menuToggle.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        toggleMenu();
    });

    document.addEventListener("click", (e) => {
        if (isMobile()) {
            if (!e.target.closest(".dropdown_menu_adm")) {
                closeAllSubmenus();
            }
            
            if (navLinks.classList.contains("mobile-active") && !e.target.closest(".menu-pg-adm")) {
                closeMenu();
            }
        }
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            if (isMobile()) {
                if (document.querySelector(".submenu_adm.mobile-active")) {
                    closeAllSubmenus();
                } else if (navLinks.classList.contains("mobile-active")) {
                    closeMenu();
                }
            }
        }
    });

    window.addEventListener("resize", () => {
        if (!isMobile()) {
            closeMenu();
            closeAllSubmenus();
            
            dropdowns.forEach(dropdown => {
                const submenu = dropdown.querySelector(".submenu_adm");
                if (submenu) {
                    submenu.style.display = 'none';
                    submenu.classList.remove("mobile-active");
                }
            });
        }
    });
});