// ../../view/js/adm/editar_produto.js

let currentSlide = 0;
let previews = new Array(4).fill(null);
let subMapData = {};
let produtoCategoria = 0;
let produtoSubcategoria = 0;

function initEditProduct() {
    subMapData = window.subMapData || {};
    produtoCategoria = window.produtoCategoria || 0;
    produtoSubcategoria = window.produtoSubcategoria || 0;

    // Carrega imagens do PHP
    for (let i = 0; i < 4; i++) {
        const miniImg = document.getElementById(`miniImg${i}`);
        if (miniImg && miniImg.src && !miniImg.src.includes('blob:')) {
            previews[i] = miniImg.src;
        }
    }

    setupImageUploader();
    setupCategoryHandler();
    updateCarousel();
}

// === UPLOADER + REMOVER + TROCA ===
function setupImageUploader() {
    const inputs = document.querySelectorAll('.file-input-hidden');
    const miniImgs = document.querySelectorAll('.mini-img');
    const contents = document.querySelectorAll('.upload-content');
    const removeBtns = document.querySelectorAll('.remove-mini');

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
                removeBtns[i].style.display = 'flex';
                document.getElementById(`manter${i}`).value = '0';
                updateCarousel();
            };
            reader.readAsDataURL(file);
        });
    });

    removeBtns.forEach((btn, i) => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            previews[i] = null;
            miniImgs[i].src = '';
            miniImgs[i].style.display = 'none';
            contents[i].style.display = 'flex';
            btn.style.display = 'none';
            document.getElementById(`del${i}`).value = '1';
            updateCarousel();
        });
    });

    document.querySelectorAll('.custom-file-upload'). Patent.forEach((label, i) => {
        label.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-mini')) return;
            if (!previews[i]) {
                inputs[i].click();
            } else {
                showSlide(i);
            }
        });
    });
}

// === CARROSSEL ===
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

function updateCarousel() {
    const filled = previews.filter(p => p);
    const mainImg = document.getElementById('mainPreview');
    const placeholder = document.getElementById('carouselPlaceholder');

    if (filled.length === 0) {
        mainImg.style.display = 'none';
        placeholder.style.display = 'block';
        return;
    }
    mainImg.src = filled[currentSlide];
    mainImg.style.display = 'block';
    placeholder.style.display = 'none';
}

function setupCategoryHandler() {
    const catSel = document.getElementById('categoria');
    const subSel = document.getElementById('subcategoria');
    if (!catSel || !subSel) return;

    function loadSub() {
        const catId = catSel.value;
        subSel.innerHTML = '<option value="">Selecione</option>';
        subSel.disabled = true;

        if (subMapData[catId]) {
            subMapData[catId].forEach(sub => {
                const opt = document.createElement('option');
                opt.value = sub.id_subcategoria;
                opt.textContent = sub.subcat_nome;
                if (parseInt(sub.id_subcategoria) === produtoSubcategoria) {
                    opt.selected = true;
                }
                subSel.appendChild(opt);
            });
            subSel.disabled = false;
        }
    }

    catSel.addEventListener('change', loadSub);
    loadSub();
}

window.initEditProduct = initEditProduct;