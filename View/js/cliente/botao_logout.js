document.addEventListener("DOMContentLoaded", function () {
    const botao = document.querySelector(".logout-confirm");
  
    botao.addEventListener("click", function (e) {
      const confirmar = confirm("Tem certeza que deseja sair?");
      if (!confirmar) {
        e.preventDefault();
      }
    });
});