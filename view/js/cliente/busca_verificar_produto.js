const inputBusca = document.getElementById("busca");
const resultadoContainer = document.getElementById("resultado_busca");

inputBusca.addEventListener("keyup", function() {
    let termo = this.value;

    if (termo.length < 2) {
        resultadoContainer.style.display = "none";
        resultadoContainer.innerHTML = "";
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../utils/busca_verificar_produto.php?q=" + termo, true);
    xhr.onload = function() {
        if (this.status === 200) {
            resultadoContainer.innerHTML = this.responseText;
            resultadoContainer.style.display = "block";

            // Clique em cada item
            const items = resultadoContainer.querySelectorAll(".item");
            items.forEach(item => {
                item.addEventListener("click", () => {
                    inputBusca.value = item.querySelector("strong").textContent;
                    resultadoContainer.style.display = "none";
                });
            });
        }
    };
    xhr.send();
});

// Esconde resultados se clicar fora
document.addEventListener("click", function(e) {
    if (!document.querySelector(".search-container-pg-inicial").contains(e.target)) {
        resultadoContainer.style.display = "none";
    }
});
