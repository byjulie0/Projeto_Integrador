document.addEventListener("DOMContentLoaded", () => {
    const catSel = document.getElementById('categoria');
    const subSel = document.getElementById('subcategoria');

    const subMap = window.subMapData || {};
    const produtoCategoria = window.produtoCategoria || null;
    const produtoSubcategoria = window.produtoSubcategoria || null;

    const camposAnimal = [
        document.querySelector('input[name="peso"]'),
        document.querySelector('input[name="idade"]'),
        document.querySelector('select[name="sexo"]'),
        document.querySelector('select[name="campeao"]')
    ];

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

    function carregarSubcategorias(catId) {
        subSel.innerHTML = '<option value="" selected disabled>Selecione uma subcategoria</option>';

        if (subMap[catId]) {
            subMap[catId].forEach(sub => {
                const opt = document.createElement('option');
                opt.value = sub.id_subcategoria;
                opt.textContent = sub.subcat_nome;

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

    if (produtoCategoria) {
        catSel.value = produtoCategoria;

        carregarSubcategorias(produtoCategoria);

        atualizarCamposAnimal(produtoCategoria);
    }

    catSel.addEventListener('change', () => {
        const catId = catSel.value;
        carregarSubcategorias(catId);
        atualizarCamposAnimal(catId);
    });
});

  const inputImagem = document.getElementById('inputImagem');
  const previewImagem = document.getElementById('previewImagem');
  const imgHolderButton = document.querySelector('.img_holder_button');

  if (previewImagem && previewImagem.src && !previewImagem.src.includes('#') && previewImagem.style.display !== 'none') {
    imgHolderButton.style.opacity = '0.4';
  }

  inputImagem.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        previewImagem.src = e.target.result;
        previewImagem.style.display = 'block';
        imgHolderButton.style.opacity = '0.4';
      };
      reader.readAsDataURL(file);
    }
  });
