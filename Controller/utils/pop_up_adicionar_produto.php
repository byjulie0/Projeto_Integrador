<div id="popup_global" class="login_popup" style="display:none;">
    <div class="area_login_popup">
        <span class="fechar_login_popup">&times;</span>
        <h2 id="popup_titulo">Mensagem</h2>
        <p id="popup_texto">Descrição da mensagem</p>
        <div class="botoes_popup_login" id="popup_botoes"></div>
    </div>
</div>

<script>
    function abrirPopup(titulo, mensagem, botoesHtml) {
        document.getElementById("popup_titulo").innerText = titulo;
        document.getElementById("popup_texto").innerText = mensagem;
        document.getElementById("popup_botoes").innerHTML = botoesHtml;
        document.getElementById("popup_global").style.display = "flex";
    }

    document.addEventListener("DOMContentLoaded", () => {
        document.querySelector(".fechar_login_popup").addEventListener("click", () => {
            document.getElementById("popup_global").style.display = "none";
        });
    });
</script>