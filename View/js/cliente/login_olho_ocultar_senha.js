function toggleSenha() {
    const senhaInput = document.getElementById("senha");
    const icone = document.getElementById("icone_senha");

    if (senhaInput.type === "password") {
        senhaInput.type = "text";
        icone.classList.remove("fa-eye");
        icone.classList.add("fa-eye-slash");
    } else {
        senhaInput.type = "password";
        icone.classList.remove("fa-eye-slash");
        icone.classList.add("fa-eye");
    }
}