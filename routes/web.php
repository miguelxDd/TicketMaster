<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ControllerOrganizador;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectBasedOnUserType;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Ruta de home con middleware para redirigir basado en el tipo de usuario
Route::middleware(['auth', RedirectBasedOnUserType::class])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/comprador/home', [HomeController::class, 'index'])->name('comprador.home');
    Route::get('/organizador/home', [ControllerOrganizador::class, 'index'])->name('organizador.home');
    Route::get('/organizador/dashboard', [ControllerOrganizador::class, 'dashboard'])->name('organizador.dashboard');
    Route::get('/organizador/crearEvento', [ControllerOrganizador::class, 'crearEvento'])->name('organizador.crearEvento');
    Route::post('organizador/guardar', [EventoController::class, 'guardar'])->name('eventos.guardar');
    Route::get('organizador/misEventos', [EventoController::class, 'misEventos'])->name('organizador.misEventos');
    Route::get('eventos/{id}/editar', [EventoController::class, 'editar'])->name('eventos.editar');
    Route::delete('organizador/eventos/{id}', [EventoController::class, 'eliminar'])->name('eventos.eliminar');
    Route::get('/otro-lugar', function () {
        return view('otro-lugar');
    });
});