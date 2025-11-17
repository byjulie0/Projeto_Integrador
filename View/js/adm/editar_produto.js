document.addEventListener("DOMContentLoaded", () => {
    const inputs = Array.from(document.querySelectorAll('input[type="file"][name="imagens[]"]'));
    const miniImgs = inputs.map((_, i) => document.getElementById(`miniImg${i}`));
    const contents = inputs.map((_, i) => document.getElementById(`content${i}`));
    const removes = inputs.map((_, i) => document.getElementById(`remove${i}`));
    const removeFlags = inputs.map((_, i) => document.getElementById(`remove_input_${i}`));
    const mainImg = document.getElementById('mainPreview');
    const placeholder = document.getElementById('carouselPlaceholder');

    let previews = [null, null, null, null];
    const serverImgs = window.produtoImgs || [null, null, null, null];
    serverImgs.forEach((p, i) => {
        if (p) {
            const src = '../../view/public/' + p;
            previews[i] = src;
            miniImgs[i].src = src;
            miniImgs[i].style.display = 'block';
            contents[i].style.display = 'none';
            removes[i].style.display = 'flex';
        }
    });

    let currentSlide = 0;
    function updateCarousel() {
        const filled = previews.map((p,i) => p ? i : -1).filter(i => i !== -1);
        if (filled.length === 0) {
            mainImg.style.display = 'none';
            placeholder.style.display = 'block';
            return;
        }
        if (!previews[currentSlide]) {
            currentSlide = filled[0];
        }
        mainImg.src = previews[currentSlide];
        mainImg.style.display = 'block';
        placeholder.style.display = 'none';
    }

    window.changeSlide = (dir) => {
        const filled = previews.map((p,i) => p ? i : -1).filter(i => i !== -1);
        if (filled.length === 0) return;
        let pos = filled.indexOf(currentSlide);
        if (pos === -1) pos = 0;
        pos = (pos + dir + filled.length) % filled.length;
        currentSlide = filled[pos];
        updateCarousel();
    }

    document.getElementById('miniContainer').addEventListener('click', (e) => {
        const label = e.target.closest('.mini-label');
        if (!label) return;
        const idx = parseInt(label.getAttribute('data-index'), 10);
        if (previews[idx]) {
            currentSlide = idx;
            updateCarousel();
        } else {
            const input = label.querySelector('input[type=file]');
            if (input) input.click();
        }
    });

    inputs.forEach((input, i) => {
        input.addEventListener('change', () => {
            const file = input.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                const dataUrl = e.target.result;
                previews[i] = dataUrl;
                miniImgs[i].src = dataUrl;
                miniImgs[i].style.display = 'block';
                contents[i].style.display = 'none';
                removes[i].style.display = 'flex';
                removeFlags[i].value = "0";
                currentSlide = i;
                updateCarousel();
            };
            reader.readAsDataURL(file);
        });
    })
    removes.forEach((btn, i) => {
        btn.addEventListener('click', (ev) => {
            ev.stopPropagation();
            const input = inputs[i];
            input.value = "";
            removeFlags[i].value = "1";
            previews[i] = null;
            miniImgs[i].src = "";
            miniImgs[i].style.display = 'none';
            contents[i].style.display = 'flex';
            btn.style.display = 'none';
            const any = previews.findIndex(p => p);
            currentSlide = any === -1 ? 0 : any;
            updateCarousel();
        });
    });

    updateCarousel();
    const form = document.getElementById('formEditarProduto');
    form.addEventListener('submit', (e) => {
        const hasPreview = previews.some(p => p);
        const serverImgsRaw = window.produtoImgs || [null, null, null, null];
        let hasServerImageLeft = false;
        for (let i = 0; i < serverImgsRaw.length; i++) {
            const old = serverImgsRaw[i];
            const flag = document.getElementById(`remove_input_${i}`).value;
            if (old && old.length > 0 && flag !== '1') {
                hasServerImageLeft = true;
                break;
            }
        }
        if (!hasPreview && !hasServerImageLeft) {
            e.preventDefault();
            alert('Adicione pelo menos uma imagem (ou não remova todas).');
            return;
        }
    });
});