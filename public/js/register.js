document.addEventListener('DOMContentLoaded', () => {
  const rucRadio = document.getElementById('docRuc');
  const cedRadio = document.getElementById('docCed');
  const inputDoc = document.getElementById('cli_ruc_ced');
  const help = document.getElementById('docHelp');

  const btnVerificar = document.getElementById('btnVerificar');
  const alertBox = document.getElementById('verifyAlert');

  // Campos a autocompletar
  const inpNombre = document.querySelector('input[name="cli_nombre"]');
  const inpTel = document.querySelector('input[name="cli_telefono"]');
  const inpDir = document.querySelector('input[name="cli_direccion"]');
  const inpEmail = document.querySelector('input[name="cli_email"]');

  //Ciudad: select + hidden espejo
  const selCiudad = document.getElementById('ciudad_select') || document.querySelector('select[name="ciudad_id"]');
  const ciudadHidden = document.getElementById('ciudad_hidden'); // input hidden

  //Form (para asegurar hidden al submit)
  const form = document.querySelector('form');

  // Para limpiar/bloquear cuando el doc cambia
  let docVerificado = null;
  let bloqueoActivo = false;

  function showAlert(type, msg) {
    alertBox.className = `alert alert-${type}`;
    alertBox.textContent = msg;
    alertBox.classList.remove('d-none');
  }

  function hideAlert() {
    alertBox.classList.add('d-none');
  }

  function updateDocHint() {
    if (rucRadio.checked) {
      inputDoc.setAttribute('maxlength', '13');
      inputDoc.setAttribute('minlength', '13');
      help.textContent = 'RUC: 13 dígitos';
    } else {
      inputDoc.setAttribute('maxlength', '10');
      inputDoc.setAttribute('minlength', '10');
      help.textContent = 'Cédula: 10 dígitos';
    }
  }

  function limpiarAutocompletado() {
    inpNombre.value = '';
    inpTel.value = '';
    if (selCiudad) selCiudad.value = '';
    inpDir.value = '';
    inpEmail.value = '';

    //limpiar hidden ciudad
    if (ciudadHidden) ciudadHidden.value = '';

    hideAlert();
    docVerificado = null;
  }

  function bloquearCamposAutocompletados() {
    // Bloquea solo campos autocompletados
    [inpNombre, inpTel, inpDir, inpEmail].forEach(el => {
      el.readOnly = true;
      el.classList.add('input-bloqueado');
    });

    //Bloquear ciudad (select) + tono gris
    if (selCiudad) {
      selCiudad.disabled = true;
      selCiudad.classList.add('input-bloqueado');
      // Copiar valor al hidden para que se envíe en el POST
      if (ciudadHidden) ciudadHidden.value = selCiudad.value;
    }

    bloqueoActivo = true;
  }

  function desbloquearCamposAutocompletados() {
    [inpNombre, inpTel, inpDir, inpEmail].forEach(el => {
      el.readOnly = false;
      el.classList.remove('input-bloqueado'); // ✅ quitar gris
    });

    // ✅ Desbloquear ciudad y limpiar hidden
    if (selCiudad) {
      selCiudad.disabled = false;
      selCiudad.classList.remove('input-bloqueado');
    }
    if (ciudadHidden) ciudadHidden.value = '';

    bloqueoActivo = false;
  }

  //Asegurar hidden si ciudad está bloqueada al enviar
  form?.addEventListener('submit', () => {
    if (selCiudad?.disabled && ciudadHidden) {
      ciudadHidden.value = selCiudad.value;
    }
  });

  // Si cambian el documento DESPUÉS de verificar, limpiamos datos autocompletados
  inputDoc.addEventListener('input', () => {
    const actual = (inputDoc.value || '').trim();

    if (docVerificado && actual !== docVerificado) {
      if (bloqueoActivo) desbloquearCamposAutocompletados();
      limpiarAutocompletado();
    }
  });

  rucRadio.addEventListener('change', () => {
    updateDocHint();
    if (docVerificado) {
      if (bloqueoActivo) desbloquearCamposAutocompletados();
      limpiarAutocompletado();
    }
  });

  cedRadio.addEventListener('change', () => {
    updateDocHint();
    if (docVerificado) {
      if (bloqueoActivo) desbloquearCamposAutocompletados();
      limpiarAutocompletado();
    }
  });

  updateDocHint();

  btnVerificar?.addEventListener('click', async () => {
    hideAlert();

    const doc = (inputDoc.value || '').trim();
    const tipo = rucRadio.checked ? 'RUC' : 'CEDULA';

    if (!doc) {
      showAlert('warning', 'Ingresa tu cédula/RUC para verificar.');
      return;
    }

    btnVerificar.disabled = true;
    const oldText = btnVerificar.textContent;
    btnVerificar.textContent = 'Verificando...';

    try {
      const url = new URL('/register/verificar', window.location.origin);
      url.searchParams.set('cli_ruc_ced', doc);
      url.searchParams.set('tipo_documento', tipo);

      const res = await fetch(url.toString(), {
        method: 'GET',
        headers: { 'Accept': 'application/json' }
      });

      const data = await res.json();

      if (!res.ok) {
        showAlert('danger', data.message || 'No se pudo verificar. Revisa el documento.');
        return;
      }

      // No encontrado => sigue flujo normal
      if (!data.found) {
        if (bloqueoActivo) desbloquearCamposAutocompletados();
        docVerificado = null;

        showAlert('info', data.message || 'No encontramos un cliente con este documento. Puedes continuar con el registro.');
        return;
      }

      // Encontrado pero ya tiene cuenta => avisar y redirigir a login
      if (data.has_account) {
        showAlert('warning', data.message || 'Este cliente ya tiene una cuenta registrada. Serás redirigido al inicio de sesión.');

        const redirectInput = document.querySelector('input[name="redirect"]');
        const redirect = redirectInput ? redirectInput.value : '/catalogo';

        setTimeout(() => {
          window.location.href = `/login?redirect=${encodeURIComponent(redirect)}`;
        }, 2000);

        return;
      }

      // Encontrado y sin cuenta: autocompletar y bloquear campos
      const c = data.cliente || {};

      if (c.cli_nombre) inpNombre.value = c.cli_nombre;
      if (c.cli_telefono) inpTel.value = c.cli_telefono;
      if (c.ciudad_id && selCiudad) selCiudad.value = c.ciudad_id;
      if (c.cli_direccion) inpDir.value = c.cli_direccion;
      if (c.cli_email) inpEmail.value = c.cli_email;

      //Copiar ciudad al hidden
      if (c.ciudad_id && ciudadHidden) ciudadHidden.value = c.ciudad_id;

      // Guardamos el doc verificado
      docVerificado = doc;

      // Bloquea autocompletados pero no contraseña
      bloquearCamposAutocompletados();

      showAlert('success', data.message || 'Cliente encontrado. Datos autocompletados. Revisa antes de registrar.');

    } catch (e) {
      showAlert('danger', 'Error de red al verificar. Intenta nuevamente.');
    } finally {
      btnVerificar.disabled = false;
      btnVerificar.textContent = oldText;
    }
  });
});
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
