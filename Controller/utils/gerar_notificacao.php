<?php

function Criar_notificacao($con, $usuario_id, $produto_id, $mensagem, $categoria, $imagem){


$sql = "INSERT INTO notificacoes (usuario_id, produto_id, mensagem, categoria, imagem) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql); 

if (!$stmt) {
    die("Erro ao preparar a query: " . $con->error);
}


$stmt->bind_param("iisss", $usuario_id, $produto_id, $mensagem, $categoria, $imagem);

if ($stmt->execute()) {
    return true; // sucesso
} else {
    error_log("Erro ao inserir notificação: " . $stmt->error);
    return false; // falhou
}




 
}