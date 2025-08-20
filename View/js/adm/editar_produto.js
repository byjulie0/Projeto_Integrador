document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM - IDs e classes específicos da página de edição
    const categorySelect = document.getElementById('categories');
    const subcategorySelects = document.querySelectorAll('.subcategory-select');
    
    // Mapeamento de categorias para subcategorias (mesmo da página de adicionar)
    const categoryToSubcategoryMap = {
        'bovinos': 'bovinos_breed',
        'equinos': 'equinos_breed',
        'galinaceos': 'galinaceos_breed',
        'produtos_gerais': 'product_types',
        'premiados': 'winner_breed'
    };
    
    // Função para manipular a mudança de categoria (igual)
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
    
    // Event Listeners (ajustado para página de edição)
    if (categorySelect) {
        categorySelect.addEventListener('change', handleCategoryChange);
        
        // Dispara o evento change se já houver uma categoria selecionada (importante para edição)
        if (categorySelect.value) {
            handleCategoryChange.call(categorySelect);
        }
    }
    
    // Inicialização
    subcategorySelects.forEach(select => {
        select.disabled = true;
    });

    // Validação do formulário - classes específicas da página de edição
    const form = document.querySelector('.edit_product_area'); // Classe diferente
    if (form) {
        let formSubmitted = false;
        const requiredFields = document.querySelectorAll('[required]');

        // Função para validar campos individuais (igual)
        function validateField(field) {
            if (!formSubmitted) return true;
            
            const isValid = field.checkValidity();
            field.classList.toggle('invalid-field', !isValid);
            return isValid;
        }

        // Validação em tempo real após primeira tentativa (igual)
        requiredFields.forEach(field => {
            field.addEventListener('input', () => formSubmitted && validateField(field));
            field.addEventListener('change', () => formSubmitted && validateField(field));
        });

        // Evento de submit (com ajustes para edição)
        form.addEventListener('submit', function(event) {
            formSubmitted = true;
            let formIsValid = true;
            
            // Valida campos obrigatórios (igual)
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

            // Na edição, a imagem NÃO é obrigatória (diferente da adição)
            // Pois o produto já pode ter uma imagem cadastrada
            // Removemos a validação obrigatória do file input

            if (!formIsValid) {
                event.preventDefault();
                document.querySelector('.invalid-field')?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    }

    // Controle do popup de sucesso (específico para edição)
    const popup = document.getElementById('popupSucesso');
    const fechar = document.getElementById('fecharPopup');

    if (fechar && popup) {
        fechar.addEventListener('click', () => {
            popup.style.display = 'none';
        });

        window.addEventListener('click', function(e) {
            if (e.target === popup) {
                popup.style.display = 'none';
            }
        });
    }
});