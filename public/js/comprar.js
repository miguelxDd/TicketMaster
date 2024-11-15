document.addEventListener('DOMContentLoaded', function () {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('shown.bs.modal', function () {
            const localidadSelect = modal.querySelector('#localidad');
            const cantidadInput = modal.querySelector('#cantidad');

            localidadSelect.addEventListener('change', function () {
                const max = localidadSelect.options[localidadSelect.selectedIndex].getAttribute('data-max');
                cantidadInput.setAttribute('max', max);
            });

            // Inicializar el valor máximo cuando se abre el modal
            const max = localidadSelect.options[localidadSelect.selectedIndex].getAttribute('data-max');
            cantidadInput.setAttribute('max', max);
        });
    });

    if (document.querySelector('#buscar-eventos')) {
        $('#buscar-eventos').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: buscarEventosUrl,
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                $('#buscar-eventos').val(ui.item.value);
                // Aquí puedes agregar lógica adicional para manejar la selección del evento
                return false;
            }
        });
    }
});

function confirmarCompra(eventoId) {
    const form = document.getElementById(`formCompra${eventoId}`);
    const localidadSelect = form.querySelector('#localidad');
    const cantidadInput = form.querySelector('#cantidad');
    const localidad = localidadSelect.options[localidadSelect.selectedIndex];
    const max = parseInt(localidad.getAttribute('data-max'));
    const precio = parseFloat(localidad.getAttribute('data-precio'));
    const cantidad = parseInt(cantidadInput.value);

    if (isNaN(cantidad) || cantidad <= 0) {
        Swal.fire({
            title: 'Error',
            text: 'Por favor, ingresa una cantidad válida de entradas.',
            icon: 'error',
            confirmButtonText: 'Cerrar'
        });
        return;
    }

    if (cantidad > max) {
        Swal.fire({
            title: 'Error',
            text: `No puedes comprar más de ${max} entradas para esta localidad.`,
            icon: 'error',
            confirmButtonText: 'Cerrar'
        });
        return;
    }

    const total = precio * cantidad;

    Swal.fire({
        title: 'Confirmar Compra',
        html: `¿Estás seguro de que deseas comprar ${cantidad} entradas por un total de $${total}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, comprar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}