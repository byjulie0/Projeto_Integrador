<?php
include 'menu_pg_inicial.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Meus Dados</title>
    <link rel="stylesheet" href="../../view/public/css/cliente.css">
</head>
<body>
    <div class="container-principal">
        <header class="cabecalho-formulario">
        <a href="#" class="setinha_forms_mudar_senha">
                    <i class="fa-solid fa-chevron-left">
                    </i>
                </a>
            <h1 class="titulo-pagina">Editar meus dados</h1>
        </header>

        <main class="conteudo-formulario">
            <form class="formulario-dados">
                <div class="container-campos">
                    <div class="grupo-campo">
                        <label class="rotulo-campo" for="campo-nome">Nome:</label>
                        <input 
                            type="text" 
                            id="campo-nome" 
                            class="campo-entrada" 
                            placeholder="Fulano da Silva Pinto Soares"
                            required
                        >
                    </div>

                    <div class="grupo-campo">
                        <label class="rotulo-campo" for="campo-endereco">Endereço:</label>
                        <input 
                            type="text" 
                            id="campo-endereco" 
                            class="campo-entrada" 
                            placeholder="Rua General Exemplo do Exemplo, 24..."
                            required
                        >
                    </div>

                    <div class="grupo-campo">
                        <label class="rotulo-campo" for="campo-telefone">Telefone:</label>
                        <input 
                            type="tel" 
                            id="campo-telefone" 
                            class="campo-entrada" 
                            placeholder="+55 67 XXXXX-XXXX"
                            required
                        >
                    </div>

                    <div class="grupo-campo">
                        <label class="rotulo-campo" for="campo-nascimento">Data de nascimento:</label>
                        <input 
                            type="text" 
                            id="campo-nascimento" 
                            class="campo-entrada" 
                            placeholder="XX/XX/XXXX"
                            required
                        >
                    </div>

                    <div class="grupo-campo campo-completo">
                        <label class="rotulo-campo" for="campo-email">E-mail:</label>
                        <input 
                            type="email" 
                            id="campo-email" 
                            class="campo-entrada" 
                            placeholder="sample123@gmail.com"
                            required
                        >
                    </div>
                </div>

                <div class="aviso-dados">
                    Atenção: Seus dados só poderão ser alterados 1 vezes por mês após serem atualizados, por questões de segurança. Certifique-se de que todas as informações estão corretas antes de salvar. Ao alterar os dados, você aceita os termos de uso e política de privacidade da nossa plataforma.
                </div>

                <div class="container-botoes">
                    <button type="button" class="botao-alterar-senha">
                        Alterar senha
                    </button>
                    <button type="submit" class="botao-salvar">
                        Salvar
                    </button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
<?php
        include 'footer_cliente.php';
        ?>