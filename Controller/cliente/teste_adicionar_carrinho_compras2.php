<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar ao Carrinho</title>
</head>
<body>
    <h2>Simulação de Carrinho de Compras</h2>

    <form action="teste_adicionar_carrinho_compras.php" method="POST">
        <label>Cliente (ID):</label>
        <input type="number" name="id_cliente" required><br><br>

        <label>Produto (ID):</label>
        <input type="number" name="id_produto" required><br><br>

        <label>Quantidade:</label>
        <input type="number" name="quantidade" value="1" min="1"><br><br>

        <label>Selecionado:</label>
        <input type="checkbox" name="selecionado" value="1"> (marque para selecionar)<br><br>

        <button type="submit">Adicionar ao Carrinho</button>
    </form>
</body>
</html>
