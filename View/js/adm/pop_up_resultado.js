document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById("popup_resultado");
    if (!popup) return;

    popup.style.display = "flex";

    const fecharBtns = popup.querySelectorAll(".fechar_popup_resultado");
    fecharBtns.forEach(btn => btn.addEventListener("click", () => {
        popup.style.display = "none";
    }));
});
