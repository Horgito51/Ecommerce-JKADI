document.addEventListener('DOMContentLoaded', () => {
  const payModalEl = document.getElementById('payModal');
  if (!payModalEl) return;

  const payModal = new bootstrap.Modal(payModalEl);

  const btnOpenPay = document.getElementById('btnOpenPay');
  const payForm = document.getElementById('payForm');
  const paySuccess = document.getElementById('paySuccess');
  const btnConfirmPay = document.getElementById('btnConfirmPay');
  const btnPayText = document.getElementById('btnPayText');
  const btnPaySpinner = document.getElementById('btnPaySpinner');

  const cardName = document.getElementById('cardName');
  const cardNumber = document.getElementById('cardNumber');
  const cardExp = document.getElementById('cardExp');
  const cardCvv = document.getElementById('cardCvv');

  btnOpenPay?.addEventListener('click', () => {
    paySuccess?.classList.add('d-none');
    payForm?.reset();
    [cardName, cardNumber, cardExp, cardCvv].forEach(i => i?.classList.remove('is-invalid','is-valid'));
    btnConfirmPay.disabled = false;
    btnPayText.textContent = 'Confirmar pago';
    btnPaySpinner.style.display = 'none';
    payModal.show();
  });

  cardNumber?.addEventListener('input', () => {
    let v = cardNumber.value.replace(/\D/g, '').slice(0, 19);
    cardNumber.value = v.replace(/(\d{4})(?=\d)/g, '$1 ');
  });

  cardExp?.addEventListener('input', () => {
    let v = cardExp.value.replace(/\D/g, '').slice(0, 4);
    if (v.length >= 3) v = v.slice(0,2) + '/' + v.slice(2);
    cardExp.value = v;
  });

  cardCvv?.addEventListener('input', () => {
    cardCvv.value = cardCvv.value.replace(/\D/g, '').slice(0, 4);
  });

  function setValid(el, ok) {
    if (!el) return;
    el.classList.toggle('is-valid', ok);
    el.classList.toggle('is-invalid', !ok);
  }

  function validName() {
    const ok = (cardName?.value || '').trim().length >= 3;
    setValid(cardName, ok);
    return ok;
  }

  function validNumber() {
    const digits = (cardNumber?.value || '').replace(/\D/g, '');
    const ok = digits.length >= 13 && digits.length <= 19;
    setValid(cardNumber, ok);
    return ok;
  }

  function validCvv() {
    const digits = (cardCvv?.value || '').replace(/\D/g, '');
    const ok = digits.length >= 3 && digits.length <= 4;
    setValid(cardCvv, ok);
    return ok;
  }

  function validExp() {
    const v = (cardExp?.value || '').trim();
    const m = v.match(/^(\d{2})\/(\d{2})$/);
    if (!m) { setValid(cardExp, false); return false; }

    const mm = parseInt(m[1], 10);
    const yy = parseInt(m[2], 10);
    if (mm < 1 || mm > 12) { setValid(cardExp, false); return false; }

    const now = new Date();
    const curYY = now.getFullYear() % 100;
    const curMM = now.getMonth() + 1;

    const ok = (yy > curYY) || (yy === curYY && mm >= curMM);
    setValid(cardExp, ok);
    return ok;
  }

  payForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const ok = validName() & validNumber() & validExp() & validCvv();
    if (!ok) {
      paySuccess?.classList.add('d-none');
      return;
    }
    
    // Mostrar spinner y deshabilitar botón
    btnConfirmPay.disabled = true;
    btnPayText.textContent = 'Procesando pago...';
    btnPaySpinner.style.display = 'inline-block';
    paySuccess?.classList.add('d-none');
    
    // Enviar formulario después de 500ms para que se vea el spinner
    setTimeout(() => {
      payForm.submit();
    }, 500);
  });

  cardName?.addEventListener('blur', validName);
  cardNumber?.addEventListener('blur', validNumber);
  cardExp?.addEventListener('blur', validExp);
  cardCvv?.addEventListener('blur', validCvv);
});
