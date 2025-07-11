$(function() {
  $('#inputCalendario').datepicker({
    onSelect: function(dateText) {
        $('#dataEscolhida').text("Data escolhida: " + dateText);
    }
  });

  $('#abrirCalendario').on('click', function() {
      $('#inputCalendario').datepicker('show');
  });
});

// function teste() {
//   alert('JavaScript está funcionando!');
// }
// teste();