
<?php


if (!isset($_SESSION['id_cliente'])) {
    header(header: "Location: ../cliente/login.php");
    exit;
}
include 'menu_pg_inicial.php';
// include '../../model/DB/conexao.php';
// session_start();
 
// Supondo que o ID do cliente está salvo na sessão
// $id_cliente = $_SESSION['id_cliente'];
 
// $sql = "SELECT c.*, e.rua, e.numero, e.bairro, e.pais, e.cep FROM cliente c
//         JOIN endereco e ON c.endereco_idendereco = e.id_endereco
//         WHERE c.id_cliente = $id_cliente";
 
// $result = $con->query(query: $sql);
 
// if ($result->num_rows > 0) {
//     $cliente = $result->fetch_assoc();
// } else {
//     echo "Cliente não encontrado.";
//     exit;
// }
?>
 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Meus Dados</title>
    <link rel="stylesheet" href="../../View/Public/css/cliente/meu_perfil_editar.css">
</head>
 
<body>

    <!-- php if (isset($_GET['atualizado'])): ?>
        <div class="alert-success">Seus dados foram atualizados com sucesso!</div>
    php endif; ?> -->
    
    <main class="client-edit-main">
        <div class="client-edit-container">
       
 
            <form class="client-edit-form" method="POST" action="atualiza_cliente.php">
                     
                <div class="client-edit-header">
                    <h1 class="client-edit-title-titulo">
                    <a href="#"><i class="bi bi-chevron-left" onclick="window.history.back(); return false;"></i></a>
                    Editar meus dados</h1>
                </div>
                
                <input type="hidden" name="id_cliente" value="<?= $id_cliente ?>">
                <div class="client-edit-grid">
                    <div class="client-edit-column">
                        <div class="client-edit-field-group">
                            <label for="cliente_nome" class="client-edit-label">Nome:</label>
                            
                            <input type="text" name="cliente_nome" class="client-edit-input">
                        </div>
 
                        <div class="client-edit-field-group">
                            <label for="telefone" class="client-edit-label">Telefone:</label>
                            <input type="tel" name="telefone" class="client-edit-input">
                        </div>
 
                        <div class="client-edit-field-group">
                            <label for="email" class="client-edit-label">E-mail:</label>
                            <input type="email" name="email" class="client-edit-input">
                        </div>
                    </div>
 
                    <div class="client-edit-column">
                        <div class="client-edit-field-group">
                            <label for="endereco" class="client-edit-label">Endereço:</label>
                            <input type="text" name="endereco" class="client-edit-input">
                        </div>
 
                        <div class="client-edit-field-group">
                            <label for="data_nasc" class="client-edit-label">Data de nascimento:</label>
                            <input type="text" name="data_nasc" class="client-edit-input">
                        </div>
                    </div>
                </div>
 
                <div class="client-edit-warning">
                    <strong>Atenção:</strong> Sua idade só pode ser alterada 1 única vez...
                </div>
 
                <div class="client-edit-actions">
                    <a href="formulario_altera_senha.php">
                        <button type="button" class="client-edit-password-btn">Alterar senha</button>
                    </a>
                    <button type="submit" class="client-edit-password-btn">Salvar</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
 
<?php include 'footer_cliente.php'; ?>