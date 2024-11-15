@extends('baseOrganizador')

@section('title', 'Inicio || Ticket Master')
@section('personalizar-navbar-items')
<li class="nav-item">
    <a class="nav-link" href="{{ url('comprador/comprar') }}">Comprar Entradas</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('comprador/misEventos') }}">Mis Entradas</a>
@endsection

@section('content')
<div class="container my-5">
    <!-- Hero section con llamada a la acción -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h1 class="display-4 text-primary">¡Bienvenidos a Ticket Master!</h1>
            <p class="lead">Encuentra y compra entradas para los eventos más exclusivos de la ciudad. Desde conciertos hasta teatro y eventos deportivos, disfruta de experiencias únicas con nosotros.</p>
            <a href="{{ url('comprador/comprar') }}" class="btn btn-primary btn-lg mt-3">Comprar Entradas</a>
        </div>
    </div>

    <!-- Sección de beneficios -->
    <div class="row text-center my-5">
        <div class="col-md-4 mb-4">
            <i class="fas fa-ticket-alt fa-3x text-primary mb-3"></i>
            <h5>Entradas Exclusivas</h5>
            <p>Accede a los mejores eventos antes que nadie y asegura tu lugar en experiencias únicas.</p>
        </div>
        <div class="col-md-4 mb-4">
            <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
            <h5>Compra Segura</h5>
            <p>Transacciones seguras y confiables para que compres tus entradas sin preocupaciones.</p>
        </div>
        <div class="col-md-4 mb-4">
            <i class="fas fa-heart fa-3x text-primary mb-3"></i>
            <h5>Experiencias Inolvidables</h5>
            <p>Vive momentos inolvidables en los eventos que amas, ¡solo en Ticket Master!</p>
        </div>
    </div>

    <!-- Sección de eventos destacados -->
    <div class="container my-5">
        <h2 class="text-center mb-4 text-primary">Eventos Comprados Recientemente</h2>
    
        <div class="row">
            @foreach($localidadesRecientes as $localidad)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $localidad->evento->nombre }}</h5>
                        <p class="card-text">{{ $localidad->evento->descripcion }}</p>
                        <p class="card-text"><strong>Localidad Comprada:</strong> {{ $localidad->nombre }}</p>
                        <p class="card-text"><strong>Fecha:</strong> {{ $localidad->evento->fecha }}</p>
                        <p class="card-text"><strong>Ubicación:</strong> {{ $localidad->evento->ubicacion }}</p>
                        <a href="{{ route('comprador.comprar') }}" class="btn btn-outline-primary">Comprar Entradas</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection