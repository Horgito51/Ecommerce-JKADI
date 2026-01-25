document.addEventListener('DOMContentLoaded', function () {

  function setupToggle(inputId, btnId, iconId) {
    const input = document.getElementById(inputId);
    const btn = document.getElementById(btnId);
    const icon = document.getElementById(iconId);

    if (!input || !btn || !icon) return;

    btn.addEventListener('click', function () {
      const isPassword = input.type === 'password';
      input.type = isPassword ? 'text' : 'password';
      icon.classList.toggle('bi-eye', !isPassword);
      icon.classList.toggle('bi-eye-slash', isPassword);
    });
  }

  setupToggle('password', 'togglePassword', 'toggleIconPassword');
  setupToggle('password_confirmation', 'togglePasswordConfirm', 'toggleIconConfirm');
});
