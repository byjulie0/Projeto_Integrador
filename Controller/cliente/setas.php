<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seta de Voltar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .seta-voltar {
            position: absolute;
            top: 50px;
            left: 95px;
            font-size: 30px;
            color: var(--primary-color-1);
            text-decoration: none;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .seta-voltar:hover {
            color: darkblue;
        }

        @media (max-width: 600px) {
            .seta-voltar {
                top: 30px;
                left: 20px;
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <a href="javascript:history.back()" class="seta-voltar">
        <i class="fa-solid fa-chevron-left"></i>
    </a>
</body>
</html>