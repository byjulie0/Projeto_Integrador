document.addEventListener('DOMContentLoaded', function() {
const email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const senha = 6;
    
    const form = document.getElementById('formCadastro');
    const submitButton = document.getElementById('submitButton');
    const emailInput = document.querySelector('input[name="email"]');
    const senhaInput = document.querySelector('input[name="senha"]');
    const cpfcnpjInput = document.querySelector('input[name="cpf_cnpj"]');
    
    function emailValidate() {
        const emailValue = emailInput.value;
        if (email.test(emailValue)) {
            document.getElementById('emailError').style.display = 'none';
            return true;
        } else {
            document.getElementById('emailError').style.display = 'block';
            return false;
        }
    }
    
    function senhaValidate() {
        const senhaValue = senhaInput.value;
        if (senhaValue.length >= senha) {
            document.getElementById('senhaError').style.display = 'none';
            return true;
        } else {
            document.getElementById('senhaError').style.display = 'block';
            return false;
        }
    }
    
    function validateForm(event) {
        const isEmailValid = emailValidate();
        const isSenhaValid = senhaValidate();

        if (!isEmailValid || !isSenhaValid) {
            event.preventDefault();
        }
    }
    
    form.addEventListener('submit', validateForm);

    emailInput.addEventListener('input', emailValidate);

    senhaInput.addEventListener('input', senhaValidate);
});