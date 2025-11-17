// adicionar_produto.js
// Tudo em um único DOMContentLoaded

let currentSlide = 0;
let previews = new Array(4).fill(null);
let subMapData = {};

function initProductUploader(data) {
    subMapData = data || {};
    setupAll();
}

function setupAll() {
    setupImageCarousel();
    setupCategorySubcategory();
    setupFormValidation();
    setupSingleImagePreview();
}

// === 1. CARROSSEL DE 4 IMAGENS ===
function setupImageCarousel() {
    const inputs = document.querySelectorAll('input[name="imagens[]"]');
    const miniImgs = document.querySelectorAll('.mini-img');
    const contents = document.querySelectorAll('.upload-content');
    const removes = document.querySelectorAll('.remove-mini');
    const mainImg = document.getElementById('mainPreview');
    const placeholder = document.getElementById('carouselPlaceholder');

    // Clique no box
    document.querySelectorAll('.custom-file-upload').forEach((label, i) => {
        label.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-mini')) {
                e.preventDefault();
                return;
            }
            if (!previews[i]) {
                inputs[i].click();
            } else {
                showSlide(i);
            }
        });
    });

    // Input change
    inputs.forEach((input, i) => {
        input.addEventListener('change', () => {
            const file = input.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                previews[i] = e.target.result;
                miniImgs[i].src = e.target.result;
                miniImgs[i].style.display = 'block';
                contents[i].style.display = 'none';
                removes[i].style.display = 'flex';
                updateCarousel();
            };
            reader.readAsDataURL(file);
        });
    });

    // Remover
    removes.forEach((btn, i) => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            clearImage(i);
        });
    });

    // Navegação
    window.changeSlide = (dir) => {
        const filled = previews.filter(p => p);
        if (filled.length === 0) return;
        currentSlide = (currentSlide + dir + filled.length) % filled.length;
        updateCarousel();
    };

    function showSlide(i) {
        const filled = previews.map((p, j) => p ? j : -1).filter(j => j !== -1);
        currentSlide = filled.indexOf(i);
        updateCarousel();
    }

    function clearImage(i) {
        inputs[i].value = '';
        miniImgs[i].src = '';
        miniImgs[i].style.display = 'none';
        contents[i].style.display = 'flex';
        removes[i].style.display = 'none';
        previews[i] = null;
        updateCarousel();
    }

    function updateCarousel() {
        const filled = previews.filter(p => p);
        if (filled.length === 0) {
            mainImg.style.display = 'none';
            placeholder.style.display = 'block';
            return;
        }
        const imgSrc = filled[currentSlide] || filled[0];
        mainImg.src = imgSrc;
        mainImg.style.display = 'block';
        placeholder.style.display = 'none';
    }

    updateCarousel();
}

// === 2. CATEGORIA → SUBCATEGORIA + CAMPOS ANIMAL ===
function setupCategorySubcategory() {
    const catSelect = document.getElementById('categoria');
    const subSelect = document.getElementById('subcategoria');

    if (!catSelect || !subSelect) return;

    const camposAnimal = [
        document.querySelector('input[name="peso"]'),
        document.querySelector('input[name="idade"]'),
        document.querySelector('select[name="sexo"]'),
        document.querySelector('select[name="campeao"]')
    ];

    function atualizar() {
        const catId = catSelect.value;
        subSelect.innerHTML = '<option value="" selected disabled>Selecione uma subcategoria</option>';
        subSelect.disabled = true;

        if (subMapData[catId]) {
            subMapData[catId].forEach(sub => {
                const opt = document.createElement('option');
                opt.value = sub.id_subcategoria;
                opt.textContent = sub.subcat_nome;
                subSelect.appendChild(opt);
            });
            subSelect.disabled = false;
        }

        const desabilitar = (parseInt(catId) === 5);
        camposAnimal.forEach(campo => {
            if (campo) {
                campo.disabled = desabilitar;
                campo.required = !desabilitar;
                if (desabilitar) campo.value = '';
            }
        });
    }

    catSelect.addEventListener('change', atualizar);
    atualizar();
}

// === 3. VALIDAÇÃO DO FORMULÁRIO ===
function setupFormValidation() {
    const form = document.querySelector('form');
    if (!form) return;

    let submitted = false;

    form.addEventListener('submit', (e) => {
        submitted = true;
        let valid = true;

        document.querySelectorAll('[required]').forEach(field => {
            if (!field.disabled && !field.checkValidity()) {
                field.classList.active('invalid-field');
                valid = false;
            } else {
                field.classList.remove('invalid-field');
            }
        });

        const subSel = document.getElementById('subcategoria');
        if (!subSel.disabled && !subSel.value) {
            subSel.classList.add('invalid-field');
            valid = false;
        }

        const valor = document.querySelector('input[name="valor"]');
        if (valor && parseFloat(valor.value) <= 0) {
            valor.classList.add('invalid-field');
            valid = false;
        }

        if (!previews.some(p => p)) {
            alert('Adicione pelo menos uma imagem!');
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
            document.querySelector('.invalid-field')?.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    });

    document.querySelectorAll('[required]').forEach(field => {
        field.addEventListener('input', () => submitted && field.classList.remove('invalid-field'));
    });
}

// === 4. PREVIEW DE IMAGEM ÚNICA (se existir) ===
function setupSingleImagePreview() {
    const inputImg = document.getElementById("inputImagem");
    const preview = document.getElementById("previewImagem");
    const label = document.querySelector(".img_holder_button");

    if (!inputImg || !preview || !label) return;

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
}

// === INICIALIZAÇÃO ===
document.addEventListener('DOMContentLoaded', () => {
    if (typeof window.subMapData !== 'undefined') {
        initProductUploader(window.subMapData);
    }
});

// Exporta função global
window.initProductUploader = initProductUploader;
