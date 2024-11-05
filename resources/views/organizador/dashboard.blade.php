<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizador - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Dashboard de Organizador -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Panel de Organizador</h1>

        <!-- Tarjetas de eventos -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card" style="width: 100%;">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Imagen del Evento">
                    <div class="card-body">
                        <h5 class="card-title">Evento 1</h5>
                        <p class="card-text">Descripción breve del evento.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Fecha: 2024-12-15</li>
                        <li class="list-group-item">Ubicación: Estadio Nacional</li>
                        <li class="list-group-item">Estado: Activo</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link">Editar</a>
                        <a href="#" class="card-link">Detalles</a>
                    </div>
                </div>
            </div>
            <!-- Repite más tarjetas de eventos según sea necesario -->
        </div>

        <!-- Creación de Evento en Tabs (Pasos) -->
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="eventTabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="step1-tab" data-bs-toggle="tab" href="#step1" role="tab" aria-controls="step1" aria-selected="true">Paso 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="step2-tab" data-bs-toggle="tab" href="#step2" role="tab" aria-controls="step2" aria-selected="false">Paso 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="step3-tab" data-bs-toggle="tab" href="#step3" role="tab" aria-controls="step3" aria-selected="false">Paso 3</a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content">
                <!-- Paso 1: Información básica del evento -->
                <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                    <h5 class="card-title">Paso 1: Información del Evento</h5>
                    <form>
                        <div class="mb-3">
                            <label for="nombreEvento" class="form-label">Nombre del Evento</label>
                            <input type="text" class="form-control" id="nombreEvento" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaEvento" class="form-label">Fecha</label>
                            <input type="datetime-local" class="form-control" id="fechaEvento" required>
                        </div>
                        <div class="mb-3">
                            <label for="ubicacionEvento" class="form-label">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacionEvento" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="activarTab(2)">Siguiente</button>
                    </form>
                </div>

                <!-- Paso 2: Configuración de localidades -->
                <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                    <h5 class="card-title">Paso 2: Localidades</h5>
                    <form>
                        <div class="mb-3">
                            <label for="nombreLocalidad" class="form-label">Nombre de la Localidad</label>
                            <input type="text" class="form-control" id="nombreLocalidad" required>
                        </div>
                        <div class="mb-3">
                            <label for="precioLocalidad" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precioLocalidad" required>
                        </div>
                        <div class="mb-3">
                            <label for="capacidadLocalidad" class="form-label">Capacidad</label>
                            <input type="number" class="form-control" id="capacidadLocalidad" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="activarTab(3)">Siguiente</button>
                    </form>
                </div>

                <!-- Paso 3: Confirmación y Estado del evento -->
                <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                    <h5 class="card-title">Paso 3: Confirmación</h5>
                    <form>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="estadoEvento" checked>
                            <label class="form-check-label" for="estadoEvento">Estado Activo</label>
                        </div>
                        <button type="button" class="btn btn-success">Finalizar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabla de Eventos y Acciones -->
        <div class="mt-5">
            <h2>Gestión de Eventos</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Ubicación</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Concierto Rock</td>
                        <td>2024-12-15</td>
                        <td>Estadio Nacional</td>
                        <td>Activo</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Editar</a>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este evento?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function activarTab(num) {
            document.getElementById('step' + num + '-tab').classList.remove('disabled');
            document.getElementById('step' + num + '-tab').click();
        }
    </script>
</body>
</html>
