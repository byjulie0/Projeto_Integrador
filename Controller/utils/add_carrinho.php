<?php
include '../../model/DB/conexao.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../cliente/pg_inicial_cliente.php');
    exit;
}

$id_cliente = isset($_POST['id_cliente']) ? intval($_POST['id_cliente']) : null;
$id_produto = isset($_POST['id_produto']) ? intval($_POST['id_produto']) : null;

if ($id_produto == null) {
    $_SESSION['titulo'] = 'Produto não encontrado!';
    $_SESSION['popup_message'] = 'Não foi possível encontrar esse produto no catalogo.';
    $_SESSION['type'] = 'error';

    header("Location: ../cliente/detalhes_produto.php?id_produto=" . $id_produto);
    exit;
} else if ($id_cliente == null) {
    include '../overlays/pop_up_login.php';
    exit;
}

try {
    $con->begin_transaction();

    // Primeiro, verifique se o produto existe e está ativo
    $sql = "SELECT quant_estoque, produto_ativo FROM produto WHERE id_produto = ?";
    $query = $con->prepare($sql);
    $query->bind_param("i", $id_produto);
    $query->execute();
    $result = $query->get_result();
    
    if ($result->num_rows == 0) {
        $_SESSION['titulo'] = 'Produto não encontrado!';
        $_SESSION['popup_message'] = 'Este produto não existe mais no catálogo.';
        $_SESSION['type'] = 'error';
        $con->rollback();
        header("Location: ../cliente/pg_inicial_cliente.php");
        exit;
    }
    
    $produto = $result->fetch_assoc();
    $estoque_atual = $produto['quant_estoque'] ?? 0;
    $produto_ativo = $produto['produto_ativo'] ?? 0;
    $query->close();

    // Verificar se o produto está ativo
    if ($produto_ativo == 0) {
        $_SESSION['titulo'] = 'Produto indisponível!';
        $_SESSION['popup_message'] = 'Este produto está temporariamente indisponível.';
        $_SESSION['type'] = 'error';
        $con->rollback();
        header("Location: ../cliente/detalhes_produto.php?id_produto=" . $id_produto);
        exit;
    }

    // Consulta para ver se existe o item no carrinho
    $sql = "SELECT quantidade FROM carrinho WHERE id_cliente = ? AND id_produto = ?";
    $query = $con->prepare($sql);
    $query->bind_param("ii", $id_cliente, $id_produto);
    $query->execute();
    $result = $query->get_result();

    // Se existe o item, adiciona + 1
    if ($result->num_rows > 0) {
        $result = $result->fetch_assoc();
        $qtde_cart = $result['quantidade'];
        $query->close();

        // Verifica se excede o estoque
        if (($qtde_cart + 1) > $estoque_atual) {
            $_SESSION['titulo'] = 'Erro ao adicionar ao carrinho!';
            $_SESSION['popup_message'] = 'Você já adicionou ao carrinho a quantidade máxima disponível desse produto.';
            $_SESSION['type'] = 'error';
            $con->rollback();
            header("Location: ../cliente/detalhes_produto.php?id_produto=" . $id_produto);
            exit;
        }

        // Se ainda tem como adicionar, adiciona
        $sql = "UPDATE carrinho SET quantidade = quantidade + 1 WHERE id_cliente = ? AND id_produto = ?";
        $query = $con->prepare($sql);
        $query->bind_param("ii", $id_cliente, $id_produto);
        $query->execute();
        $query->close();

        $_SESSION['titulo'] = 'Mais 1 unidade do produto foi adicionada ao carrinho!';
        $_SESSION['popup_message'] = 'Clique no ícone de carrinho no menu ou rodapé e confira seus produtos salvos.';
        $_SESSION['type'] = 'success';

    } else {
        // Verifica se tem estoque
        if ($estoque_atual < 1) {
            $_SESSION['titulo'] = 'Erro ao adicionar ao carrinho!';
            $_SESSION['popup_message'] = 'Este produto não está mais disponível.';
            $_SESSION['type'] = 'error';
            $con->rollback();
            header("Location: ../cliente/detalhes_produto.php?id_produto=" . $id_produto);
            exit;
        }

        // Se o produto não está no carrinho e ele tem estoque, adiciona ao carrinho
        $sql = "INSERT INTO carrinho (id_produto, quantidade, selecionado, id_cliente) VALUES (?, 1, 1, ?)";
        $query = $con->prepare($sql);
        $query->bind_param("ii", $id_produto, $id_cliente);
        $query->execute();
        
        if ($query->affected_rows == 0) {
            $_SESSION['titulo'] = 'Erro ao adicionar!';
            $_SESSION['popup_message'] = 'Não foi possível adicionar o produto ao carrinho.';
            $_SESSION['type'] = 'error';
            $con->rollback();
            header("Location: ../cliente/detalhes_produto.php?id_produto=" . $id_produto);
            exit;
        }
        
        $query->close();

        $_SESSION['titulo'] = 'O produto foi adicionado com sucesso ao carrinho!';
        $_SESSION['popup_message'] = 'Clique no ícone de carrinho no menu ou rodapé e confira seus produtos salvos.';
        $_SESSION['type'] = 'success';
    }

    // COMMIT CRÍTICO - FALTANDO NO SEU CÓDIGO ORIGINAL
    $con->commit();

    header("Location: ../cliente/detalhes_produto.php?id_produto=" . $id_produto);
    exit;

} catch (Exception $e) {
    $con->rollback();
    $_SESSION['titulo'] = 'Erro!';
    $_SESSION['popup_message'] = 'Não foi possível adicionar ao carrinho. Erro: ' . $e->getMessage();
    $_SESSION['type'] = 'error';

    $pagina_anterior = $_SERVER['HTTP_REFERER'] ?? '../cliente/pg_inicial_cliente.php';
    header("Location: $pagina_anterior");
    exit;
}
?>