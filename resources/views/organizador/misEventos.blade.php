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

    <!-- Tarjetas de eventos -->
    <div class="row mb-4">
        @foreach($eventos as $evento)
        <div class="col-md-4 mb-4">
            <div class="card" style="width: 100%;">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Imagen del Evento">
                <div class="card-body">
                    <h5 class="card-title">{{ $evento->nombre }}</h5>
                    <p class="card-text">{{ $evento->descripcion }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Fecha: {{ $evento->fecha }}</li>
                    <li class="list-group-item">Ubicación: {{ $evento->ubicacion }}</li>
                    <li class="list-group-item">Estado: {{ $evento->estado }}</li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link" data-bs-toggle="modal" data-bs-target="#modalEvento{{ $evento->id }}">Ver más</a>
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
                            <li class="list-group-item">Fecha: {{ $evento->fecha }}</li>
                            <li class="list-group-item">Ubicación: {{ $evento->ubicacion }}</li>
                            <li class="list-group-item">Estado: {{ $evento->estado }}</li>
                            <li class="list-group-item">Localidades:</li>
                            @foreach($evento->localidades as $localidad)
                            <li class="list-group-item">
                                <strong>{{ $localidad->nombre }}</strong><br>
                                Precio: {{ $localidad->precio }}<br>
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