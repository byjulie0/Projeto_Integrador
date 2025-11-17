$(document).ready(function () {

    $(document).on("click", ".icon-toggle-btn", function () {
        let btn = $(this);
        let id = btn.data("id");

        $.post("toggle_cliente.php", { id_cliente: id }, function (res) {
            if (res.success) {
            if (res.novo_status == 0) {
              btn.attr("aria-pressed", "true").html('<i class="fa-solid fa-toggle-on"></i>');
              btn.closest('tr').find('td:last').text('Inativo');
            } else {
              btn.attr("aria-pressed", "false").html('<i class="fa-solid fa-toggle-off"></i>');
              btn.closest('tr').find('td:last').text('Ativo');
            }
          } else {
            alert("Erro ao atualizar status!");
          }
        }, "json");
    });

$('#campo-busca').on('input', function () {
  const termo = $(this).val();

  $.ajax({
    url: '../../Controller/utils/buscar_clientes.php',
    method: 'POST',
    dataType: 'json',
    data: { busca: termo },
    success: function (clientes) {
      let html = '';

      if (clientes.length) {
        clientes.forEach(c => {
          html += `
            <tr>
              <td>${c.cliente_nome}</td>
              <td>${c.cpf_cnpj}</td>
              <td>${new Date(c.data_nasc).toLocaleDateString('pt-BR')}</td>
              <td>
                <button type="button" class="icon-toggle-btn" data-id="${c.id_cliente}" aria-pressed="${c.user_ativo == 0 ? 'true' : 'false'}">
                  <i class="fa-solid ${c.user_ativo == 0 ? 'fa-toggle-on' : 'fa-toggle-off'}"></i>
                </button>
              </td>
              <td>${c.user_ativo == 0 ? 'Inativo' : 'Ativo'}</td>
            </tr>
          `;

        });
      } else {
        html = `<tr><td colspan="5" style="text-align:center;">Nenhum cliente encontrado.</td></tr>`;
      }

      $('#table2-gerenciar-clientes table tbody').html(html);
    },
    error: function () {
      alert('Erro ao buscar clientes.');
    }
  });
});


})

$('#btn-inativos').click(function(e) {
    e.preventDefault();

    $.ajax({
        url: '../../Controller/utils/buscar_clientes.php',
        method: 'POST',
        dataType: 'json',
        data: { inativos: 1 },  
        success: function(clientes) {
            let html = '';

            if (clientes.length) {
                clientes.forEach(c => {
                   html += `
                    <tr>
                      <td>${c.cliente_nome}</td>
                      <td>${c.cpf_cnpj}</td>
                      <td>${new Date(c.data_nasc).toLocaleDateString('pt-BR')}</td>
                      <td>
                        <button type="button" class="icon-toggle-btn" data-id="${c.id_cliente}" aria-pressed="${c.user_ativo == 0 ? 'true' : 'false'}">
                          <i class="fa-solid ${c.user_ativo == 0 ? 'fa-toggle-on' : 'fa-toggle-off'}"></i>
                        </button>
                      </td>
                      <td>${c.user_ativo == 0 ? 'Inativo' : 'Ativo'}</td>
                    </tr>
                  `;
                });
            } else {
                html = `<tr><td colspan="5" style="text-align:center;">Nenhum cliente encontrado.</td></tr>`;
            }

            $('#table2-gerenciar-clientes table tbody').html(html);
        },
        error: function() {
            alert('Erro ao buscar clientes inativos.');
        }
    });
});
