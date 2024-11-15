@extends('baseOrganizador')

@section('title', 'Comprar Entradas || Ticket Master')
@section('personalizar-navbar-items')
<li class="nav-item">
    <a class="nav-link" href="{{ url('comprador/home') }}">Inicio</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('comprador/misEventos') }}">Mis Entradas</a>
@endsection

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4 text-primary">Eventos</h2>

    <!-- Buscador de eventos -->
    <div class="mb-4">
        <form action="{{ route('comprador.comprar') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Buscar eventos..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>

    <!-- Lista de eventos -->
    <div class="row">
        @foreach($eventos as $evento)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $evento->nombre }}</h5>
                    <p class="card-text">{{ $evento->descripcion }}</p>
                    <p class="card-text"><strong>Fecha:</strong> {{ $evento->fecha }}</p>
                    <p class="card-text"><strong>Ubicación:</strong> {{ $evento->ubicacion }}</p>
                    @if(Carbon\Carbon::parse($evento->fecha)->isPast())
                        <span class="badge bg-danger">Evento Finalizado</span>
                        <button class="btn btn-secondary" disabled>Comprar</button>
                    @else
                        <span class="badge bg-success">Evento Activo</span>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#comprarModal{{ $evento->id }}">Comprar</button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal para comprar entradas -->
        <div class="modal fade" id="comprarModal{{ $evento->id }}" tabindex="-1" aria-labelledby="comprarModalLabel{{ $evento->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="comprarModalLabel{{ $evento->id }}">Comprar Entradas para {{ $evento->nombre }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formCompra{{ $evento->id }}" action="{{ route('comprador.procesarCompra', $evento->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="localidad" class="form-label">Seleccionar Localidad</label>
                                <select class="form-select" id="localidad" name="localidad" required>
                                    @foreach($evento->localidades as $localidad)
                                    <option value="{{ $localidad->id }}" data-max="{{ $localidad->asientos_disponibles }}" data-precio="{{ $localidad->precio }}">
                                        {{ $localidad->nombre }} - Disponibles: {{ $localidad->asientos_disponibles }} - Precio: ${{ $localidad->precio }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad de Entradas</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" required>
                            </div>
                            <div class="mb-3">
                                <label for="metodo_pago" class="form-label">Método de Pago</label>
                                <select class="form-select" id="metodo_pago" name="metodo_pago" required>
                                    <option value="tarjeta" disabled>Tarjeta de Crédito</option>
                                    <option value="efectivo">Pasar a Local</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="confirmarCompra({{ $evento->id }})">Comprar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            title: 'Compra realizada con éxito',
            html: `
                <p><strong>Boleto:</strong> {{ session('boleto')->codigo_boleto }}</p>
                <p><strong>Estado:</strong> {{ session('boleto')->estado_boleto }}</p>
                <div><img src="{{ session('qrCodeImage') }}" alt="Código QR"></div>
                <a href="{{ session('qrCodeImage') }}" download="qr_code.png" class="btn btn-primary mt-3">Descargar QR</a>
            `,
            icon: 'success',
            confirmButtonText: 'Cerrar'
        });
    });
</script>
@endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="{{ asset('js/comprar.js') }}"></script>
<script>
    const buscarEventosUrl = "{{ route('comprador.buscarEventos') }}";
</script>
@endsection