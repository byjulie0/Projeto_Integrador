document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const searchToggle = document.querySelector('.search-toggle');
    const navLinks = document.querySelector('.nav-link-pg-inicial');
    const searchContainer = document.querySelector('.search-container-pg-inicial');
  
    menuToggle.addEventListener('click', function() {
      navLinks.classList.toggle('active');
      searchContainer.classList.remove('active');
    });
  
    searchToggle.addEventListener('click', function() {
      searchContainer.classList.toggle('active');
      navLinks.classList.remove('active');
    });
  });