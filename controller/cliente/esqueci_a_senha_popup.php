<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F7F7F7;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .esqueci_senha_card_popup {
            background-color: #DFEBE0;
            width: 45vw;
            min-height: 45vh;
            border-radius: 2px;
            box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            text-align: center;
        }

        .esqueci_senha_popup_texto {
            color: #40513b;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .esqueci_senha_popup_linha {
            width: 80%;
            height: 1px;
            background-color: #2E7D32;
            border: none;
            margin: 1rem 0;
        }

        .esqueci_senha_popup_botao {
            background-color: #ffffff;
            color: #2E7D32;
            border: none;
            border-radius: 2px;
            padding: 0.75rem 1.5rem;
            margin-top: 1.5rem;
            cursor: pointer;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .esqueci_senha_popup_botao:hover {
            background-color: #557153;
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .esqueci_senha_card_popup {
                width: 85vw;
                min-height: 40vh;
                padding: 1.5rem;
            }

            .esqueci_senha_popup_texto {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="esqueci_senha_card_popup">
        <h3 class="esqueci_senha_popup_texto">Senha redefinida com sucesso!</h3>
        <hr class="esqueci_senha_popup_linha">
        <?php
        $texto = "Login";
        include 'botao_cliente.php';
        ?>
    </div>
</body>

</html>