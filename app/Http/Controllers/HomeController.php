<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Localidad;

class HomeController extends Controller
{
    public function index()
    {
        Log::info('HomeController index method called');

        $user = Auth::user();
        Log::info('User tipo_usuario', ['tipo_usuario' => $user->tipo_usuario]);

        // Obtener las localidades que han tenido una actualización reciente
        $localidadesRecientes = Localidad::with('evento')
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();

        return view('comprador.home', compact('localidadesRecientes'));
    }

    // términos
    public function terminos()
    {
        return view('terminos');
    }

    public function politicas()
    {
        return view('politicas');
    }
}