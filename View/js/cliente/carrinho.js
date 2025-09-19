document.addEventListener('DOMContentLoaded', function() {
    // Selecionar todos os produtos
    const selectAllCheckbox = document.querySelector('.select-all-checkbox');
    const productCheckboxes = document.querySelectorAll('.product-checkbox');
    
    // Atualizar quantidade e preços
    const plusButtons = document.querySelectorAll('.plus-btn');
    const minusButtons = document.querySelectorAll('.minus-btn');
    const deleteButtons = document.querySelectorAll('.delete-item-carrinho');
    
    // Função para atualizar o total de itens e preço
    function updateCartSummary() {
        const productCards = document.querySelectorAll('.product-card-carrinho');
        let totalItems = 0;
        let grandTotal = 0;
        
        productCards.forEach(card => {
            const quantity = parseInt(card.querySelector('.quantity-carrinho').textContent);
            const price = parseFloat(card.dataset.price);
            totalItems += quantity;
            grandTotal += quantity * price;
        });
        
        document.querySelector('.total-items-count').textContent = totalItems;
        document.querySelector('.grand-total-price').textContent = grandTotal.toFixed(2).replace('.', ',');
    }
    
    // Aumentar quantidade
    plusButtons.forEach(button => {
        button.addEventListener('click', function() {
            const quantityElement = this.parentElement.querySelector('.quantity-carrinho');
            let quantity = parseInt(quantityElement.textContent);
            quantity++;
            quantityElement.textContent = quantity;
            
            // Atualizar preço total do produto
            const productCard = this.closest('.product-card-carrinho');
            const unitPrice = parseFloat(productCard.dataset.price);
            const totalPrice = quantity * unitPrice;
            productCard.querySelector('.product-total-price').textContent = totalPrice.toFixed(2).replace('.', ',');
            
            updateCartSummary();
        });
    });
    
    // Diminuir quantidade (não permitir menos que 1)
    minusButtons.forEach(button => {
        button.addEventListener('click', function() {
            const quantityElement = this.parentElement.querySelector('.quantity-carrinho');
            let quantity = parseInt(quantityElement.textContent);
            if (quantity > 1) {
                quantity--;
                quantityElement.textContent = quantity;
                
                // Atualizar preço total do produto
                const productCard = this.closest('.product-card-carrinho');
                const unitPrice = parseFloat(productCard.dataset.price);
                const totalPrice = quantity * unitPrice;
                productCard.querySelector('.product-total-price').textContent = totalPrice.toFixed(2).replace('.', ',');
                
                updateCartSummary();
            }
        });
    });
    
    // Remover item
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productCard = this.closest('.product-card-carrinho');
            productCard.remove();
            updateCartSummary();
        });
    });
    
    // Selecionar/deselecionar todos
    selectAllCheckbox.addEventListener('change', function() {
        productCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Atualizar seleção individual
    productCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = [...productCheckboxes].every(cb => cb.checked);
            selectAllCheckbox.checked = allChecked;
        });
    });
});
// Remover itens do carrinho
document.querySelectorAll(".delete-item-carrinho").forEach(function(botao) {
    botao.addEventListener("click", function() {
        // Acha o card do produto
        let cardProduto = this.closest(".product-card-carrinho");
        if (cardProduto) {
            cardProduto.remove(); // Remove do DOM
            atualizarResumoCarrinho();
        }
    });
});


function atualizarResumoCarrinho() {
    let produtos = document.querySelectorAll(".product-card-carrinho");
    let totalItens = produtos.length;
    let totalPreco = 0;

    produtos.forEach(function(produto) {
        let preco = parseFloat(produto.getAttribute("data-price"));
        totalPreco += preco;
    });

    document.querySelector(".total-items-count").textContent = totalItens;
    document.querySelector(".grand-total-price").textContent = totalPreco.toFixed(2).replace(".", ",");
}

fetch("carrinho2.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({
        action: "add",
        id: 1,
        nome: "Produto Exemplo",
        preco: 10.50,
        quantidade: 2
    })
})
.then(res => res.json())
.then(data => console.log(data));
