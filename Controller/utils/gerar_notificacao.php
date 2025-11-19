<?php

function Criar_notificacao($con, $id_cliente, $id_produto, $mensagem, $tipo){

    $sql = "INSERT INTO notificacoes (id_cliente, id_produto, mensagem, tipo) VALUES (?, ?, ?, ?)";
    $query = $con->prepare($sql);

    if (!$query) {
        die("Erro ao preparar a query: " . $con->error);
    }

    $query->bind_param("iiss", $id_cliente, $id_produto, $mensagem, $tipo);

    if ($query->execute()) {
        return true; // sucesso
    } else {
        error_log("Erro ao inserir notificação: " . $query->error);
        return false; // falhou
    }


}



function Criar_notificacao_adm($con, $adm_id, $id_produto, $mensagem, $tipo){


    $sql = "INSERT INTO notificacoes_adm (adm_id, id_produto, mensagem, tipo) VALUES (?, ?, ?, ?)";
    $query = $con->prepare($sql);

    if (!$query) {
        die("Erro ao preparar a query: " . $con->error);
    }


    $query->bind_param("iiss", $adm_id, $id_produto, $mensagem, $tipo);

    if ($query->execute()) {
        return true; // sucesso
    } else {
        error_log("Erro ao inserir notificação: " . $query->error);
        return false; // falhou
    }


}