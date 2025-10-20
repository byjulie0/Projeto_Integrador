   $(document).ready(function() {

            function atualizarTabela(produtos) {
                let html = '';

                if (produtos.length) {
                    produtos.forEach(p => {
                        const icone = p.produto_ativo == 1 ? 'fa-toggle-on' : 'fa-toggle-off';
                        const ariaPressed = p.produto_ativo == 1 ? 'true' : 'false';
                        const precoFormatado = 'R$ ' + Number(p.preco).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

                        html += `
                            <tr>
                                <td>${p.produto}</td>
                                <td>${p.categoria ?? '--'}</td>
                                <td>${p.subcategoria ?? '--'}</td>
                                <td>${precoFormatado}</td>
                                <td>
                                    <a href="editar_produto.php?id=${p.id_produto}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <form method="POST" action="toggle_adm_inativar.php" style="display:inline;">
                                        <input type="hidden" name="id_produto" value="${p.id_produto}">
                                        <input type="hidden" name="status_atual" value="${p.produto_ativo}">
                                        <button type="submit" class="icon-toggle-btn" aria-pressed="${ariaPressed}">
                                            <i class="fa-solid ${icone}"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    html = `<tr><td colspan="6" style="text-align:center;">Nenhum produto encontrado.</td></tr>`;
                }

                $('#table2-atualizar-produtos table tbody').html(html);
            }

            function buscarProdutos(termo = '') {
                $.ajax({
                    url: '../../Controller/utils/buscar_produtos.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { busca: termo },
                    success: function(resposta) {
                        atualizarTabela(resposta);
                    },
                    error: function() {
                        console.log('Erro ao buscar produtos.');
                    }
                });
            }

            
            buscarProdutos();

            
            $('#searchInput').on('input', function() {
                const termo = $(this).val();
                buscarProdutos(termo);
            });
        });