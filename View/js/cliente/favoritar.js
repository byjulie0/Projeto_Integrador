document.addEventListener('DOMContentLoaded', () => {
  const botoes = document.querySelectorAll('.btn-favorito');

  botoes.forEach(botao => {
    botao.addEventListener('click', async () => {
      const idProduto = botao.dataset.id;

      try {
        const response = await fetch('../../../Controller/utils/favoritar.php', {

          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `id_produto=${idProduto}`
        });

        const result = await response.json();
        const icone = botao.querySelector('i');

        if (result.status === 'adicionado') {
          icone.classList.remove('fa-regular');
          icone.classList.add('fa-solid');
          icone.style.color = 'red';
        } else if (result.status === 'removido') {
          icone.classList.remove('fa-solid');
          icone.classList.add('fa-regular');
          icone.style.color = '';
        } else if (result.status === 'nao_logado') {
          // redireciona pra login se não estiver logado
          window.location.href = '../../../Controller/cliente/login.php';
        }
      } catch (error) {
        console.error('Erro ao favoritar:', error);
      }
    });
  });
});
