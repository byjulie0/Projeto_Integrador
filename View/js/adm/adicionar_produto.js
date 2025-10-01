document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('categories');
    const subcategorySelects = document.querySelectorAll('.subcategory-select');
    const categoryToSubcategoryMap = {
        'bovinos': 'bovinos_breed',
        'equinos': 'equinos_breed',
        'galinaceos': 'galinaceos_breed',
        'produtos_gerais': 'product_types',
        'premiados': 'winner_breed'
    };
    function handleCategoryChange() {
        subcategorySelects.forEach(select => {
            select.style.display = 'none';
            select.disabled = true;
            select.selectedIndex = 0;
            select.removeAttribute('required');
        });
        
        if (this.value && categoryToSubcategoryMap[this.value]) {
            const subcategoryId = categoryToSubcategoryMap[this.value];
            const subcategorySelect = document.getElementById(subcategoryId);
            
            if (subcategorySelect) {
                subcategorySelect.style.display = 'block';
                subcategorySelect.disabled = false;
                subcategorySelect.setAttribute('required', 'required');
            }
        }
    }
    if (categorySelect) {
        categorySelect.addEventListener('change', handleCategoryChange);
    }
    subcategorySelects.forEach(select => {
        select.disabled = true;
    });

    // Validação do formulário
    const form = document.querySelector('.add_product_area');
    if (form) {
        let formSubmitted = false;
        const requiredFields = document.querySelectorAll('[required]');

        // Função para validar campos individuais
        function validateField(field) {
            if (!formSubmitted) return true;
            
            const isValid = field.checkValidity();
            field.classList.toggle('invalid-field', !isValid);
            return isValid;
        }

        // Validação em tempo real após primeira tentativa
        requiredFields.forEach(field => {
            field.addEventListener('input', () => formSubmitted && validateField(field));
            field.addEventListener('change', () => formSubmitted && validateField(field));
        });

        // Evento de submit
        form.addEventListener('submit', function(event) {
            formSubmitted = true;
            let formIsValid = true;
            
            // Valida campos obrigatórios
            requiredFields.forEach(field => {
                if (!validateField(field)) formIsValid = false;
            });

            // Validações específicas
            const visibleSubcategory = document.querySelector('.subcategory-select[style="display: block;"]');
            if (visibleSubcategory?.value === "") {
                visibleSubcategory.classList.add('invalid-field');
                formIsValid = false;
            }

            const priceInput = document.querySelector('.input_product_price input');
            if (priceInput && parseFloat(priceInput.value) <= 0) {
                priceInput.classList.add('invalid-field');
                formIsValid = false;
            }

            const imageInput = document.querySelector('input[type="file"]');
            if (!imageInput?.files.length) {
                alert('Selecione uma imagem para o produto');
                formIsValid = false;
            }

            if (!formIsValid) {
                event.preventDefault();
                document.querySelector('.invalid-field')?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    }
});

// --- adicionar_produto.js ---

// Espera o DOM carregar antes de rodar
document.addEventListener("DOMContentLoaded", () => {
    const catSel = document.getElementById('categoria');
    const subSel = document.getElementById('subcategoria');

    // subMap é carregado do PHP via JSON no HTML
    const subMap = window.subMapData || {};

    // Campos que devem ser desabilitados caso "Produtos Gerais" seja escolhido
    const camposAnimal = [
        document.querySelector('input[name="peso"]'),
        document.querySelector('input[name="idade"]'),
        document.querySelector('select[name="sexo"]'),
        document.querySelector('select[name="campeao"]')
    ];

    // Função para atualizar o estado dos campos
    function atualizarCamposAnimal() {
        const catId = parseInt(catSel.value);
        const desabilitar = (catId === 5); // 5 = Produtos Gerais

        camposAnimal.forEach(campo => {
            campo.disabled = desabilitar;
            campo.required = !desabilitar;
            if (desabilitar) campo.value = "";
        });
    }

    // Atualiza subcategorias e campos quando mudar a categoria
    catSel.addEventListener('change', () => {
        const catId = catSel.value;
        subSel.innerHTML = '<option value="" selected disabled>Selecione uma subcategoria</option>';

        if (subMap[catId]) {
            subMap[catId].forEach(sub => {
                const opt = document.createElement('option');
                opt.value = sub.id_subcategoria;
                opt.textContent = sub.subcat_nome;
                subSel.appendChild(opt);
            });
            subSel.disabled = false;
        } else {
            subSel.disabled = true;
        }

        atualizarCamposAnimal();
    });
});
