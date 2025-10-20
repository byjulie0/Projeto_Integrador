<?php
include '../../model/DB/conexao.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="teste_validacao_user.php" method="POST">
    <label>Nome:</label>
    <input type="text" name="user_nome" required><br><br>
    
    <label>Senha:</label>
    <input type="password" name="senha" required><br><br>

    <button type="submit">Testar Login</button>
</form>

    
</body>
</html>