document.addEventListener('DOMContentLoaded', () => {
    const rucRadio = document.getElementById('docRuc');
    const cedRadio = document.getElementById('docCed');
    const inputDoc = document.getElementById('cli_ruc_ced');
    const help = document.getElementById('docHelp');

    const btnVerificar = document.getElementById('btnVerificar');
    const alertBox = document.getElementById('verifyAlert');

    const inpNombre = document.querySelector('input[name="cli_nombre"]');
    const inpTel = document.querySelector('input[name="cli_telefono"]');
    const selCiudad = document.querySelector('select[name="ciudad_id"]');
    const inpDir = document.querySelector('input[name="cli_direccion"]');
    const inpEmail = document.querySelector('input[name="cli_email"]');

    function showAlert(type, msg) {
        alertBox.className = `alert alert-${type}`;
        alertBox.textContent = msg;
        alertBox.classList.remove('d-none');
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

    rucRadio.addEventListener('change', updateDocHint);
    cedRadio.addEventListener('change', updateDocHint);
    updateDocHint();

    btnVerificar?.addEventListener('click', async () => {
        alertBox.classList.add('d-none');

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

            if (!data.found) {
                showAlert('info', data.message || 'No encontramos un cliente con este documento. Puedes continuar con el registro.');
                return;
            }

            if (data.has_account) {
                showAlert('warning', data.message || 'Este cliente ya tiene una cuenta registrada. Inicia sesión para continuar.');
                setTimeout(() => {
                    window.location.href = "/login";
                }, 2500);
                return;
            }

            const c = data.cliente || {};
            if (c.cli_nombre) inpNombre.value = c.cli_nombre;
            if (c.cli_telefono) inpTel.value = c.cli_telefono;
            if (c.ciudad_id) selCiudad.value = c.ciudad_id;
            if (c.cli_direccion) inpDir.value = c.cli_direccion;
            if (c.cli_email) inpEmail.value = c.cli_email;

            showAlert('success', data.message || 'Cliente encontrado. Datos autocompletados. Revisa antes de registrar.');

        } catch (e) {
            showAlert('danger', 'Error de red al verificar. Intenta nuevamente.');
        } finally {
            btnVerificar.disabled = false;
            btnVerificar.textContent = oldText;
        }
    });
});
