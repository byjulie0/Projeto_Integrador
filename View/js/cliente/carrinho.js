document.addEventListener('DOMContentLoaded', function() {
    // Inicializar o carrinho
    initCarrinho();
    
    function initCarrinho() {
        // Configurar eventos dos checkboxes
        setupCheckboxEvents();
        
        // Configurar eventos dos botões de quantidade
        setupQuantityEvents();
        
        // Configurar eventos dos botões de excluir
        setupDeleteEvents();
        
        // Calcular totais iniciais
        updateAllTotals();
    }
    
    function setupCheckboxEvents() {
        const selectAllCheckbox = document.querySelector('.select-all-checkbox');
        const productCheckboxes = document.querySelectorAll('.product-checkbox');
        
        // Selecionar/Deselecionar todos
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
                
                updateAllTotals();
            });
        }
        
        // Checkboxes individuais
        productCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectAllState();
                updateAllTotals();
            });
        });
        
        // Estado inicial do "Selecionar tudo"
        updateSelectAllState();
    }
    
    function setupQuantityEvents() {
        // Botões de aumentar quantidade
        document.querySelectorAll('.plus-btn').forEach(button => {
            button.addEventListener('click', function() {
                const quantityElement = this.parentElement.querySelector('.quantity-carrinho');
                let quantity = parseInt(quantityElement.textContent);
                quantity++;
                quantityElement.textContent = quantity;
                
                updateProductTotal(this.closest('.product-card-carrinho'));
                updateAllTotals();
            });
        });
        
        // Botões de diminuir quantidade
        document.querySelectorAll('.minus-btn').forEach(button => {
            button.addEventListener('click', function() {
                const quantityElement = this.parentElement.querySelector('.quantity-carrinho');
                let quantity = parseInt(quantityElement.textContent);
                
                if (quantity > 1) {
                    quantity--;
                    quantityElement.textContent = quantity;
                    
                    updateProductTotal(this.closest('.product-card-carrinho'));
                    updateAllTotals();
                }
            });
        });
    }
    
    function setupDeleteEvents() {
        document.querySelectorAll('.delete-item-carrinho').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Tem certeza que deseja remover este item do carrinho?')) {
                    const productCard = this.closest('.product-card-carrinho');
                    productCard.remove();
                    
                    // Verificar se ainda há produtos no carrinho
                    const remainingProducts = document.querySelectorAll('.product-card-carrinho');
                    if (remainingProducts.length === 0) {
                        document.querySelector('.product-cards-carrinho').innerHTML = 
                            '<div class="empty-cart"><p>Seu carrinho está vazio</p></div>';
                        document.querySelector('.select-all-checkbox').disabled = true;
                    }
                    
                    updateAllTotals();
                }
            });
        });
    }
    
    function updateProductTotal(productCard) {
        const quantity = parseInt(productCard.querySelector('.quantity-carrinho').textContent);
        const unitPrice = parseFloat(productCard.dataset.price);
        const totalPrice = quantity * unitPrice;
        
        productCard.querySelector('.product-total-price').textContent = 
            totalPrice.toFixed(2).replace('.', ',');
    }
    
    function updateSelectAllState() {
        const selectAllCheckbox = document.querySelector('.select-all-checkbox');
        const productCheckboxes = document.querySelectorAll('.product-checkbox');
        
        if (productCheckboxes.length === 0) {
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.disabled = true;
            }
            return;
        }
        
        if (selectAllCheckbox) {
            selectAllCheckbox.disabled = false;
            const allChecked = Array.from(productCheckboxes).every(checkbox => checkbox.checked);
            const someChecked = Array.from(productCheckboxes).some(checkbox => checkbox.checked);
            
            selectAllCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = someChecked && !allChecked;
        }
    }
    
    function updateAllTotals() {
        updateCartSummary();
        updateSelectAllState();
    }
    
    function updateCartSummary() {
        const productCards = document.querySelectorAll('.product-card-carrinho');
        let totalItems = 0;
        let grandTotal = 0;
        
        productCards.forEach(card => {
            const checkbox = card.querySelector('.product-checkbox');
            
            if (checkbox.checked) {
                const quantity = parseInt(card.querySelector('.quantity-carrinho').textContent);
                const unitPrice = parseFloat(card.dataset.price);
                
                totalItems += quantity;
                grandTotal += quantity * unitPrice;
            }
        });
        
        // Atualizar a interface
        document.querySelector('.total-items-count').textContent = totalItems;
        document.querySelector('.grand-total-price').textContent = 
            grandTotal.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
            
        // Atualizar o botão de fechar pedido se necessário
        updateCheckoutButton(grandTotal > 0);
    }
    
    function updateCheckoutButton(enable) {
        const checkoutButton = document.querySelector('.checkout-btns-carrinho .botao-cliente');
        if (checkoutButton) {
            if (enable) {
                checkoutButton.disabled = false;
                checkoutButton.style.opacity = '1';
                checkoutButton.style.cursor = 'pointer';
            } else {
                checkoutButton.disabled = true;
                checkoutButton.style.opacity = '0.6';
                checkoutButton.style.cursor = 'not-allowed';
            }
        }
    }
    
    // Re-inicializar se novos produtos forem adicionados dinamicamente
    window.updateCarrinho = function() {
        initCarrinho();
    };
});