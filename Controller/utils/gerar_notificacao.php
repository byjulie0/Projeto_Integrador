<?php

function Criar_notificacao($con, $id_cliente, $id_pedido, $mensagem, $tipo){
    //sem ideia
    error_log("Tentando criar notificação: Cliente: $id_cliente, Pedido: $id_pedido, Mensagem: $mensagem, Tipo: $tipo");
    
    $sql = "INSERT INTO notificacoes (id_cliente, id_pedido, mensagem, tipo) VALUES (?, ?, ?, ?)";
    $query = $con->prepare($sql);

    if (!$query) {
        error_log("Erro ao preparar query de notificação: " . $con->error);
        return false;
    }

    $query->bind_param("iiss", $id_cliente, $id_pedido, $mensagem, $tipo);

    if ($query->execute()) {
        error_log("Notificação criada com sucesso! ID: " . $query->insert_id);
        return true;
    } else {
        error_log("Erro ao executar query de notificação: " . $query->error);
        return false;
    }
}

function Criar_notificacao_adm($con, $id_adm, $id_produto, $mensagem, $tipo){
    
    error_log("Tentando criar notificação ADM: ADM: $id_adm, Pedido: $id_produto, Mensagem: $mensagem, Tipo: $tipo");
    
    $sql = "INSERT INTO notificacoes_adm (id_adm, id_produto, mensagem, tipo) VALUES (?, ?, ?, ?)";
    $query = $con->prepare($sql);

    if (!$query) {
        error_log("Erro ao preparar query de notificação ADM: " . $con->error);
        return false;
    }

    $query->bind_param("iiss", $id_adm, $id_produto, $mensagem, $tipo);

    if ($query->execute()) {
        error_log("Notificação ADM criada com sucesso! ID: " . $query->insert_id);
        return true;
    } else {
        error_log("Erro ao executar query de notificação ADM: " . $query->error);
        return false;
    }
}
?>