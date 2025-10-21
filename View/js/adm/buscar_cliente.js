$(document).ready(function () {

    $(document).on("click", ".icon-toggle-btn", function () {
        let btn = $(this);
        let id = btn.data("id");

        $.post("toggle_cliente.php", { id_cliente: id }, function (res) {
            if (res.success) {
                if (res.novo_status == 0) {
                    btn.attr("aria-pressed", "true").html('<i class="fa-solid fa-toggle-on"></i>');
                } else {
                    btn.attr("aria-pressed", "false").html('<i class="fa-solid fa-toggle-off"></i>');
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
              <td><input type="checkbox" name="cliente[]" value="${c.id_cliente}" class="cliente-checkbox"></td>
              <td>${c.cliente_nome}</td>
              <td>${c.cpf_cnpj}</td>
              <td>${new Date(c.data_nasc).toLocaleDateString('pt-BR')}</td>
              <td>
                <button type="button" class="icon-toggle-btn" data-id="${c.id_cliente}" aria-pressed="${c.user_ativo == 0 ? 'true' : 'false'}">
                  <i class="fa-solid ${c.user_ativo == 0 ? 'fa-toggle-on' : 'fa-toggle-off'}"></i>
                </button>
              </td>
              <td>${c.user_ativo}</td>
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
                            <td><input type="checkbox" name="cliente[]" value="${c.id_cliente}" class="cliente-checkbox"></td>
                            <td>${c.cliente_nome}</td>
                            <td>${c.cpf_cnpj}</td>
                            <td>${new Date(c.data_nasc).toLocaleDateString('pt-BR')}</td>
                            <td>
                                <button type="button" class="icon-toggle-btn" data-id="${c.id_cliente}" aria-pressed="${c.user_ativo == 0 ? 'true' : 'false'}">
                                    <i class="fa-solid ${c.user_ativo == 0 ? 'fa-toggle-on' : 'fa-toggle-off'}"></i>
                                </button>
                            </td>
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
