<?php
require_once __DIR__ . '/../../model/DB/conexao.php';
session_start();

$id_cliente = 1; //$_SESSION['id_cliente'] ?? 0;

//if ($id_cliente == 0) {
  //  die("Você precisa estar logado para acessar o carrinho.");
//}

// ----- AÇÕES (atualizar ou remover) -----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao']) && $_POST['acao'] === 'atualizar') {
        $id_carrinho = $_POST['id_carrinho'] ?? 0;
        $qtd = $_POST['qtd_selecionada'] ?? 1;

        $sql = "UPDATE carrinho 
                SET qtd_selecionada = ? 
                WHERE id_carrinho = ? AND cliente_id_cliente = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("iii", $qtd, $id_carrinho, $id_cliente);
        $stmt->execute();
    }

    if (isset($_POST['acao']) && $_POST['acao'] === 'remover') {
        $id_carrinho = $_POST['id_carrinho'] ?? 0;

        $sql = "DELETE FROM carrinho 
                WHERE id_carrinho = ? AND cliente_id_cliente = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ii", $id_carrinho, $id_cliente);
        $stmt->execute();
    }

    // Recarregar página após ação
    header("Location: carrinho.php");
    exit;
}

// ----- BUSCAR ITENS DO CARRINHO -----
$sql = "SELECT c.id_carrinho, c.qtd_selecionada, c.selecionado,
               p.prod_nome, p.valor, p.descricao, p.path_img as imagem
        FROM carrinho c
        JOIN produto p ON c.produto_id_produto = p.id_produto
        WHERE c.cliente_id_cliente = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();
$itens = $result->fetch_all(MYSQLI_ASSOC);

$total = 0;
foreach ($itens as $item) {
    $total += $item['valor'] * $item['qtd_selecionada'];
}
?>
