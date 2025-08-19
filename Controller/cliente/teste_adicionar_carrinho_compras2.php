<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produto</title>
</head>
<body>
    <h2>Mouse Gamer</h2>
    <p>Preço: R$ 120,50</p>

    <!-- Cliente com ID fixo 1 (exemplo) -->
    <form action="teste_adicionar_carrinho_compras.php" method="POST">
        <input type="hidden" name="id_cliente" value="1"> 
        <input type="hidden" name="id_produto" value="1"> 
        <button type="submit">Adicionar ao Carrinho</button>
    </form>

    <br>
    <a href="carrinho.php?id_cliente=1">Ver Carrinho</a>
</body>
</html>
