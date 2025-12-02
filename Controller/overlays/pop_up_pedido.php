<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop Up Pedido</title>
    <link rel="stylesheet" href="../../view/public/css/adm/pop_up_erro.css">
</head>

<body>
    <div class="popup" style="display: flex;">
        <div class="area_popup">
            <button class="fechar_popup" onclick="fecharPopup(); return false;">&times;</button>
            <?php if (isset($sucesso)): ?>
                <h3 class="titulo_pop_up" style="color: var(--color-botao-op-Concluido);"><?php echo htmlspecialchars($titulo);?></h3>
            <?php else: ?>
                <h3 class="titulo_pop_up" style="color: var(--color-botao-op-Cancelar);"><?php echo htmlspecialchars($titulo); ?></h3>
            <?php endif ?>
            <div class="mensagem_box">
                <p class="texto_pop_up"><?php echo htmlspecialchars($texto); ?></p>
            </div>
            
            <?php if (isset($sucesso)): ?>
                <!-- Botão para WhatsApp apenas em caso de sucesso -->
                <div class="botoes_popup_resultado" style="margin-top: 20px;">
                    <button class="botao_sucesso" onclick="redirecionarWhatsApp()" style="background-color: #25D366; color: white; border: none; padding: 12px 20px; border-radius: 5px; cursor: pointer; font-size: 16px;">
                        Ir para WhatsApp
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function redirecionarWhatsApp() {
            window.location.href = 'https://api.whatsapp.com/send?phone=556799492638';
        }
    </script>
</body>
</html>