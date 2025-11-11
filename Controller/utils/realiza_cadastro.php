<?php
session_start();

include '../../model/DB/conexao.php';

function validarCPF($cpf) {
    $cpf = preg_replace('/\D/', '', $cpf);

    if (strlen($cpf) != 11) return false;
    if (preg_match('/(\d)\1{10}/', $cpf)) return false;

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) return false;
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
        $digito = ($soma % 11 < 2) ? 0 : 11 - ($soma % 11);
        if ($cnpj[12 + $i] != $digito) return false;
    }
    return true;
}

function validarEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    
    // Verifica se tem domínio válido (não aceita .co sem mais nada, etc)
    $dominiosInvalidos = ['.co', '.c', '.om'];
    foreach ($dominiosInvalidos as $dominio) {
        if (substr($email, -strlen($dominio)) === $dominio) {
            return false;
        }
    }
    
    // Verifica se o domínio tem pelo menos 2 caracteres após o último ponto
    $partes = explode('@', $email);
    if (count($partes) === 2) {
        $dominio = $partes[1];
        $ultimoPonto = strrpos($dominio, '.');
        if ($ultimoPonto !== false) {
            $extensao = substr($dominio, $ultimoPonto + 1);
            if (strlen($extensao) < 2) {
                return false;
            }
        }
    }
    
    return true;
}

// Recaptcha
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../cliente/pg_cadastro.php?error=metodo');
    exit;
}

$recaptcha_secret = getenv('RECAPTCHA_SECRET') ?: '6LdyqOUrAAAAAF1olqup_tnkbPYxEHydWJkhAgHO';
$recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

if (empty($recaptcha_response)){
    $_SESSION['popup_type'] = 'erro';
    $_SESSION['popup_message'] = 'Por favor, marque o reCAPTCHA antes de enviar o formulário.';
    header('Location: ../cliente/pg_cadastro.php');
    exit;
}

$verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
$data = [
    'secret'   => $recaptcha_secret,
    'response' => $recaptcha_response,
    'remoteip' => $_SERVER['REMOTE_ADDR']
];
    
$ch = curl_init($verifyUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$verification = json_decode($response, true);

if (!isset($verification['success']) || $verification['success'] !== true) {
    $_SESSION['popup_type'] = 'erro';
    $_SESSION['popup_message'] = 'Validação reCAPTCHA falhou! Por favor, tente novamente.';
    header('Location: ../cliente/pg_cadastro.php');
    exit;
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

    // Salvar dados do formulário na sessão para recarregar
    $_SESSION['form_data'] = [
        'nome' => $nome,
        'cpf_cnpj' => $_POST['cpf_cnpj'],
        'email' => $email,
        'data_nascimento' => $data_nasc,
        'telefone' => $telefone
    ];

    // Validação de email
    if (!validarEmail($email)) {
        $_SESSION['popup_type'] = 'erro';
        $_SESSION['popup_message'] = 'Email inválido! Use o padrão: email@empresa.com.br';
        header('Location: ../cliente/pg_cadastro.php');
        exit;
    }

    // Verifica se email já existe
    $query_email = "SELECT email FROM cliente WHERE email = '$email'";
    $result_email = mysqli_query($con, $query_email);
    if (mysqli_num_rows($result_email) > 0) {
        $_SESSION['popup_type'] = 'erro';
        $_SESSION['popup_message'] = 'Este email já está cadastrado! Por favor, use outro email.';
        header('Location: ../cliente/pg_cadastro.php');
        exit;
    }

    // Validação de senha
    if ($senha !== $senha_confirmar) {
        $_SESSION['popup_type'] = 'erro';
        $_SESSION['popup_message'] = 'As senhas não coincidem. Por favor, verifique e tente novamente.';
        header('Location: ../cliente/pg_cadastro.php');
        exit;
    }

    if (strlen($senha) < 6) {
        $_SESSION['popup_type'] = 'erro';
        $_SESSION['popup_message'] = 'A senha precisa ter no mínimo 6 caracteres.';
        header('Location: ../cliente/pg_cadastro.php');
        exit;
    }

    // Validação de data de nascimento
    $nascimento = DateTime::createFromFormat('Y-m-d', $data_nasc);
    if (!$nascimento) {
        $_SESSION['popup_type'] = 'erro';
        $_SESSION['popup_message'] = 'Data de nascimento inválida.';
        header('Location: ../cliente/pg_cadastro.php');
        exit;
    }

    $hoje = new DateTime();
    $idade = $hoje->diff($nascimento)->y;
    if ($idade < 18) {
        $_SESSION['popup_type'] = 'erro';
        $_SESSION['popup_message'] = 'Você precisa ter pelo menos 18 anos para se cadastrar.';
        header('Location: ../cliente/pg_cadastro.php');
        exit;
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Validação de CPF/CNPJ
    $cpf_cnpj = preg_replace('/\D/', '', $cpf_cnpj);

    if (strlen($cpf_cnpj) === 11) {
        if (!validarCPF($cpf_cnpj)) {
            $_SESSION['popup_type'] = 'erro';
            $_SESSION['popup_message'] = 'CPF inválido! Por favor, verifique o número digitado.';
            header('Location: ../cliente/pg_cadastro.php');
            exit;
        }
    } elseif (strlen($cpf_cnpj) === 14) {
        if (!validarCNPJ($cpf_cnpj)) {
            $_SESSION['popup_type'] = 'erro';
            $_SESSION['popup_message'] = 'CNPJ inválido! Por favor, verifique o número digitado.';
            header('Location: ../cliente/pg_cadastro.php');
            exit;
        }
    } else {
        $_SESSION['popup_type'] = 'erro';
        $_SESSION['popup_message'] = 'CPF deve ter 11 dígitos ou CNPJ deve ter 14 dígitos.';
        header('Location: ../cliente/pg_cadastro.php');
        exit;
    }

    // Verifica se CPF/CNPJ já existe
    $query_cpf = "SELECT cpf_cnpj FROM cliente WHERE cpf_cnpj = '$cpf_cnpj'";
    $result_cpf = mysqli_query($con, $query_cpf);
    if (mysqli_num_rows($result_cpf) > 0) {
        $_SESSION['popup_type'] = 'erro';
        $_SESSION['popup_message'] = 'Este CPF/CNPJ já está cadastrado!';
        header('Location: ../cliente/pg_cadastro.php');
        exit;
    }

    // Se chegou aqui, limpa os dados do formulário
    unset($_SESSION['form_data']);

    // Inserção no banco
    $query_insert = "
        INSERT INTO cliente (
            cliente_nome, email, senha, cpf_cnpj, data_nasc, telefone
        ) VALUES (
            '$nome', '$email', '$senha_hash', '$cpf_cnpj', '$data_nasc', '$telefone'
        )
    ";

    $result_insert = mysqli_query($con, $query_insert);

    if (!$result_insert) {
        $_SESSION['popup_type'] = 'erro';
        $_SESSION['popup_message'] = 'Falha ao realizar cadastro! Por favor, tente novamente.';
        header('Location: ../cliente/pg_cadastro.php');
        exit;
    }

    // Sucesso!
    $_SESSION['popup_type'] = 'sucesso';
    $_SESSION['popup_message'] = 'Cadastro realizado com sucesso! Você será redirecionado para o login.';
    $con->close();
    header("Location: ../cliente/pg_cadastro.php?success=1");
    exit();
}
?>