alert("JS está funcionando!");

document.getElementById("busca").addEventListener("keyup", function() {
    console.log("Está funcionando!!!");
    let termo = this.value;

    if (termo.length < 2) {
        document.getElementById("resultado").innerHTML = "";
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "busca.php?q=" + termo, true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById("resultado").innerHTML = this.responseText;
        }
    };
    xhr.send();
});