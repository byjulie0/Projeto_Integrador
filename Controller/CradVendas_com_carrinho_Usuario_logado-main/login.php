<?php
include "db.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // if (password_verify($senha, $usuario['senha'])) { //Implantar hash depois
        if ($senha == $usuario['senha']) {
            session_start();
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: produtos.php");
            exit;
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="E-mail" required><br><br>
        <input type="password" name="senha" placeholder="Senha" required><br><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
