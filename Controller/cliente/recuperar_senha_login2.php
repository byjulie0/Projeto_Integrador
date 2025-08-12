<?php
include 'menu_recuperar_senha.php';

// Função para gerar código aleatório
function gerarCodigoRecuperacao($tamanho = 8) {
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle(str_repeat($caracteres, $tamanho)), 0, $tamanho);
}

$mensagem = '';

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_usuario = $_POST['email'] ?? '';

    if (filter_var($email_usuario, FILTER_VALIDATE_EMAIL)) {
        $codigo = gerarCodigoRecuperacao();

        // Salva no banco de dados
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=sua_base", "usuario", "senha");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("INSERT INTO codigos_recuperacao (email, codigo, criado_em) VALUES (?, ?, NOW())");
            $stmt->execute([$email_usuario, $codigo]);
        } catch (PDOException $e) {
            die("Erro ao salvar no banco: " . $e->getMessage());
        }

        // Configura o e-mail
        $assunto = "Código de Recuperação";
        $mensagem_email = "Seu código de recuperação é: $codigo";
        $headers = "From: suporte@seudominio.com\r\n";
        $headers .= "Reply-To: suporte@seudominio.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Envia o e-mail
        if (mail($email_usuario, $assunto, $mensagem_email, $headers)) {
            $mensagem = "Código enviado para o seu e-mail!";
        } else {
            $mensagem = "Erro ao enviar o e-mail. Verifique a configuração do servidor.";
        }
    } else {
        $mensagem = "E-mail inválido!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha</title>
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="recuperar_senha_codigo_body">

<main class="recuperar_senha_codigo_main">
    <section class="recuperar_senha_codigo_section">
        <a href="#" onclick="window.history.back(); return false;" class="recuperar_senha_codigo_seta_voltar">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <div class="recuperar_senha_codigo">
            <div class="recuperar_senha_codigo_content">
                <h1>Recuperar Senha</h1>
                <h3>Digite seu e-mail para receber o código</h3>

                <?php if (!empty($mensagem)) echo "<p>$mensagem</p>"; ?>

                <form method="POST">
                    <input type="email" name="email" placeholder="Digite seu e-mail" required>
                    <button type="submit">Enviar Código</button>
                </form>
            </div>
        </div>
    </section>
</main>

</body>
</html>

<?php include 'footer_cliente.php'; ?>
