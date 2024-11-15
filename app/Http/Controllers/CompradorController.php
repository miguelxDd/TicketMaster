<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Localidad;
use App\Models\Compra;
use App\Models\Boleto;
use Illuminate\Support\Facades\Log;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Carbon\Carbon;

class CompradorController extends Controller
{
    public function comprar(Request $request)
    {
        $search = $request->input('search');
        $eventos = Evento::where('nombre', 'like', "%{$search}%")
            ->orWhere('descripcion', 'like', "%{$search}%")
            ->orWhere('ubicacion', 'like', "%{$search}%")
            ->with('localidades')
            ->get();

        return view('comprador.comprar', compact('eventos'));
    }

    public function procesarCompra(Request $request, $id)
    {
        $localidadId = $request->input('localidad');
        $cantidad = $request->input('cantidad');

        $localidad = Localidad::findOrFail($localidadId);

        if ($cantidad > $localidad->asientos_disponibles) {
            return redirect()->route('comprador.comprar')->with('error', 'No hay suficientes asientos disponibles.');
        }

        // Lógica para procesar la compra de entradas
        Log::info('Procesando compra', ['evento_id' => $id, 'localidad_id' => $localidadId, 'cantidad' => $cantidad]);

        // Reducir la cantidad de asientos disponibles
        $localidad->asientos_disponibles -= $cantidad;
        $localidad->save();

        // Crear una nueva compra
        $compra = Compra::create([
            'user_id' => auth()->id(),
            'evento_id' => $id,
            'localidad_id' => $localidadId,
            'cantidad' => $cantidad,
        ]);

        // Crear un boleto único para la compra
        $codigoBoleto = strtoupper(uniqid('BOLETO-'));
        $boleto = Boleto::create([
            'reserva_id' => $compra->id,
            'user_id' => auth()->id(), // Asignar el user_id al boleto
            'codigo_boleto' => $codigoBoleto,
        ]);

        // Generar el contenido del código QR en formato JSON
        $qrContent = json_encode([
            'usuario' => auth()->user()->nombre,
            'evento' => $compra->evento->nombre,
            'localidad' => $localidad->nombre,
            'cantidad' => $cantidad,
            'codigo_boleto' => $codigoBoleto,
        ]);

        // Generar el código QR
        $qrCode = new QrCode($qrContent);
        $writer = new PngWriter();
        $qrCodeImage = $writer->write($qrCode)->getDataUri();

        return redirect()->route('comprador.comprar')->with([
            'success' => 'Compra realizada con éxito.',
            'boleto' => $boleto,
            'qrCodeImage' => $qrCodeImage,
        ]);
    }

    public function misEventos()
    {
        $compras = Compra::where('user_id', auth()->id())
            ->with(['evento', 'localidad', 'boleto'])
            ->orderBy('created_at', 'desc') // Ordenar por la columna created_at en orden descendente
            ->get();

        // Encontrar la fecha más cercana entre los eventos futuros
        $fechaMasCercana = $compras->filter(function($compra) {
            return Carbon::parse($compra->evento->fecha)->isFuture();
        })->min('evento.fecha');

        return view('comprador.misEventos', compact('compras', 'fechaMasCercana'));
    }

    public function buscarEventos(Request $request)
    {
        $search = $request->input('term');
        $eventos = Evento::where('nombre', 'like', "%{$search}%")
            ->orWhere('descripcion', 'like', "%{$search}%")
            ->orWhere('ubicacion', 'like', "%{$search}%")
            ->pluck('nombre');

        return response()->json($eventos);
    }
}