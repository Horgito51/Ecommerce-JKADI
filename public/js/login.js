document.addEventListener('DOMContentLoaded', function () {

    /* =========================
       LOGIN – SPINNER
    ========================= */
    const loginBtn = document.getElementById('loginBtn');
    const loginBtnText = document.getElementById('loginBtnText');
    const loginBtnSpinner = document.getElementById('loginBtnSpinner');
    const form = document.querySelector('form');

    if (form && loginBtn) {
        form.addEventListener('submit', function () {
            loginBtn.disabled = true;
            loginBtnText.textContent = 'Verificando...';
            loginBtnSpinner.style.display = 'inline-block';
        });
    }

    /* =========================
       MOSTRAR / OCULTAR PASSWORD
    ========================= */
    const passwordInput = document.getElementById('password');
    const toggleBtn = document.getElementById('togglePassword');
    const toggleIcon = document.getElementById('toggleIcon');

    if (passwordInput && toggleBtn && toggleIcon) {
        toggleBtn.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';

            passwordInput.type = isPassword ? 'text' : 'password';

            toggleIcon.classList.toggle('bi-eye', !isPassword);
            toggleIcon.classList.toggle('bi-eye-slash', isPassword);
        });
    }

});