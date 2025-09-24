const ctx = document.getElementById('graficoEstatisticas').getContext('2d');
new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Cancelados', 'Vendidos', 'Pendentes'],
        datasets: [{
            data: [30, 50, 20], // exemplo
            backgroundColor: ['#f28b82', '#aecbfa', '#fdd663']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' }
        }
    }
});