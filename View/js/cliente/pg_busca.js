document.addEventListener('DOMContentLoaded', function() {
    const buscaDesktop = document.getElementById('busca');
    const buscaMobile = document.getElementById('busca-mobile');
    
    function configurarBusca(inputElement, resultadoElementId) {
        if (!inputElement) return;
        
        inputElement.addEventListener('input', function() {
            const termo = this.value.trim();
            const resultadoElement = document.getElementById(resultadoElementId);
            
            if (!resultadoElement) return;
            
            if (termo.length > 2) {
                realizarBusca(termo, resultadoElement);
                resultadoElement.style.display = 'block';
            } else {
                resultadoElement.style.display = 'none';
                resultadoElement.innerHTML = '';
            }
        });
        
        document.addEventListener('click', function(e) {
            if (!inputElement.contains(e.target) && !resultadoElement.contains(e.target)) {
                resultadoElement.style.display = 'none';
            }
        });
        
        inputElement.addEventListener('keydown', function(e) {
            const resultados = resultadoElement.querySelectorAll('.item-busca');
            let itemAtivo = resultadoElement.querySelector('.item-busca.active');
            
            switch(e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    navegarResultados(resultados, itemAtivo, 1);
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    navegarResultados(resultados, itemAtivo, -1);
                    break;
                case 'Enter':
                    if (itemAtivo) {
                        e.preventDefault();
                        itemAtivo.click();
                    }
                    break;
                case 'Escape':
                    resultadoElement.style.display = 'none';
                    break;
            }
        });
    }
    
    function navegarResultados(resultados, itemAtivo, direcao) {
        let novoIndex = 0;
        
        if (itemAtivo) {
            const indexAtual = Array.from(resultados).indexOf(itemAtivo);
            novoIndex = indexAtual + direcao;
            
            if (novoIndex < 0) novoIndex = resultados.length - 1;
            if (novoIndex >= resultados.length) novoIndex = 0;
            
            itemAtivo.classList.remove('active');
        }
        
        if (resultados[novoIndex]) {
            resultados[novoIndex].classList.add('active');
            resultados[novoIndex].scrollIntoView({ block: 'nearest' });
        }
    }
    
    function realizarBusca(termo, resultadoElement) {
        const resultadosSimulados = [
            { id: 1, nome: 'Produto A', categoria: 'Bovinos' },
            { id: 2, nome: 'Produto B', categoria: 'Equinos' },
            { id: 3, nome: 'Produto C', categoria: 'Galináceos' }
        ];
        
        const resultadosFiltrados = resultadosSimulados.filter(item =>
            item.nome.toLowerCase().includes(termo.toLowerCase()) ||
            item.categoria.toLowerCase().includes(termo.toLowerCase())
        );
        
        exibirResultados(resultadosFiltrados, resultadoElement);
    }
    
    function exibirResultados(resultados, resultadoElement) {
        if (resultados.length === 0) {
            resultadoElement.innerHTML = '<div class="item-busca">Nenhum produto encontrado</div>';
            return;
        }
        
        resultadoElement.innerHTML = resultados.map(item => `
            <div class="item-busca" data-id="${item.id}">
                <strong>${item.nome}</strong>
                <span class="categoria-busca">${item.categoria}</span>
            </div>
        `).join('');
        
        resultadoElement.querySelectorAll('.item-busca').forEach(item => {
            item.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                redirecionarParaProduto(productId);
            });
            
            item.addEventListener('mouseenter', function() {
                this.classList.add('active');
            });
            
            item.addEventListener('mouseleave', function() {
                this.classList.remove('active');
            });
        });
    }
    
    function redirecionarParaProduto(productId) {
        console.log(`Redirecionando para produto: ${productId}`);
    }
    
    configurarBusca(buscaDesktop, 'resultado_busca');
    configurarBusca(buscaMobile, 'resultado_busca_mobile');
    
    if (buscaDesktop && buscaMobile) {
        [buscaDesktop, buscaMobile].forEach(input => {
            input.addEventListener('input', function() {
                const outroInput = input === buscaDesktop ? buscaMobile : buscaDesktop;
                outroInput.value = this.value;
            });
        });
    }
});