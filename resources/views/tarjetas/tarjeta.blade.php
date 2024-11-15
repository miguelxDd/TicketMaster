@foreach($compras as $compra)
<div class="col-md-4 mb-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="card-title">{{ $compra->evento->nombre }}</h5>
            <p class="card-subtitle">{{ \Carbon\Carbon::parse($compra->evento->fecha)->format('d M, Y h:i A') }}</p>
        </div>
        <div class="card-body">
            <p class="text-muted">{{ $compra->evento->descripcion }}</p>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>Localidad:</strong> {{ $compra->localidad->nombre }}</li>
                <li class="list-group-item"><strong>Precio:</strong> ${{ $compra->localidad->precio }}</li>
                <li class="list-group-item"><strong>Ubicación:</strong> {{ $compra->evento->ubicacion }}</li>
                <li class="list-group-item"><strong>Cantidad:</strong> {{ $compra->cantidad }}</li>
                @if($compra->boleto)
                <li class="list-group-item"><strong>Boleto:</strong> {{ $compra->boleto->codigo_boleto }}</li>
                @endif
            </ul>
            @if($compra->boleto)
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
                <div class="text-center">
                    <img src="{{ $qrCodeImage }}" alt="QR" class="img-fluid rounded mb-3" style="max-width: 120px;">
                    <a href="{{ $qrCodeImage }}" download="qr_code.png" class="btn btn-success btn-sm">
                        <i class="fas fa-download"></i> Descargar QR
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endforeach