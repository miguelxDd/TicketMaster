@extends('baseOrganizador')

@section('title', 'Editar Evento || Ticket Master')

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
    <h2 class="text-center mb-4 text-primary">Editar Evento</h2>
    <div class="card shadow-lg border-0 rounded">
        <div class="card-body">
            <form action="{{ route('eventos.actualizar', $evento->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Diseño de tres columnas -->
                <div class="row">
                    <!-- Columna 1: Información del Evento -->
                    <div class="col-md-4">
                        <h4 class="text-secondary">Información del Evento</h4>
                        <div class="mb-3">
                            <label for="nombreEvento" class="form-label">Nombre del Evento</label>
                            <input type="text" class="form-control" id="nombreEvento" name="nombreEvento" value="{{ $evento->nombre }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcionEvento" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcionEvento" name="descripcionEvento" rows="3" required>{{ $evento->descripcion }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fechaEvento" class="form-label">Fecha</label>
                            <input type="datetime-local" class="form-control" id="fechaEvento" name="fechaEvento" value="{{ $evento->fecha }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="ubicacionEvento" class="form-label">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacionEvento" name="ubicacionEvento" value="{{ $evento->ubicacion }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="estadoEvento" class="form-label">Estado</label>
                            <select class="form-select" id="estadoEvento" name="estadoEvento" required>
                                <option value="activo" {{ $evento->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="cancelado" {{ $evento->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                <option value="finalizado" {{ $evento->estado == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                            </select>
                        </div>
                    </div>

                    <!-- Columna 2: Localidades Existentes -->
                    <div class="col-md-4">
                        <h4 class="text-secondary">Localidades Existentes</h4>
                        <div id="localidadesContainer" class="mb-3">
                            @foreach($evento->localidades as $localidad)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $localidad->nombre }}</h6>
                                    <div class="mb-2">
                                        <label for="localidades[{{ $localidad->id }}][nombre]" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="localidades[{{ $localidad->id }}][nombre]" name="localidades[{{ $localidad->id }}][nombre]" value="{{ $localidad->nombre }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="localidades[{{ $localidad->id }}][precio]" class="form-label">Precio</label>
                                        <input type="number" class="form-control" id="localidades[{{ $localidad->id }}][precio]" name="localidades[{{ $localidad->id }}][precio]" value="{{ $localidad->precio }}" step="0.01" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="localidades[{{ $localidad->id }}][capacidad]" class="form-label">Capacidad</label>
                                        <input type="number" class="form-control" id="localidades[{{ $localidad->id }}][capacidad]" name="localidades[{{ $localidad->id }}][capacidad]" value="{{ $localidad->capacidad }}" required>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Columna 3: Agregar Nueva Localidad -->
                    <div class="col-md-4">
                        <h4 class="text-secondary">Agregar Nueva Localidad</h4>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-2">
                                    <label for="newLocalidadNombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="newLocalidadNombre">
                                </div>
                                <div class="mb-2">
                                    <label for="newLocalidadPrecio" class="form-label">Precio</label>
                                    <input type="number" class="form-control" id="newLocalidadPrecio" step="0.01">
                                </div>
                                <div class="mb-2">
                                    <label for="newLocalidadCapacidad" class="form-label">Capacidad</label>
                                    <input type="number" class="form-control" id="newLocalidadCapacidad">
                                </div>
                                <button type="button" class="btn btn-outline-primary mt-2 w-100" id="addLocalidadButton">Agregar Localidad</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botón de actualización en barra fija -->
                <div class="fixed-bottom p-3 bg-light border-top text-center">
                    <button type="submit" class="btn btn-primary w-50 fw-bold">Actualizar Evento</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="{{ asset('js/editarEvento.js') }}"></script>
@endsection
