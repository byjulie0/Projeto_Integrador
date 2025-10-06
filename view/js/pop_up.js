function mostrarPopup(tipo, mensagem) {
    // cria overlay
    const overlay = document.createElement("div");
    overlay.classList.add("popup-overlay");

    const box = document.createElement("div");
    box.classList.add("popup-box");

    const closeBtn = document.createElement("button");
    closeBtn.classList.add("popup-close");
    closeBtn.innerHTML = "&times;";
    closeBtn.onclick = () => overlay.remove();

    const titulo = document.createElement("h1");
    const texto = document.createElement("p");
    texto.classList.add("texto_popup");

    // configura por tipo
    if (tipo === "success") {
        titulo.innerText = "Sucesso!";
        titulo.style.color = "#2d8c37";  
        texto.style.color = "#2d8c37";
    } else if (tipo === "error") {
        titulo.innerText = "Erro!";
        titulo.style.color = "#c0392b";   
        texto.style.color = "#c0392b";
    }

    texto.innerText = mensagem;

    // monta popup
    box.appendChild(closeBtn);
    box.appendChild(titulo);
    box.appendChild(texto);
    overlay.appendChild(box);

    // adiciona na tela
    document.body.appendChild(overlay);
    overlay.style.display = "flex";
}
