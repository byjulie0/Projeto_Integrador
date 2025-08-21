<?php
include '../../../model/conexao.php';
session_start();

// Verifica se o cliente está logado
if (!isset($_SESSION['id_cliente'])) {
    header(header: "Location: login.php");
    exit;
}

$id_cliente   = $_SESSION['id_cliente'];
$cliente_nome = $_POST['cliente_nome'];
$email        = $_POST['email'];
$telefone     = $_POST['telefone'];
$data_nasc    = date(format: 'Y-m-d', timestamp: strtotime(datetime: str_replace(search: '/', replace: '-', subject: $_POST['data_nasc'])));
$endereco     = $_POST['endereco'];

// Separar endereço (esperado no formato: Rua, Numero - Bairro)
$partes         = explode(separator: ',', string: $endereco);
$rua            = trim(string: $partes[0]);
$numero_bairro  = explode(separator: '-', string: $partes[1]);
$numero         = trim(string: $numero_bairro[0]);
$bairro         = isset($numero_bairro[1]) ? trim(string: $numero_bairro[1]) : '';

// Atualizar cliente
$stmt = $con->prepare(query: "UPDATE cliente 
                       SET cliente_nome=?, email=?, telefone=?, data_nasc=? 
                       WHERE id_cliente=?");

if (!$stmt) {
    die("Erro ao preparar atualização de cliente: " . $con->error);
}

$stmt->bind_param("ssssi", $cliente_nome, $email, $telefone, $data_nasc, $id_cliente);

if (!$stmt->execute()) {
    die("Erro ao atualizar cliente: " . $stmt->error);
}
$stmt->close();

// Obter ID do endereço do cliente
$res = $con->query(query: "SELECT endereco_idendereco 
                    FROM cliente 
                    WHERE id_cliente = $id_cliente");

if ($res && $res->num_rows > 0) {
    $id_endereco = $res->fetch_assoc()['endereco_idendereco'];

    // Atualizar endereço
    $stmt2 = $con->prepare(query: "UPDATE endereco 
                            SET rua=?, numero=?, bairro=? 
                            WHERE id_endereco=?");

    if (!$stmt2) {
        die("Erro ao preparar atualização de endereço: " . $con->error);
    }

    $stmt2->bind_param("sisi", $rua, $numero, $bairro, $id_endereco);

    if (!$stmt2->execute()) {
        die("Erro ao atualizar endereço: " . $stmt2->error);
    }
    $stmt2->close();
} else {
    die("Endereço não encontrado para este cliente.");
}

$con->close();

// Redirecionar com sucesso
header(header: "Location: meu_perfil.php?atualizado=1");
exit;
?>
