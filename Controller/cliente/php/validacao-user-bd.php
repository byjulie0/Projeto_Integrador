<?php
session_start();
include '../../model/DB/conexao.php'; // arquivo com a conexão ao banco

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar consulta segura para evitar SQL Injection
    $stmt = "SELECT * FROM user WHERE user_nome = '{$username}';";
    echo $stmt;
    $result = mysqli_query($con,$stmt);
    $row = mysqli_num_rows($result);
    echo $row;

    if ($row>0){
        
        $query = "select * from user";

        $retorno = mysqli_fetch_array($result);
        echo $retorno["user_nome"];
        echo $retorno["senha"];

        if ($retorno["senha"] == $password)
        {
            $_SESSION["username"] = $username;
            header("Location: pg_inicial_cliente.php");
        }
        else{
            echo  "senha invalida ";
        }
    }
    
/*
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifica senha
        if (password_verify($password, $user['senha'])) {
            // Usuário autenticado
            $_SESSION['username'] = $user['cliente_nome'];
            header("Location: pg_inicial_cliente.php"); // redireciona para página inicial
            exit();
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }

    $stmt->close();
    $con->close();
}
?>
<?php
$senhas = ['senha123', 'teste456', 'admin123', 'usuario456', 'johnrooster'];

foreach ($senhas as $senha) {
    echo "Senha: $senha <br>";
    echo "Hash: " . password_hash($senha, PASSWORD_DEFAULT) . "<br><br>";*/
}
?>