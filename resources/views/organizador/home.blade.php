@extends('baseOrganizador')

@section('title', 'Gestión de Eventos || Ticket Master')
@section('personalizar-navbar-items')
<li class="nav-item">
    <a class="nav-link" href="{{ url('#') }}">Inicio</a>
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
        <div class="mt-5">
            <h2>Gestión de Eventos</h2> 
            <a href="{{ url('/organizador/crearEvento') }}" class="btn btn-success">Crear Evento</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Ubicación</th>
                        <th>Localidades</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Concierto Rock</td>
                        <td>2024-12-15</td>
                        <td>Estadio Nacional</td>
                        <td>Ver</td>
                        <td>Activo</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Editar</a>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar</button>
                        </td>
                    </tr>
                    <!-- Agrega más filas de eventos según sea necesario -->
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
@endsection


