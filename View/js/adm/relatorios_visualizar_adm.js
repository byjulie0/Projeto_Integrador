$(function () {
    $.datepicker.regional['pt-BR'] = {
        closeText: 'Fechar',
        prevText: '&#x3C;Anterior',
        nextText: 'Próximo&#x3E;',
        currentText: 'Hoje',
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
            'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        dayNames: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
        weekHeader: 'Sem',
        dateFormat: 'dd/mm/yy',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['pt-BR']);

    $('#dataInicio').datepicker({
        onSelect: function (selectedDate) {
            $('#dataFim').datepicker('option', 'minDate', selectedDate);
            $('#dataFim').datepicker('show');
        }
    });

    $('#dataFim').datepicker({
        onSelect: function (selectedDate) {
            $('#dataInicio').datepicker('option', 'maxDate', selectedDate);
            atualizarPeriodo();
        }
    });

    $('#abrirCalendario').on('click', function (e) {
        e.preventDefault();
        $('#dataInicio').datepicker('show');
    });

    function atualizarPeriodo() {
        var inicio = $('#dataInicio').val();
        var fim = $('#dataFim').val();
        
        if (inicio && fim) {
            var inicioParts = inicio.split('/');
            var fimParts = fim.split('/');
            
            var inicioISO = inicioParts[2] + '-' + inicioParts[1] + '-' + inicioParts[0];
            var fimISO = fimParts[2] + '-' + fimParts[1] + '-' + fimParts[0];
            
            $('#dataEscolhida').text(inicio + ' - ' + fim);
            
            window.location.href = `relatorios_visualizar.php?data_inicio=${inicioISO}&data_fim=${fimISO}`;
        }
    }

    var dataInicioISO = $('#dataInicio').val();
    var dataFimISO = $('#dataFim').val();
    
    if (dataInicioISO && dataFimISO) {
        var inicioParts = dataInicioISO.split('-');
        var fimParts = dataFimISO.split('-');
        
        $('#dataInicio').val(inicioParts[2] + '/' + inicioParts[1] + '/' + inicioParts[0]);
        $('#dataFim').val(fimParts[2] + '/' + fimParts[1] + '/' + fimParts[0]);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const btnGerarPDF = document.getElementById('btnGerarPDF');
    
    if (btnGerarPDF) {
        btnGerarPDF.addEventListener('click', function() {
            gerarPDF();
        });
    }
});

function gerarPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    
    doc.setFontSize(20);
    doc.text("Relatório de Pedidos", 105, 15, { align: 'center' });
    
    doc.setFontSize(12);
    doc.text(`Período: ${document.getElementById('dataEscolhida').textContent}`, 15, 25);
    
    doc.text("Estatísticas Gerais:", 15, 40);
    doc.text(`- Pedidos gerados: ${document.querySelectorAll('.card_topo b')[1].textContent}`, 20, 50);
    doc.text(`- Produtos cadastrados: ${document.querySelectorAll('.card_topo b')[0].textContent}`, 20, 58);
    doc.text(`- Usuários cadastrados: ${document.querySelectorAll('.card_topo b')[2].textContent}`, 20, 66);
    
    try {
        var graficoEstatisticasImg = document.getElementById('graficoEstatisticas').toDataURL('image/png');
        var graficoBarraImg = document.getElementById('graficoBarraEstatisticas').toDataURL('image/png');
        var graficoLinhaImg = document.getElementById('graficoLinhaPedidos').toDataURL('image/png');
        
        doc.addPage();
        doc.text("Gráfico de Pizza - Status dos Pedidos", 15, 15);
        doc.addImage(graficoEstatisticasImg, 'PNG', 15, 20, 180, 90);
        
        doc.addPage();
        doc.text("Gráfico de Barras - Distribuição por Status", 15, 15);
        doc.addImage(graficoBarraImg, 'PNG', 15, 20, 180, 90);
        
        doc.addPage();
        doc.text("Gráfico de Linha - Variação Temporal", 15, 15);
        doc.addImage(graficoLinhaImg, 'PNG', 15, 20, 180, 90);
    } catch (e) {
        console.error("Erro ao capturar gráficos:", e);
    }
    
    doc.save('relatorio_pedidos_com_graficos.pdf');
}
$(function () {
    $.datepicker.regional['pt-BR'] = {
        closeText: 'Fechar',
        prevText: '&#x3C;Anterior',
        nextText: 'Próximo&#x3E;',
        currentText: 'Hoje',
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
            'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        dayNames: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
        weekHeader: 'Sem',
        dateFormat: 'dd/mm/yy',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['pt-BR']);

    // Configuração do campo de data de início
    $('#dataInicio').datepicker({
        onSelect: function (selectedDate) {
            $('#dataFim').datepicker('option', 'minDate', selectedDate);
            $('#dataFim').datepicker('show');
        }
    });

    // Configuração do campo de data de fim
    $('#dataFim').datepicker({
        onSelect: function (selectedDate) {
            $('#dataInicio').datepicker('option', 'maxDate', selectedDate);
            atualizarPeriodo();
        }
    });

    // Ação do botão "Mudar período"
    $('#abrirCalendario').on('click', function (e) {
        e.preventDefault();
        $('#dataInicio').datepicker('show');
    });

    // Atualiza as datas e envia o formulário
    function atualizarPeriodo() {
        var inicio = $('#dataInicio').val();
        var fim = $('#dataFim').val();

        if (inicio && fim) {
            var inicioParts = inicio.split('/');
            var fimParts = fim.split('/');

            var inicioISO = inicioParts[2] + '-' + inicioParts[1] + '-' + inicioParts[0];
            var fimISO = fimParts[2] + '-' + fimParts[1] + '-' + fimParts[0];

            $('#dataEscolhida').text(inicio + ' - ' + fim);  // Atualiza o texto exibido na tela

            // Envia o formulário com as novas datas
            window.location.href = `relatorios_visualizar.php?data_inicio=${inicioISO}&data_fim=${fimISO}`;
        }
    }

    // Preencher automaticamente as datas ao carregar a página
    var dataInicioISO = $('#dataInicio').val();
    var dataFimISO = $('#dataFim').val();
    
    if (dataInicioISO && dataFimISO) {
        var inicioParts = dataInicioISO.split('-');
        var fimParts = dataFimISO.split('-');
        
        $('#dataInicio').val(inicioParts[2] + '/' + inicioParts[1] + '/' + inicioParts[0]);
        $('#dataFim').val(fimParts[2] + '/' + fimParts[1] + '/' + fimParts[0]);
    }
});

