<?php
include '../../model/DB/conexao.php';
include 'gerar_notificacao.php';


$pedido_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($pedido_id === 0) {
    echo "<script>alert('ID do pedido inválido!'); window.location.href='../adm/verificar_administrar_pedido.php';</script>";
    exit;
}

try {
    $sql = "UPDATE pedido SET status_pedido = 'Concluído' WHERE id_pedido = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $pedido_id);
    $stmt->execute();

    // criar  notificação inicio
    
    $sql= "SELECT id_cliente FROM pedido WHERE id_pedido = ?";

    $stmt->bind_param("i", $pedido_id);
    $stmt->execute();
    $cliente_id_not=$stmt->get_result();


    if ($cliente_id_not && $cliente_id_not->num_rows > 0){

        $row = $cliente_id_not->fetch_assoc();
        $usuario_id= $row['id_cliente'];
        $produto_id= $pedido_id;
        $mensagem="Cliente, o seu pedido de Número: #{$pedido_id} foi concluido!";
        $categoria="Pedidos";

        if (Criar_notificacao($con, $usuario_id, $produto_id, $mensagem, $categoria)) {
            echo "Notificação enviada com sucesso!";
        } 
        else {
            echo "Erro ao enviar notificação.";
        }
    }

    // criar  notificação fim

    echo "<script>alert('Pedido concluído com sucesso!'); window.location.href='../adm/verificar_administrar_pedido.php';</script>";
} catch (Exception $e) {
    echo "<script>alert('Erro ao concluir pedido: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
}
?>