// Início do Calendário + Gráfico
$(function () {

    // ---------- Configuração do Datepicker ----------
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

    // Inicia os dois calendários
    $('#dataInicio').datepicker({
        onSelect: function () {
            $('#dataFim').datepicker('show'); // abre o fim depois do início
        }
    });

    $('#dataFim').datepicker({
        onSelect: function () {
            atualizarPeriodo();
        }
    });

    // Botão "Mudar período"
    $('#abrirCalendario').on('click', function (e) {
        e.preventDefault();
        $('#dataInicio').datepicker('show');
    });

    // Atualiza o texto na tela
    function atualizarPeriodo() {
        var inicio = $('#dataInicio').val();
        var fim = $('#dataFim').val();
        if (inicio && fim) {
            $('#dataEscolhida').text(inicio + ' - ' + fim);
        }
    }


    // ---------- Configuração do Gráfico ----------
    if (document.getElementById('graficoEstatisticas')) {
        const ctx = document.getElementById('graficoEstatisticas').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Cancelados', 'Vendidos', 'Pendentes'],
                datasets: [{
                    data: [30, 50, 20], // <- você troca pelos dados reais depois
                    backgroundColor: ['#f28b82', '#aecbfa', '#fdd663']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
    }

});
// Fim do Calendário + Gráfico
