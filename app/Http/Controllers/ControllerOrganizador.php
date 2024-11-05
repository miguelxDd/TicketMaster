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
        $user = Auth::user();
        Log::info('User tipo_usuario', ['tipo_usuario' => $user->tipo_usuario]);
        return view('organizador.home');
    }

    public function dashboard()
    {
        return view('organizador.dashboard');
    }
    public function crearEvento()
    {
        return view('organizador.crearEvento');
    }

}