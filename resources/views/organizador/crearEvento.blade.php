@extends('baseOrganizador')

@section('title', 'Crear Evento || Ticket Master')
@section('personalizar-navbar-items')
<li class="nav-item">
    <a class="nav-link" href="{{ url('organizador/home') }}">Inicio</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('organizador/misEventos') }}">Eventos</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('organizador/contacto') }}">Contacto</a>
</li>
@endsection

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4 text-primary">Creación de Evento</h2>

    <!-- Creación de Evento en Tabs (Pasos) -->
    <div class="card shadow-lg border-0 rounded">
        <div class="card-header bg-gradient text-white text-center" style="background: linear-gradient(135deg, #1f8ef1, #0072ff);">
            <ul class="nav nav-tabs card-header-tabs justify-content-center" id="eventTabs">
                <li class="nav-item">
                    <a class="nav-link active fw-bold" id="step1-tab" data-bs-toggle="tab" href="#step1" role="tab" aria-controls="step1" aria-selected="true">Paso 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled fw-bold" id="step2-tab" data-bs-toggle="tab" href="#step2" role="tab" aria-controls="step2" aria-selected="false">Paso 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled fw-bold" id="step3-tab" data-bs-toggle="tab" href="#step3" role="tab" aria-controls="step3" aria-selected="false">Paso 3</a>
                </li>
            </ul>
        </div>
        
        <div class="card-body tab-content">
            <!-- Paso 1: Información básica del evento -->
            <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                <h5 class="card-title text-secondary">Paso 1: Información del Evento</h5>
                <form id="crearEventoForm" action="{{ route('eventos.guardar') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombreEvento" class="form-label">Nombre del Evento</label>
                        <input type="text" class="form-control" id="nombreEvento" name="nombreEvento" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcionEvento" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcionEvento" name="descripcionEvento" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fechaEvento" class="form-label">Fecha</label>
                        <input type="datetime-local" class="form-control" id="fechaEvento" name="fechaEvento" required>
                    </div>
                    <div class="mb-3">
                        <label for="ubicacionEvento" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacionEvento" name="ubicacionEvento" required>
                    </div>
                    <button type="button" class="btn btn-primary w-100 fw-bold mt-3">Siguiente</button>
                </form>
            </div>

            <!-- Paso 2: Estado del evento -->
            <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                <h5 class="card-title text-secondary">Paso 2: Estado del Evento</h5>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="estadoEvento" name="estadoEvento" value="activo" checked>
                    <label class="form-check-label" for="estadoEvento">Estado Activo</label>
                </div>
                <input type="hidden" name="estadoEvento" value="finalizado">
                <button type="button" class="btn btn-primary w-100 fw-bold mt-3">Siguiente</button>
            </div>

            <!-- Paso 3: Configuración de localidades -->
            <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                <h5 class="card-title text-secondary">Paso 3: Localidades</h5>
                <div class="mb-3">
                    <label for="nombreLocalidad" class="form-label">Nombre de la Localidad</label>
                    <input type="text" class="form-control" id="nombreLocalidad" name="nombreLocalidad">
                </div>
                <div class="mb-3">
                    <label for="precioLocalidad" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="precioLocalidad" name="precioLocalidad" step="0.01">
                </div>
                <div class="mb-3">
                    <label for="capacidadLocalidad" class="form-label">Capacidad</label>
                    <input type="number" class="form-control" id="capacidadLocalidad" name="capacidadLocalidad">
                </div>
                <button type="button" class="btn btn-outline-primary w-100 fw-bold" id="addLocalidadButton">Agregar Localidad</button>
                <ul id="localidadesList" class="list-group mt-3"></ul>
                <button type="button" class="btn btn-success w-100 fw-bold mt-3" id="finalizarBtn">Finalizar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="{{ asset('js/crearEvento.js') }}"></script>
@endsection
