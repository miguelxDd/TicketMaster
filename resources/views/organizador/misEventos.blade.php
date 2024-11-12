@extends('baseOrganizador')

@section('title', 'Panel de Organizador || Ticket Master')
@section('personalizar-navbar-items')
<li class="nav-item">
    <a class="nav-link" href="{{ url('organizador/home') }}">Inicio</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('#') }}">Eventos</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('organizador/contacto') }}">Contacto</a>
</li>

@endsection

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Mis Eventos</h1>

    <!-- Tarjetas de eventos con scroll -->
    <div class="row mb-4" style="max-height: 500px; overflow-y: auto;">
        @foreach($eventos as $evento)
        <div class="col-md-4 mb-4 d-flex align-items-stretch">
            <div class="card shadow-sm border-0 rounded" style="width: 100%; background-color: #f9f9f9;">
                <div class="card-header text-white" style="background: linear-gradient(135deg, #ff4b2b, #ff416c);">
                    <h5 class="mb-0">{{ $evento->nombre }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ Str::limit($evento->descripcion, 80, '...') }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">📅 Fecha: {{ $evento->fecha }}</li>
                    <li class="list-group-item">📍 Ubicación: {{ $evento->ubicacion }}</li>
                    <li class="list-group-item">📌 Estado: <span class="badge bg-primary">{{ ucfirst($evento->estado) }}</span></li>
                </ul>
                <div class="card-body text-center">
                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEvento{{ $evento->id }}">Ver más</a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalEvento{{ $evento->id }}" tabindex="-1" aria-labelledby="modalEventoLabel{{ $evento->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEventoLabel{{ $evento->id }}">{{ $evento->nombre }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $evento->descripcion }}</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">📅 Fecha: {{ $evento->fecha }}</li>
                            <li class="list-group-item">📍 Ubicación: {{ $evento->ubicacion }}</li>
                            <li class="list-group-item">📌 Estado: <span class="badge bg-primary">{{ ucfirst($evento->estado) }}</span></li>
                            <li class="list-group-item">🎟️ Localidades:</li>
                            @foreach($evento->localidades as $localidad)
                            <li class="list-group-item">
                                <strong>{{ $localidad->nombre }}</strong><br>
                                Precio: ${{ number_format($localidad->precio, 2) }}<br>
                                Capacidad: {{ $localidad->capacidad }}<br>
                                Asientos disponibles: {{ $localidad->asientos_disponibles }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
@endsection
