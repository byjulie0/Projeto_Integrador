<?php

function Criar_notificacao($con, $usuario_id, $produto_id, $mensagem, $categoria){




$sql = "INSERT INTO notificacoes (id_cliente, id_produto, mensagemtexto, categoria, data_recebida) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql); 

if (!$stmt) {
    die("Erro ao preparar a query: " . $con->error);
}

$data_recebida= date('d-m-y');
$stmt->bind_param("iisss", $usuario_id, $produto_id, $mensagem, $categoria, $data_recebida);

if ($stmt->execute()) {
    return true; // sucesso
} else {
    error_log("Erro ao inserir notificação: " . $stmt->error);
    return false; // falhou
}


}



function Criar_notificacao_adm($con, $adm_id, $produto_id, $mensagem, $categoria){


$sql = "INSERT INTO notificacoes_adm (adm_id, produto_id, mensagem, categoria, data_recebida) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($sql); 

if (!$stmt) {
    die("Erro ao preparar a query: " . $con->error);
}


$stmt->bind_param("iisss", $adm_id, $produto_id, $mensagem, $categoria);

if ($stmt->execute()) {
    return true; // sucesso
} else {
    error_log("Erro ao inserir notificação: " . $stmt->error);
    return false; // falhou
}


}