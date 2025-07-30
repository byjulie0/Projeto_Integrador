// Início do Calendário

$(function () {

  // Configuração manual regional do calendário
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
          atualizarPeriodo();
      }
  });

  $('#dataFim').datepicker({
      onSelect: function () {
          atualizarPeriodo();
      }
  });

  $('#abrirCalendario').on('click', function () {
      $('#dataInicio, #dataFim').datepicker('show');
      $('#dataInicio').show();
      $('#dataFim').show();
  });

  function atualizarPeriodo() {
      var inicio = $('#dataInicio').val();
      var fim = $('#dataFim').val();

      if (inicio && fim) {
          $('#dataEscolhida').text(inicio + ' - ' + fim);
      }
  }
});

// Fim do Calendário