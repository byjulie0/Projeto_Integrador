<link rel="stylesheet" href="../../View/Public/Css/cliente/pop_up_login.css">

<div id="popup_login" class="login_popup" style="display: none;"> 
    <div class="area_login_popup">
        <span class="fechar_login_popup" onclick="fecharPopup()">&times;</span>
        
        <h2 class="h2_popup_login" id="popup_titulo">Título Padrão</h2>
        <p id="popup_mensagem">Mensagem Padrão</p>
        
        <div class="botoes_popup_login">
            <a id="link_confirmacao" href="#">
                <?php 
                // Mantendo seu estilo de botão verde
                $texto = "Sim"; 
                include '../cliente/botao_verde_cliente.php';
                ?>
            </a>
            
            <a href="javascript:void(0)" onclick="fecharPopup()">
                <?php
                // Mantendo seu estilo de botão vermelho
                $texto = "Não";  
                include '../cliente/botao_vermelho_cliente.php'; 
                ?>
            </a>
        </div>
    </div>
</div>