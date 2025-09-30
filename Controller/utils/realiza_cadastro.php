<?php
session_start();

include '../../model/DB/conexao.php';

function validarCPF($cpf) {
    $cpf = preg_replace('/\D/', '', $cpf);

    if (strlen($cpf) != 11) return false;
    if (preg_match('/(\d)\1{10}/', $cpf)) return false;

    // Calcula o dígito verificador
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) return false;// Compara com o dígito do CPF
    }
    return true;
}

function validarCNPJ($cnpj) {
    $cnpj = preg_replace('/\D/', '', $cnpj);

    if (strlen($cnpj) != 14) return false;

    if (preg_match('/(\d)\1{13}/', $cnpj)) return false;

    $tamanho = [5,6];
    for ($i = 0; $i < 2; $i++) {
        $soma = 0;
        $peso = $tamanho[$i];
        for ($j = 0; $j < (12 + $i); $j++) {
            $soma += $cnpj[$j] * $peso;
            $peso--;
            if ($peso < 2) $peso = 9;
        }
        $digito = ($soma % 11 < 2) ? 0 : 11 - ($soma % 11); //Calcula dígito verificador
        if ($cnpj[12 + $i] != $digito) return false;
    }
    return true;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome            = $con->real_escape_string(trim($_POST['nome'] ?? ''));
    $cpf_cnpj        = $con->real_escape_string(trim($_POST['cpf_cnpj'] ?? ''));
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

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $cpf_cnpj = preg_replace('/\D/', '', $cpf_cnpj);

    if (strlen($cpf_cnpj) === 11) {
        if (!validarCPF($cpf_cnpj)) {
            die("Erro: CPF inválido.");
        }
    } elseif (strlen($cpf_cnpj) === 14) {
        if (!validarCNPJ($cpf_cnpj)) {
            die("Erro: CNPJ inválido.");
        }
    } else {
        die("Erro: CPF deve ter 11 dígitos ou CNPJ deve ter 14 dígitos.");
    }


    $query_insert = "
        INSERT INTO cliente (
            cliente_nome, email, senha, cpf_cnpj, data_nasc, telefone
        ) VALUES (
            '$nome', '$email', '$senha_hash', '$cpf_cnpj', '$data_nasc', '$telefone'
        )
    ";

    $result_insert = mysqli_query($con, $query_insert);

    if (!$result_insert) {
        die("Erro ao cadastrar: ");
    }

    $_SESSION['mensagem_sucesso'] = "Usuário cadastrado com sucesso!";
    $con->close();
    header("Location: ../../Controller/cliente/login.php");
    exit();
}
?>
