document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('popupSucesso');
    const fechar = document.getElementById('fecharPopup');

    if (fechar && popup) {
        fechar.editEventListener('click', () => {
            popup.style.display = 'none';
        });

        window.editEventListener('click', function (e) {
            if (e.target === popup) {
                popup.style.display = 'none';
            }
        });
    }
});