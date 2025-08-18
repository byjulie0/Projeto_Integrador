<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <link rel="stylesheet" href="/PROJETO_INTEGRADOR/view/public/css/adm.css">
    <link rel="stylesheet" href="/PROJETO_INTEGRADOR/view/public/css/cliente.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://fontawesome.com/icons/chevron-left?f=classic&s=solid">
</head>
<body>
    <?php include "../adm/menu_adm.php"; ?>

    <main class="verificar_administrar_pedidos_sessao_main">
        <div class="verificar_administrar_pedidos_sessao_info">
            <a href="javascript:history.back()" class="verificar_administrar_pedidos_sessao_seta_voltar">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <h1>Visualizar relatórios</h1>
            <h3 class="verificar_administrar_pedidos_sessao_mini_titulos_1">Mostrando relatórios referentes ao período: <span class="verificar_administrar_pedidos_sessao_titulo_destaque" id="dataEscolhida">XX/XX/XXXX - YY/YY/YYYY</span></h3>
            <div class="verificar_administrar_pedidos_sessao_periodo_bloco">
                <span class="verificar_administrar_pedidos_sessao_mini_titulos_2" id="abrirCalendario">Mudar período</span>
                <input type="text" id="dataInicio" style="display: none;">
                <input type="text" id="dataFim" style="display: none;">
                <hr class="verificar_administrar_pedidos_sessao_periodo_linha">
            </div>
        </div>

        <section class="verificar_administrar_pedidos_sessao_section">
            <div class="verificar_administrar_pedidos_sessao_coluna">
                <div class="verificar_administrar_pedidos_sessao_bloco">
                    <div class="verificar_administrar_pedidos_sessao_bloco_mini">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h5>Visualizações <br>totais do site: <span><h2>0</h2></span></h5>
                </div>
                <div class="verificar_administrar_pedidos_sessao_bloco">
                    <div class="verificar_administrar_pedidos_sessao_bloco_mini">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <h5>Vendas: <span><h2>0</h2></span></h5>
                </div>
                <div class="verificar_administrar_pedidos_sessao_bloco">
                    <div class="verificar_administrar_pedidos_sessao_bloco_mini">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </div>
                    <h5>Total de produtos cadastrados: <span><h2>0</h2></span></h5>
                </div>
                <div class="verificar_administrar_pedidos_sessao_bloco">
                    <div class="verificar_administrar_pedidos_sessao_bloco_mini">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h5>Usuários <br>cadastrados: <span><h2>0</h2></span></h5>
                </div>

                <div class="verificar_administrar_pedidos_sessao_estatisticas">
                    <h4>Estatísticas</h4>
                    <div class="verificar_administrar_pedidos_sessao_estatisticas_visualizacao">
                        <div class="verificar_administrar_pedidos_sessao_estatisticas_linhas_horizontais">
                            <div class="verificar_administrar_pedidos_sessao_estatisticas_linhas_dados">
                                <h6>20K</h6>
                                <hr>
                            </div>
                            <div class="verificar_administrar_pedidos_sessao_estatisticas_linhas_dados">
                                <h6>18K</h6>
                                <hr>
                            </div>
                            <div class="verificar_administrar_pedidos_sessao_estatisticas_linhas_dados">
                                <h6>15K</h6>
                                <hr>
                            </div>
                            <div class="verificar_administrar_pedidos_sessao_estatisticas_linhas_dados">
                                <h6>12K</h6>
                                <hr>
                            </div>
                            <div class="verificar_administrar_pedidos_sessao_estatisticas_linhas_dados">
                                <h6>10K</h6>
                                <hr>
                            </div>
                            <div class="verificar_administrar_pedidos_sessao_estatisticas_linhas_dados">
                                <h6>5K</h6>
                                <hr>
                            </div>
                            <div class="verificar_administrar_pedidos_sessao_estatisticas_linhas_dados">
                                <h6>2K</h6>
                                <hr>
                            </div>
                            <div class="verificar_administrar_pedidos_sessao_estatisticas_linhas_dados">
                                <h6>1K</h6>
                                <hr>
                            </div>
                            
                        </div>

                        <div class="verificar_administrar_pedidos_sessao_estatisticas_linhas_verticais">
                            <h6>D</h6><h6>S</h6><h6>T</h6><h6>Q</h6><h6>Q</h6><h6>S</h6><h6>S</h6>
                        </div>
                    </div>
                </div>

            </div>

            <div class="verificar_administrar_pedidos_sessao_coluna_direita">
                <div class="verificar_administrar_pedidos_sessao_bloco_vendas">
                    <h4>Vendas hoje</h4>
                    <h3>R$:0,00</h3>
                    <div class="verificar_administrar_pedidos_sessao_vendas_visualizacao">
                        <div class="verificar_administrar_pedidos_sessao_vendas_linhas_horizontais">
                            <h6>20K</h6>
                            <hr>
                        </div>
                        <div class="verificar_administrar_pedidos_sessao_vendas_linhas_horizontais">
                            <h6>18K</h6>
                            <hr>
                        </div>
                        <div class="verificar_administrar_pedidos_sessao_vendas_linhas_horizontais">
                            <h6>15K</h6>
                            <hr>
                        </div>
                        <div class="verificar_administrar_pedidos_sessao_vendas_linhas_horizontais">
                            <h6>12K</h6>
                            <hr>
                        </div>
                        <div class="verificar_administrar_pedidos_sessao_vendas_linhas_horizontais">
                            <h6>10K</h6>
                            <hr>
                        </div>
                        <div class="verificar_administrar_pedidos_sessao_vendas_linhas_horizontais">
                            <h6>5K</h6>
                            <hr>
                        </div>
                        <div class="verificar_administrar_pedidos_sessao_vendas_linhas_horizontais">
                            <h6>2K</h6>
                            <hr>
                        </div>
                        <div class="verificar_administrar_pedidos_sessao_vendas_linhas_horizontais">
                            <h6>1K</h6>
                            <hr>
                        </div>
                        
                        <div class="verificar_administrar_pedidos_sessao_vendas_linhas_verticais">
                            <h6>D</h6><h6>S</h6><h6>T</h6><h6>Q</h6><h6>Q</h6><h6>S</h6><h6>S</h6>
                        </div>
                    </div>
                </div>

                <div class="verificar_administrar_pedidos_sessao_bloco_atividades">
                    <h4>Atividades <br>recentes</h4>
                </div>
            </div>
        </section>
    </main>

    <?php include "../adm/footer_adm.php"; ?>

    <script src="/PROJETO_INTEGRADOR/view/JS/relatorios_visualizar_adm.js"></script>
</body>
</html>
