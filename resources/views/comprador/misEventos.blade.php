@extends('baseOrganizador')

@section('title', 'Mis Eventos || Ticket Master')
@section('personalizar-navbar-items')
<li class="nav-item">
    <a class="nav-link" href="{{ url('comprador/home') }}">Inicio</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('comprador/comprar') }}">Comprar Entradas</a>
@endsection

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5 display-4 text-primary">Mis Entradas</h1>

    @if($compras->isEmpty())
        <div class="text-center py-5">
            <h3 class="text-secondary">Aún no has comprado entradas para ningún evento.</h3>
            <p class="text-muted">Explora nuestros eventos y consigue tu entrada para vivir una experiencia inolvidable.</p>
            <a href="{{ url('comprador/compras') }}" class="btn btn-primary btn-lg mt-3">
                <i class="fas fa-ticket-alt"></i> Comprar Entradas
            </a>
        </div>
    @else
        <div class="row g-4">
            @foreach($compras as $compra)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-3 h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $compra->evento->nombre }}</h5>
                        <p class="card-text text-muted">{{ $compra->evento->descripcion }}</p>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">
                                <strong>Localidad:</strong> {{ $compra->localidad->nombre }}
                            </li>
                            <li class="list-group-item">
                                <strong>Precio Unitario:</strong> ${{ $compra->localidad->precio }}
                            </li>
                            <li class="list-group-item">
                                <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($compra->evento->fecha)->format('d M, Y h:i A') }}
                            </li>
                            <li class="list-group-item">
                                <strong>Ubicación:</strong> {{ $compra->evento->ubicacion }}
                            </li>
                            <li class="list-group-item">
                                <strong>Cantidad:</strong> {{ $compra->cantidad }}
                            </li>
                            @if($compra->boleto)
                            <li class="list-group-item">
                                <strong>Código Boleto:</strong> {{ $compra->boleto->codigo_boleto }}
                            </li>
                            @endif
                        </ul>

                        @if($compra->boleto)
                            <div class="text-center mt-auto">
                                @php
                                    $qrContent = json_encode([
                                        'usuario' => auth()->user()->nombre,
                                        'evento' => $compra->evento->nombre,
                                        'localidad' => $compra->localidad->nombre,
                                        'cantidad' => $compra->cantidad,
                                        'codigo_boleto' => $compra->boleto->codigo_boleto,
                                    ]);
                                    $qrCode = new \Endroid\QrCode\QrCode($qrContent);
                                    $writer = new \Endroid\QrCode\Writer\PngWriter();
                                    $qrCodeImage = $writer->write($qrCode)->getDataUri();
                                @endphp
                                <img src="{{ $qrCodeImage }}" alt="Código QR" class="img-fluid rounded mb-3" style="max-width: 150px;">
                                <a href="{{ $qrCodeImage }}" download="qr_code.png" class="btn btn-success btn-sm">
                                    <i class="fas fa-download"></i> Descargar QR
                                </a>
                            </div>
                        @endif
                        @if(\Carbon\Carbon::parse($compra->evento->fecha)->eq($fechaMasCercana))
                            <span class="badge bg-success">Más Reciente</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $('#buscar-eventos').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('comprador.buscarEventos') }}",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                $('#buscar-eventos').val(ui.item.value);
                // Aquí puedes agregar lógica adicional para manejar la selección del evento
                return false;
            }
        });
    });
</script>
@endsection