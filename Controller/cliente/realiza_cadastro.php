<?php
session_start();

$host = "192.168.22.9";
$usuario = "turma143p1";
$senha = "sucesso@143";
$bd = "143p1";

$con = new mysqli($host, $usuario, $senha, $bd);

if ($con->connect_errno) {
    die("Falha na conexão: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome            = $con->real_escape_string(trim($_POST['nome'] ?? ''));
    $cpf_cnpj        = $con->real_escape_string(trim($_POST['cpf_cnpj'] ?? ''));
    $user_nome       = $con->real_escape_string(trim($_POST['user_nome'] ?? ''));
    $email           = $con->real_escape_string(trim($_POST['email'] ?? ''));
    $data_nasc       = $con->real_escape_string(trim($_POST['data_nascimento'] ?? ''));
    $telefone        = $con->real_escape_string(trim($_POST['telefone'] ?? ''));
    $cep             = $con->real_escape_string(trim($_POST['CEP'] ?? ''));
    $senha           = $_POST['senha'] ?? '';
    $senha_confirmar = $_POST['senha-confirmar'] ?? '';

    if ($senha !== $senha_confirmar) {
        die("Erro: As senhas não coincidem.");
    }

    if (strlen($senha) < 6) {
        die("Erro: A senha precisa ter no mínimo 6 caracteres.");
    }

    $nascimento = DateTime::createFromFormat('Y-m-d', $data_nasc);
    if (!$nascimento) {
        die("Erro: Data de nascimento inválida.");
    }

    $hoje = new DateTime();
    $idade = $hoje->diff($nascimento)->y;
    if ($idade < 18) {
        die("Erro: Você precisa ter pelo menos 18 anos para se cadastrar.");
    }

    $senha_s = $con->real_escape_string($senha);


    $query_insert = "
        INSERT INTO cliente (
            cliente_nome, email, senha, cpf_cnpj, data_nasc, user_ativo, telefone, cep
        ) VALUES (
            '$nome', '$email', '$senha_s', '$cpf_cnpj', '$data_nasc', 1, '$telefone', '$cep'
        )
    ";

    $result_insert = mysqli_query($con, $query_insert);

    if (!$result_insert) {
        die("Erro ao cadastrar: "); 
    }

    $_SESSION['mensagem_sucesso'] = "Usuário cadastrado com sucesso!";
    $con->close();
    header("Location: login.php");
    exit();
}
?>