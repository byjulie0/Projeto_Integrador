document.addEventListener("DOMContentLoaded", function () {
    const botoesCancelar = document.querySelectorAll(".cancelar-operacao");
  
    botoesCancelar.forEach(function (botao) {
      botao.addEventListener("click", function () {
        // Encontra o formulário mais próximo
        const formulario = botao.closest("form");
  
        if (formulario) {
          formulario.reset(); // Limpa os campos
        }
  
        // Volta para a página anterior
        window.history.back();
      });
    });
  });
  