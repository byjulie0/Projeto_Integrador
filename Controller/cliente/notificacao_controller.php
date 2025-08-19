<?php
include '../../model/DB/conexao.php';

function enviarNotificacao($id_cliente, $titulo, $mensagem, $conn) {
    $sql = "INSERT INTO notificacao (id_cliente, titulo, mensagem) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id_cliente, $titulo, $mensagem);
    return $stmt->execute();
}

// Exemplo de envio manual
if (isset($_POST['enviar'])) {
    $id_cliente = $_POST['id_cliente'];
    $titulo = $_POST['titulo'];
    $mensagem = $_POST['mensagem'];

    if (enviarNotificacao($id_cliente, $titulo, $mensagem, $conn)) {
        echo "✅ Notificação enviada!";
    } else {
        echo "❌ Erro ao enviar!";
    }
}