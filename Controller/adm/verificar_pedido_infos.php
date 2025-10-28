<?php
include '../utils/autenticado_adm.php';
include 'menu_inicial.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar e administrar pedidos</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../view/public/css/adm/verificar_pedido_infos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <section id="informacoes-pedidos">
        <div id="title-informacoes-pedidos">
            <a href="#"><i class="bi bi-chevron-left"></i></a>
            <h3>Verificar e administrar pedidos</h3>
        </div>
        <div id="subtitle-informacoes-pedidos">
            <div id="id-pedido-informacoes-pedidos">
                <span>ID do pedido: </span>
                <!-- adicionar variável do id do pedido -->
            </div>
        </div>
        <div id="page-content-informacoes-pedidos">
            <div id="first-container-informacoes-pedidos">
                <div class="product-card-informacoes-pedidos">
                    <div class="product-card-informacoes-pedidos1">
                        <div class="product-title">
                            <span>Nome do produto</span>
                        </div>
                        <div class="minor-label-informacoes-pedidos">
                            <span>
                                Pendente
                            </span>
                        </div>
                        <div class="product-informations-informacoes-pedidos">
                            <div class="img-and-label-informacoes-pedidos">
                                <img src="../..//View/Public/Imagens/Rectangle 195.png"     alt="">
                                <div class="informations-informacoes-pedidos">
                                    <span class="type-informacoes-pedidos">
                                        Galináceo
                                    </span>
                                    <span class="name-informacoes-pedidos">
                                        Galo Rhode Island
                                    </span>
                                    <span class="lote-informacoes-pedidos">
                                        Macho
                                    </span>
                                    <span class="purchase-date-informacoes-pedidos">
                                        Data do pedido:
                                    </span>
                                </div>
                            </div>
                            <div class="final-price-informacoes-pedidos">
                                <p>Valor Total</p>
                                <div class="price-informacoes-pedidos">
                                    <div class="valor-final-informacoes-pedidos">
                                        <span>R$2.850,00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="buttons-area-informacoes-pedidos">
                        <div class="left-buttons-informacoes-pedidos">
                            <button>Cancelar pedido</button>
                        </div>
                        <div class="right-buttons-informacoes-pedidos">
                            <?php
                            $texto = "Concluído";
                            include 'botao_verde_adm.php';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="second-container-informacoes-pedidos">
                <div class="client-data-card-informacoes-pedidos">
                    <span id="client-data-title-span-informacoes-pedidos">
                        Dados do cliente
                    </span>
                    <div class="client-data-spans-informacoes-pedidos">
                        <i class="fa-solid fa-user"></i>
                        <span class="client-data-type-informacoes-pedidos1">
                            Nome:
                        </span>
                        <span class="client-data-informacoes-pedidos">
                            John Rooster
                        </span>
                    </div>

                    <div class="client-data-spans-informacoes-pedidos">
                        <i class="fa-solid fa-lock"></i>
                        <span class="client-data-type-informacoes-pedidos1">
                            CPF/CNPJ:
                        </span>
                        <span class="client-data-informacoes-pedidos">
                            000000000-00
                        </span>
                    </div>

                    <div class="client-data-spans-informacoes-pedidos">
                        <i class="fa-solid fa-envelope"></i>
                        <span class="client-data-type-informacoes-pedidos1">
                            E-mail:
                        </span>
                        <span class="client-data-informacoes-pedidos">
                            sample123@hotmail.com
                        </span>
                    </div>

                    <div class="client-data-spans-informacoes-pedidos">
                        <i class="fa-solid fa-phone"></i>
                        <span class="client-data-type-informacoes-pedidos1">
                            Telefone:
                        </span>
                        <span class="client-data-informacoes-pedidos">
                            +55 67 912345-6789
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

<?php include 'footer.php';?>