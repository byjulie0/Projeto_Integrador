
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

    const form = document.querySelector('.add_product_area');
    if (form) {
        let formSubmitted = false;
        const requiredFields = document.querySelectorAll('[required]');

        function validateField(field) {
            if (!formSubmitted) return true;
            
            const isValid = field.checkValidity();
            field.classList.toggle('invalid-field', !isValid);
            return isValid;
        }

        requiredFields.forEach(field => {
            field.addEventListener('input', () => formSubmitted && validateField(field));
            field.addEventListener('change', () => formSubmitted && validateField(field));
        });

        form.addEventListener('submit', function(event) {
            formSubmitted = true;
            let formIsValid = true;

            requiredFields.forEach(field => {
                if (!validateField(field)) formIsValid = false;
            });

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

document.addEventListener("DOMContentLoaded", () => {
    const catSel = document.getElementById('categoria');
    const subSel = document.getElementById('subcategoria');

    const subMap = window.subMapData || {};

    const camposAnimal = [
        document.querySelector('input[name="peso"]'),
        document.querySelector('input[name="idade"]'),
        document.querySelector('select[name="sexo"]'),
        document.querySelector('select[name="campeao"]')
    ];

    function atualizarCamposAnimal() {
        const catId = parseInt(catSel.value);
        const desabilitar = (catId === 5);
        camposAnimal.forEach(campo => {
            campo.disabled = desabilitar;
            campo.required = !desabilitar;
            if (desabilitar) campo.value = "";
        });
    }

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

document.addEventListener("DOMContentLoaded", () => {
  const inputImg = document.getElementById("inputImagem");
  const preview = document.getElementById("previewImagem");
  const label = document.querySelector(".img_holder_button");

  inputImg.addEventListener("change", function() {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = "block";
        label.textContent = "Trocar imagem";
        label.style.opacity = "0.5";
      };
      reader.readAsDataURL(file);
    } else {
      preview.src = "";
      preview.style.display = "none";
      label.textContent = "Selecionar uma imagem";
      label.style.opacity = "1";
    }
  });
});


// === CARROSSEL SIMPLIFICADO COM MINIATURAS CLEAN ===
document.addEventListener("DOMContentLoaded", () => {
    const carouselImgs = document.querySelectorAll('.carousel-img');
    const miniBoxes = document.querySelectorAll('.mini-box');
    const miniImgs = document.querySelectorAll('.mini-img');
    const inputs = document.querySelectorAll('input[name="imagens[]"]');
    const removes = document.querySelectorAll('.remove-mini');
    const placeholder = document.querySelector('.carousel-placeholder');
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');

    let currentIndex = 0;
    const imagens = [null, null, null, null];

    function atualizar() {
        carouselImgs.forEach((img, i) => {
            img.classList.toggle('active', i === currentIndex && imagens[i]);
        });
        miniBoxes.forEach((box, i) => {
            box.classList.toggle('active', i === currentIndex);
            box.classList.toggle('filled', !!imagens[i]);
        });
        placeholder.style.display = imagens[currentIndex] ? 'none' : 'block';
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex === 3;
    }

    function mostrar(i) {
        if (imagens[i]) {
            currentIndex = i;
            atualizar();
        }
    }

    prevBtn.addEventListener('click', () => { if (currentIndex > 0) { currentIndex--; atualizar(); } });
    nextBtn.addEventListener('click', () => { if (currentIndex < 3) { currentIndex++; atualizar(); } });

    // Clicar no mini-box
    // ANTES:
// box.addEventListener('click', () => { ... inputs[i].click(); });

// AGORA:
miniBoxes.forEach((box, i) => {
    box.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-mini')) return;
        if (!imagens[i]) {
            inputs[i].click(); // abre seletor
        } else {
            mostrar(i); // mostra no carrossel
        }
    });
});

    inputs.forEach((input, i) => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                imagens[i] = e.target.result;
                carouselImgs[i].src = e.target.result;
                miniImgs[i].src = e.target.result;
                removes[i].classList.remove('d-none');
                if (!imagens.some(img => img)) currentIndex = i;
                atualizar();
            };
            reader.readAsDataURL(file);
        });
    });

    removes.forEach((btn, i) => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            imagens[i] = null;
            carouselImgs[i].src = '';
            miniImgs[i].src = '';
            inputs[i].value = '';
            removes[i].classList.add('d-none');
            if (currentIndex === i) currentIndex = imagens.findIndex(img => img) ?? 0;
            atualizar();
        });
    });

    atualizar();
});