let dataInicioSelecionada = null;

function mostrarToast(titulo, mensagem) {
    document.getElementById("toastTitulo").innerHTML = titulo;
    document.getElementById("toastMensagem").innerHTML = mensagem;
    document.getElementById("toast").classList.add("mostrar");
}

function fecharToast() {
    document.getElementById("toast").classList.remove("mostrar");
}

$(function() {
    $("#btnMudarPeriodo").on("click", function() {
        const $dialog = $("<div>").dialog({
            modal: true,
            title: "Selecionar Período",
            width: 480,
            close: function() {
                $(this).dialog("destroy").remove();
                dataInicioSelecionada = null;
            }
        });

        $dialog.html(`
            <p style="text-align:center; margin-bottom:20px; font-weight:600; color:#2c3e50;">
                Clique na <span style="color:#3498db">data inicial</span> → depois na <span style="color:#e74c3c">data final</span>
            </p>
            <div id="datepicker"></div>
        `);

        $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            firstDay: 1,
            onSelect: function(dateText) {
                if (!dataInicioSelecionada) {
                    dataInicioSelecionada = dateText;
                    mostrarToast("Data inicial selecionada",
                        "Você escolheu <strong>" + $.datepicker.formatDate('dd/mm/yy', new Date(dateText)) + 
                        "</strong> como início.<br>Agora clique na data final.");
                } else {
                    const dataFim = dateText;
                    if (new Date(dataInicioSelecionada) > new Date(dataFim)) {
                        mostrarToast("Erro", "A data inicial deve ser anterior à data final.");
                        dataInicioSelecionada = null;
                        return;
                    }

                    $("#hiddenInicio").val(dataInicioSelecionada);
                    $("#hiddenFim").val(dataFim);
                    $("#periodoSelecionado").text(
                        $.datepicker.formatDate('dd/mm/yy', new Date(dataInicioSelecionada)) + " - " + 
                        $.datepicker.formatDate('dd/mm/yy', new Date(dataFim))
                    );
                    $("#formFiltroData").submit();
                }
            }
        }).datepicker("setDate", new Date("<?php echo $data_inicio; ?>"));
    });
});