document.addEventListener('DOMContentLoaded', function () {
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const senhaMinLength = 6;

    const form = document.getElementById('formCadastro');
    const emailInput = document.querySelector('input[name="email"]');
    const senhaInput = document.querySelector('input[name="senha"]');
    const confirmarSenhaInput = document.querySelector('input[name="senha-confirmar"]');
    const emailError = document.getElementById('emailError');
    const senhaLengthError = document.getElementById('senhaLengthError');
    const senhaConfirmError = document.getElementById('senhaConfirmError');

    function emailValidate() {
        const emailValue = emailInput.value;
        if (emailRegex.test(emailValue)) {
            emailError.style.display = 'none';
            return true;
        } else {
            emailError.style.display = 'block';
            return false;
        }
    }

    function senhaValidate() {
        const senhaValue = senhaInput.value;
        if (senhaValue.length >= senhaMinLength) {
            senhaLengthError.style.display = 'none';
            return true;
        } else {
            senhaLengthError.textContent = `A senha deve ter pelo menos ${senhaMinLength} caracteres.`;
            senhaLengthError.style.display = 'block';
            senhaConfirmError.style.display = 'none'; 
            return false;
        }
    }

    function confirmarSenhaValidate() {
        const senhaValue = senhaInput.value;
        const confirmarValue = confirmarSenhaInput.value;

        if (senhaValue.length < senhaMinLength) {
            senhaConfirmError.style.display = "none";
            return false;
        }

        if (senhaValue !== confirmarValue) {
            senhaConfirmError.textContent = "As senhas não coincidem";
            senhaConfirmError.style.display = "block";
            return false;
        } else {
            senhaConfirmError.style.display = "none";
            return true;
        }
    }

    function validateForm(event) {
        const isEmailValid = emailValidate();
        const isSenhaValid = senhaValidate();
        const isConfirmValid = confirmarSenhaValidate();

        if (!isEmailValid || !isSenhaValid || !isConfirmValid) {
            event.preventDefault();
        }
    }

    emailInput.addEventListener('input', emailValidate);
    senhaInput.addEventListener('input', () => {
        senhaValidate();
        confirmarSenhaValidate(); 
    });
    confirmarSenhaInput.addEventListener('input', confirmarSenhaValidate);

    form.addEventListener('submit', validateForm);
});
