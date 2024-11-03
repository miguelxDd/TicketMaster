<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ControllerOrganizador extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Log::info('ControllerOrganizador index method called');

        $user = Auth::user();
        Log::info('User tipo_usuario', ['tipo_usuario' => $user->tipo_usuario]);

        if ($user->tipo_usuario === 'organizador' || $user->tipo_usuario === 'admin') {
            Log::info('Redirigiendo a comprador.home');
            return view('organizador.home');
        }

        // Redirigir a otra página si el usuario no es organizador ni admin
        Log::info('Redirigiendo a /otro-lugar');
        return redirect('/otro-lugar');
    }
}