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
            
            window.location.href = `relatorio_visualizar.php?data_inicio=${inicioISO}&data_fim=${fimISO}`;
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
