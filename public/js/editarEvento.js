document.addEventListener('DOMContentLoaded', function () {
    const addLocalidadButton = document.getElementById('addLocalidadButton');
    const localidadesContainer = document.getElementById('localidadesContainer');
    const form = document.querySelector('form');

    // Agregar nueva localidad con validaciones
    addLocalidadButton.addEventListener('click', function () {
        const newLocalidadId = Date.now();
        const newLocalidadNombre = document.getElementById('newLocalidadNombre').value.trim();
        let newLocalidadPrecio = document.getElementById('newLocalidadPrecio').value.trim();
        const newLocalidadCapacidad = document.getElementById('newLocalidadCapacidad').value.trim();

        // Validación de los campos de la nueva localidad
        if (newLocalidadNombre.length < 2) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El nombre de la localidad debe tener al menos 2 caracteres.',
            });
            return;
        }

        const regexPrecio = /^\d+(\.\d{1,2})?$/;
        if (!regexPrecio.test(newLocalidadPrecio)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El precio debe ser un número válido con hasta dos decimales.',
            });
            return;
        }

        newLocalidadPrecio = parseFloat(newLocalidadPrecio).toFixed(2);

        const capacidad = parseInt(newLocalidadCapacidad, 10);
        if (isNaN(capacidad) || capacidad <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La capacidad debe ser un número mayor a cero.',
            });
            return;
        }

        const newLocalidadHtml = `
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="card-title">${newLocalidadNombre}</h6>
                    <div class="mb-3">
                        <label for="localidades[new_${newLocalidadId}][nombre]" class="form-label">Nombre de la Localidad</label>
                        <input type="text" class="form-control" id="localidades[new_${newLocalidadId}][nombre]" name="localidades[new_${newLocalidadId}][nombre]" value="${newLocalidadNombre}" required>
                    </div>
                    <div class="mb-3">
                        <label for="localidades[new_${newLocalidadId}][precio]" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="localidades[new_${newLocalidadId}][precio]" name="localidades[new_${newLocalidadId}][precio]" value="${newLocalidadPrecio}" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="localidades[new_${newLocalidadId}][capacidad]" class="form-label">Capacidad</label>
                        <input type="number" class="form-control" id="localidades[new_${newLocalidadId}][capacidad]" name="localidades[new_${newLocalidadId}][capacidad]" value="${newLocalidadCapacidad}" required>
                    </div>
                </div>
            </div>
        `;
        localidadesContainer.insertAdjacentHTML('beforeend', newLocalidadHtml);

        // Limpiar los campos del formulario de nueva localidad
        document.getElementById('newLocalidadNombre').value = '';
        document.getElementById('newLocalidadPrecio').value = '';
        document.getElementById('newLocalidadCapacidad').value = '';

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Localidad agregada correctamente',
            showConfirmButton: false,
            timer: 1500
        });
    });

    // Validación del formulario completo antes de envío
    form.addEventListener('submit', function (event) {
        const nombreEvento = document.getElementById('nombreEvento').value.trim();
        const descripcionEvento = document.getElementById('descripcionEvento').value.trim();
        const fechaEvento = document.getElementById('fechaEvento').value.trim();
        const ubicacionEvento = document.getElementById('ubicacionEvento').value.trim();
        const estadoEvento = document.getElementById('estadoEvento').value.trim();

        let valid = true;

        if (!nombreEvento || nombreEvento.length < 5) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El nombre del evento debe tener al menos 5 caracteres.',
            });
            valid = false;
        }

        if (!descripcionEvento) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La descripción del evento no puede estar vacía.',
            });
            valid = false;
        }

        const fechaActual = new Date();
        const fechaEventoDate = new Date(fechaEvento);
        if (fechaEventoDate <= fechaActual) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La fecha del evento debe estar en el futuro.',
            });
            valid = false;
        }

        const regexElSalvador = /El Salvador/i;
        if (!regexElSalvador.test(ubicacionEvento)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La ubicación del evento debe estar en El Salvador!',
            });
            valid = false;
        }

        if (!estadoEvento) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Selecciona el estado del evento.',
            });
            valid = false;
        }

        const regexPrecio = /^\d+(\.\d{1,2})?$/;
        const localidades = document.querySelectorAll('#localidadesContainer .card');
        for (const localidad of localidades) {
            const nombre = localidad.querySelector('[name*="[nombre]"]').value.trim();
            const precio = localidad.querySelector('[name*="[precio]"]').value.trim();
            const capacidad = localidad.querySelector('[name*="[capacidad]"]').value.trim();

            if (!nombre || nombre.length < 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El nombre de cada localidad debe tener al menos 2 caracteres.',
                });
                valid = false;
            }

            if (!regexPrecio.test(precio)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El precio de cada localidad debe ser un número válido con hasta dos decimales.',
                });
                valid = false;
            }

            if (isNaN(parseInt(capacidad, 10)) || parseInt(capacidad, 10) <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'La capacidad de cada localidad debe ser un número mayor a cero.',
                });
                valid = false;
            }
        }

        if (!valid) {
            event.preventDefault();
        }
    });
});