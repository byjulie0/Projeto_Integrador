<?php
include '../utils/autenticado.php';
include '../utils/listar_pedidos_cliente.php';

if ($usuario_nao_logado) {
    include '../overlays/pop_up_login.php';
    exit;
}

// Verificar se há mensagens de pop-up na sessão
if (isset($_SESSION['popup_message'])) {
    $titulo = $_SESSION['titulo'];
    $texto = $_SESSION['popup_message'];

    // Verificar se é sucesso
    if (isset($_SESSION['type']) && $_SESSION['type'] == 'success') {
        $sucesso = true;
    }
    include '../overlays/pop_up_erro.php';

    // Limpar a sessão
    unset($_SESSION['titulo']);
    unset($_SESSION['popup_message']);
    unset($_SESSION['type']);
}

include 'menu_pg_inicial.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Histórico de Compras</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="../../view/public/css/cliente/historico_de_compras.css" />
    </head>

<body class="body_historico_compras">
    <div class="container_historico_compras">

        <div class="title_historico_compras">
            <a href="#" onclick="window.history.back(); return false;" class="arrow_compras">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <h1 class="titulo_historico_compras">Histórico de Compras</h1>
        </div>

        <div class="divisao_pedidos_bloco">
            <?php if (!empty($pedidos)): ?>
                <?php foreach ($pedidos as $pedido): ?>
                    <div class="area_historico_compras">
                        <div class="pedido_header">
                            <div class="div_data_pedido_pc">
                                <p>
                                    Data:
                                    <strong> <?= (new DateTime($pedido['data_pedido']))->format('d/m/y') ?></strong>
                                </p>
                            </div>
                            
                            <div class="botao_cancelar">
                                <?php if ($pedido['status_pedido'] == 'Pendente'): ?>
                                    <a href="javascript:void(0)" 
                                       class="botao_vermelho"
                                       onclick="abrirPopup(
                                           'Cancelar Pedido!', 'Tem certeza que deseja cancelar o pedido #<?= $pedido['id_pedido'] ?>? Essa ação não pode ser desfeita.', '../utils/cancelar_pedido_cliente.php?id_pedido=<?= $pedido['id_pedido'] ?>')">
                                        Cancelar Pedido
                                    </a>
                                <?php endif; ?>
                            </div>
                            </div>

                        <div class="atributos_pedido_mobile">
                            <div class="div_data_pedido_mobile">
                                <p class="data_pedido_mobile">Data do
                                    Pedido:<span><?= htmlspecialchars($pedido['data_pedido']) ?></span> </p>
                            </div>
                            <div class="pedido_detalhes">
                                <p class="codigo_pedido">Pedido: <?= $pedido['id_pedido'] ?></p>
                                <p class="total_itens">Total de Itens: <?= $pedido['total_itens'] ?></p>
                                <p class="valor_pedido">Valor Total: R$
                                    <?= number_format($pedido['valor_total'], 2, ',', '.') ?></p>
                                <p class="status_pedido"><?= $pedido['status_pedido'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif ?>
        </div>
    </div>

    <?php include 'footer_cliente.php'; ?>

    <?php include '../overlays/pop_up_pergunta.php'; ?>

    <script>
        function abrirPopup(titulo, mensagem, linkDestino) {
            // Atualiza os textos do pop-up
            document.getElementById('popup_titulo').innerText = titulo;
            document.getElementById('popup_mensagem').innerText = mensagem;
            
            // Atualiza o link do botão "Sim"
            document.getElementById('link_confirmacao').href = linkDestino;

            // Mostra o pop-up
            document.getElementById('popup_login').style.display = 'flex';
        }

        function fecharPopup() {
            document.getElementById('popup_login').style.display = 'none';
        }

        // Fecha ao clicar fora da caixa
        window.onclick = function(event) {
            var modal = document.getElementById('popup_login');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>