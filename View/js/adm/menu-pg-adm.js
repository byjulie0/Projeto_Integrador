document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const navLinks = document.querySelector(".nav-link-pg-adm");
    const icon = menuToggle.querySelector("i");

    if (!menuToggle || !navLinks) return;

    function isMobile() {
        return window.innerWidth <= 768;
    }

    function openMenu() {
        navLinks.classList.add("mobile-active");
        icon.classList.replace("fa-bars", "fa-xmark");
    }

    function closeMenu() {
        navLinks.classList.remove("mobile-active");
        icon.classList.replace("fa-xmark", "fa-bars");
    }

    function toggleMenu() {
        if (!isMobile()) return;
        navLinks.classList.contains("mobile-active") ? closeMenu() : openMenu();
    }

    menuToggle.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        toggleMenu();
    });

    document.addEventListener("click", function (e) {
        if (isMobile() && navLinks.classList.contains("mobile-active")) {
            if (!e.target.closest('.menu-pg-adm')) {
                closeMenu();
            }
        }
    });

    window.addEventListener("resize", function () {
        if (!isMobile()) closeMenu();
    });

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && isMobile()) {
            closeMenu();
        }
    });
});
