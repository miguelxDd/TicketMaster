document.addEventListener('DOMContentLoaded', function () {
    // Lista para almacenar las localidades
    let localidades = [];

    // Función para activar una pestaña específica
    function activarTab(tabIndex) {
        const tabs = document.querySelectorAll('#eventTabs .nav-link');
        const tabContents = document.querySelectorAll('.tab-pane');

        tabs.forEach((tab, index) => {
            if (index + 1 === tabIndex) {
                tab.classList.remove('disabled');
                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');
                tabContents[index].classList.add('show', 'active');
            } else {
                tab.classList.remove('active');
                tab.setAttribute('aria-selected', 'false');
                tabContents[index].classList.remove('show', 'active');
            }
        });
    }

    // Configurar el campo de fecha
    const fechaEventoInput = document.querySelector('#fechaEvento');
    const fechaActual = new Date();
    const dosAniosAdelante = new Date(fechaActual);
    dosAniosAdelante.setFullYear(fechaActual.getFullYear() + 2);

    fechaEventoInput.min = fechaActual.toISOString().slice(0, 16);
    fechaEventoInput.max = dosAniosAdelante.toISOString().slice(0, 16);

    // Validar el primer paso y habilitar el segundo paso
    document.querySelector('#step1 button').addEventListener('click', function () {
        const nombreEvento = document.querySelector('#nombreEvento').value.trim();
        const fechaEvento = document.querySelector('#fechaEvento').value.trim();
        const ubicacionEvento = document.querySelector('#ubicacionEvento').value.trim();

        // Validar nombre del evento
        if (nombreEvento.length < 5 || nombreEvento.length > 200) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El nombre del evento debe tener entre 5 y 200 caracteres!',
            });
            return;
        }

        // Validar fecha del evento
        const fechaEventoDate = new Date(fechaEvento);

        if (fechaEventoDate <= fechaActual) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La fecha del evento debe estar en el futuro!',
            });
            return;
        }

        if (fechaEventoDate > dosAniosAdelante) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La fecha del evento no puede ser más de 2 años en el futuro!',
            });
            return;
        }

        // Validar ubicación del evento (solo El Salvador)
        const regexElSalvador = /El Salvador/i;
        if (!regexElSalvador.test(ubicacionEvento)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La ubicación del evento debe estar en El Salvador!',
            });
            return;
        }

        if (nombreEvento && fechaEvento && ubicacionEvento) {
            activarTab(2);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Por favor, complete todos los campos del Paso 1!',
            });
        }
    });

    // Validar el segundo paso y habilitar el tercer paso
    document.querySelector('#step2 button').addEventListener('click', function () {
        activarTab(3);
    });

    // Manejar el botón "Agregar Localidad"
    document.querySelector('#addLocalidadButton').addEventListener('click', function () {
        const nombreLocalidad = document.querySelector('#nombreLocalidad').value.trim();
        let precioLocalidad = document.querySelector('#precioLocalidad').value.trim();
        const capacidadLocalidad = document.querySelector('#capacidadLocalidad').value.trim();

        // Validar nombre de la localidad
        if (!nombreLocalidad) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El nombre de la localidad no debe estar vacío!',
            });
            return;
        }

        // Validar precio de la localidad
        const regexPrecio = /^\d+(\.\d{1,2})?$/;
        if (!regexPrecio.test(precioLocalidad)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El precio debe ser un número con hasta dos decimales!',
            });
            return;
        }

        // Convertir el precio a número
        precioLocalidad = parseFloat(precioLocalidad).toFixed(2);

        // Validar capacidad de la localidad
        const capacidad = parseInt(capacidadLocalidad, 10);
        if (isNaN(capacidad) || capacidad <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La capacidad debe ser un número entero mayor a cero!',
            });
            return;
        }

        // Agregar la localidad a la lista en memoria
        localidades.push({
            nombre: nombreLocalidad,
            precio: precioLocalidad,
            capacidad: capacidadLocalidad
        });

        // Mostrar la localidad en la lista
        const localidadesList = document.querySelector('#localidadesList');
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item';
        listItem.textContent = `Nombre: ${nombreLocalidad}, Precio: ${precioLocalidad}, Capacidad: ${capacidadLocalidad}`;
        localidadesList.appendChild(listItem);

        // Limpiar los campos
        document.querySelector('#nombreLocalidad').value = '';
        document.querySelector('#precioLocalidad').value = '';
        document.querySelector('#capacidadLocalidad').value = '';

        // Mostrar alerta de éxito
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Localidad agregada',
            showConfirmButton: false,
            timer: 1500
        });
    });

    // Validar el tercer paso y enviar el formulario
    document.querySelector('#finalizarBtn').addEventListener('click', function () {
        if (localidades.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debe agregar al menos una localidad!',
            });
            return;
        }

        // Crear campos ocultos para las localidades
        const form = document.querySelector('#crearEventoForm');
        localidades.forEach((localidad, index) => {
            form.insertAdjacentHTML('beforeend', `<input type="hidden" name="localidades[${index}][nombre]" value="${localidad.nombre}">`);
            form.insertAdjacentHTML('beforeend', `<input type="hidden" name="localidades[${index}][precio]" value="${localidad.precio}">`);
            form.insertAdjacentHTML('beforeend', `<input type="hidden" name="localidades[${index}][capacidad]" value="${localidad.capacidad}">`);
        });

        // Asegurarse de que el valor del checkbox se envía correctamente
        const estadoEventoCheckbox = document.querySelector('#estadoEvento');
        const hiddenEstadoEvento = document.createElement('input');
        hiddenEstadoEvento.type = 'hidden';
        hiddenEstadoEvento.name = 'estadoEvento';
        hiddenEstadoEvento.value = estadoEventoCheckbox.checked ? 'activo' : 'finalizado';
        form.appendChild(hiddenEstadoEvento);

        console.log('Estado del checkbox antes de enviar:', estadoEventoCheckbox.checked, estadoEventoCheckbox.value);
        console.log('Valor del campo oculto antes de enviar:', hiddenEstadoEvento.value);

        // Agregar registro de depuración para ver todos los datos enviados
        const formData = new FormData(form);
        formData.forEach((value, key) => {
            console.log(key, value);
        });

        form.submit();
    });

    // Manejar el cambio del switch en el paso 2
    document.querySelector('#estadoEvento').addEventListener('change', function () {
        const switchElement = this;
        const estadoLabel = document.querySelector('label[for="estadoEvento"]');
        const nombreEvento = document.querySelector('#nombreEvento').value.trim();

        if (!switchElement.checked) {
            Swal.fire({
                title: '¿Está seguro?',
                text: `¿Está seguro que desea cambiar su evento "${nombreEvento}" a "finalizado"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    estadoLabel.textContent = 'Estado Finalizado';
                    switchElement.value = 'finalizado';
                } else {
                    switchElement.checked = true;
                }
            });
        } else {
            estadoLabel.textContent = 'Estado Activo';
            switchElement.value = 'activo';
        }
    });
});