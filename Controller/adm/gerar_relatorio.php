<?php
include '../utils/autenticado_adm.php';
include 'menu_inicial.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Relatório</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm/gerar_relatorio.css">
</head>

<body class="body_generate_report">
    <div class="area_container">
        <div class="title_page_generate_report">
            <a href="#" class="arrow_generate_report">
                <i class="bi bi-chevron-left"></i>
            </a>
            <h1 class="title_generate_report">Gerar Relatório</h1>
        </div>
        <section class="generate_report_area">
            <article class="input_report_category">
                <span>Escolha a categoria do relatório</span>
                <select name="categories" id="categories" class="report_category_select" required>
                    <option value="" selected disabled>Categoria</option>
                    <option value="bovinos" class="report_categories">Todos</option>
                    <option value="bovinos" class="report_categories">Bovinos</option>
                    <option value="equinos" class="report_categories">Equinos</option>
                    <option value="galinaceos" class="report_categories">Galináceos</option>
                    <option value="premiados" class="report_categories">Premiados</option>
                    <option value="produtos_gerais" class="report_categories">Produtos Gerais</option>
                </select>
            </article>
            <article class="generate_report_start_date">
                <span>Data de início</span>
                <input type="date" class="generate_report_date">
            </article>
            <article class="generate_report_end_date">
                <span>Data final</span>
                <input type="date" class="generate_report_date">
            </article>
        </section>
        <div class="generate_report_submit_button">
            <?php
            $texto = "Gerar";
            include 'botao_adm.php';
            ?>
        </div>
    </div>
</body>

</html>
<?php
include 'footer.php';
?>