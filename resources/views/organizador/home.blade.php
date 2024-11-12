@extends('baseOrganizador')

@section('title', 'Home || Ticket Master')

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
    <!-- Gestión de Eventos -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="mb-2">Gestión de Eventos</h2>
        <a href="{{ url('/organizador/crearEvento') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Crear Evento
        </a>
    </div>

    <!-- Tabla de Eventos (con contenedor scroll en pantallas pequeñas) -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Fecha y Hora</th>
                    <th>Ubicación</th>
                    <th>Localidades</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eventos as $evento)
                <tr>
                    <td>{{ $evento->nombre }}</td>
                    <td>{{ $evento->fecha }}</td>
                    <td>{{ $evento->ubicacion }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalLocalidades{{ $evento->id }}">
                            <i class="fas fa-eye"></i> Ver
                        </button>
                    </td>
                    <td>
                        <span class="badge bg-{{ $evento->estado == 'activo' ? 'success' : 'secondary' }}">
                            {{ ucfirst($evento->estado) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('eventos.editar', $evento->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $evento->id }}">
                            <i class="fas fa-trash-alt"></i> Eliminar
                        </button>
                    </td>
                </tr>

                <!-- Modal Localidades -->
                <div class="modal fade" id="modalLocalidades{{ $evento->id }}" tabindex="-1" aria-labelledby="modalLocalidadesLabel{{ $evento->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="modalLocalidadesLabel{{ $evento->id }}">Localidades de {{ $evento->nombre }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group list-group-flush">
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

                <!-- Modal Eliminar -->
                <div class="modal fade" id="deleteModal{{ $evento->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $evento->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteModalLabel{{ $evento->id }}">Eliminar Evento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Estás seguro de que deseas eliminar el evento "<strong>{{ $evento->nombre }}</strong>"?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('eventos.eliminar', $evento->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
@endsection

@section('footer')
<footer class="bg-dark text-white text-center py-3 mt-auto">
    <p class="mb-0">Ticket Master 2024 &copy; Todos los derechos reservados</p>
</footer>
@endsection
