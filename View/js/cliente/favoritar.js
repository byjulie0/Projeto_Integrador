{/* <script>
document.getElementById('btnFavoritar').addEventListener('click', function() {
    const id_produto = this.dataset.produto;

    fetch('../utils/favoritar.php', {
        method: 'GET',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id_produto=' + id_produto
    })
    .then(res => res.json())
    .then(data => {
        const icone = document.getElementById('iconeFavorito');

        if (data.status === 'added') {
            icone.classList.remove('fa-heart-o');
            icone.classList.add('fa-heart');
            icone.style.color = 'red';
        } else if (data.status === 'removed') {
            icone.classList.remove('fa-heart');
            icone.classList.add('fa-heart-o');
            icone.style.color = '';
        } else if (data.status === 'error') {
            alert('Você precisa estar logado para favoritar produtos!');
        }
    })
    .catch(() => alert('Erro ao processar o favorito.'));
});
</script> */}
