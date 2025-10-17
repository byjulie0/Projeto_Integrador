document.addEventListener("DOMContentLoaded", () => {
    const catSel = document.getElementById('categoria');
    const subSel = document.getElementById('subcategoria');

    // Dados passados pelo PHP
    const subMap = window.subMapData || {};
    const produtoCategoria = window.produtoCategoria || null;
    const produtoSubcategoria = window.produtoSubcategoria || null;

    // Campos relacionados a animais (desabilitados para "Produtos Gerais" = id 5)
    const camposAnimal = [
        document.querySelector('input[name="peso"]'),
        document.querySelector('input[name="idade"]'),
        document.querySelector('select[name="sexo"]'),
        document.querySelector('select[name="campeao"]')
    ];

    // Função para atualizar o estado dos campos de animal
    function atualizarCamposAnimal(catId) {
        const desabilitar = (parseInt(catId) === 5);
        camposAnimal.forEach(campo => {
            if (campo) {
                campo.disabled = desabilitar;
                campo.required = !desabilitar;
                if (desabilitar) {
                    campo.value = "";
                }
            }
        });
    }

    // Função para carregar subcategorias com base na categoria selecionada
    function carregarSubcategorias(catId) {
        // Limpa as opções atuais
        subSel.innerHTML = '<option value="" selected disabled>Selecione uma subcategoria</option>';

        if (subMap[catId]) {
            subMap[catId].forEach(sub => {
                const opt = document.createElement('option');
                opt.value = sub.id_subcategoria;
                opt.textContent = sub.subcat_nome;

                // Seleciona a subcategoria atual do produto
                if (parseInt(sub.id_subcategoria) === parseInt(produtoSubcategoria)) {
                    opt.selected = true;
                }

                subSel.appendChild(opt);
            });
            subSel.disabled = false;
        } else {
            subSel.disabled = true;
        }
    }

    // Inicialização: carregar subcategorias e ajustar campos com base nos dados do produto
    if (produtoCategoria) {
        // Define a categoria no select
        catSel.value = produtoCategoria;

        // Carrega as subcategorias correspondentes
        carregarSubcategorias(produtoCategoria);

        // Atualiza campos de animal
        atualizarCamposAnimal(produtoCategoria);
    }

    // Evento de mudança na categoria
    catSel.addEventListener('change', () => {
        const catId = catSel.value;
        carregarSubcategorias(catId);
        atualizarCamposAnimal(catId);
    });
});