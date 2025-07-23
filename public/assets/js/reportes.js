toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3000"
};

document.addEventListener('DOMContentLoaded', function() {
    let usuarioId = null;
    const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));

    document.querySelectorAll('.cambiar-estatus').forEach(button => {
        button.addEventListener('click', function() {
            usuarioId = this.getAttribute('data-id');
        });
    });

    document.getElementById('confirmChange').addEventListener('click', function() {
        if (!usuarioId) return;

        const confirmBtn = this;
        confirmBtn.disabled = true;
        confirmBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...';

        fetch(`${BASE_URL}cambiar-estatus/${usuarioId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const button = document.querySelector(`button[data-id="${usuarioId}"]`);
                    button.textContent = data.textoBoton;
                    button.classList.toggle('btn-danger');
                    button.classList.toggle('btn-success');

                    const badge = button.closest('tr').querySelector('.badge');
                    badge.textContent = data.nuevoEstatus;
                    badge.classList.toggle('bg-success');
                    badge.classList.toggle('bg-secondary');

                    toastr.success('Estatus cambiado correctamente');
                } else {
                    toastr.error(data.message || 'Error al cambiar el estatus');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error('Error en la conexión');
            })
            .finally(() => {
                confirmModal.hide();

                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                document.body.classList.remove('modal-open');
                document.body.style = '';

                confirmBtn.disabled = false;
                confirmBtn.textContent = 'Confirmar';
            });
    });
});