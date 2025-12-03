   $(document).ready(function() {

            function atualizarTabela(produtos) {
                let html = '';

                if (produtos.length) {
                    produtos.forEach(p => {
                        const ativo = p.produto_ativo == 1;
                        const icone = ativo ? "fa-toggle-off" : "fa-toggle-on";
                        const ariaPressed = ativo ? "false" : "true";
                        const statusTexto = ativo ? "Ativo" : "Inativo";
                        const precoFormatado = 'R$ ' + Number(p.preco).toLocaleString('pt-BR', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });

                        html += `
                            <tr>
                                <td class="product-name-atualizar-produtos cell-atualizar-produto">
                                    <div class="product-atualizar-produtos"><span>${p.produto}</span></div>
                                </td>

                                <td class="product-category-atualizar-produtos cell-atualizar-produto">
                                    <div class="category-name-atualizar-produtos">
                                        <span>${p.categoria ?? 'Ops! Está vazio'}</span>
                                    </div>
                                </td>

                                <td class="qt-atualizar-produtos cell-atualizar-produto">
                                    ${p.subcategoria ?? 'Ops! Também está vazio'}
                                </td>

                                <td class="price-atualizar-produtos cell-atualizar-produto">
                                    ${precoFormatado}
                                </td>

                                <td class="update-atualizar-produtos cell-atualizar-produto">
                                    <a href="editar_produto.php?id=${p.id_produto}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>

                                <td class="exclude-atualizar-produtos cell-atualizar-produto">
                                    <form method="POST" action="toggle_adm_inativar.php" style="display:inline;">
                                        <input type="hidden" name="id_produto" value="${p.id_produto}">
                                        <input type="hidden" name="status_atual" value="${p.produto_ativo}">
                                        <button type="submit" name="toggle_produto"
                                                class="icon-toggle-btn"
                                                aria-pressed="${ariaPressed}">
                                            <i class="fa-solid ${icone}"></i>
                                        </button>
                                    </form>
                                </td>

                                <td class="qt-atualizar-produtos">${statusTexto}</td>
                                
                                <td class="price-atualizar-produtos cell-atualizar-produto">
                                    ${p.quant_estoque}
                                </td>
                                        
                            </tr>
                        `;
                    });

                } else {
                    html = `
                    <tr>
                        <td colspan="7" style="text-align:center;">Nenhum produto encontrado.</td>
                    </tr>
                    `;
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

