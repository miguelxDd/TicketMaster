<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ControllerOrganizador;
use App\Http\Controllers\Auth\LoginController;
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
    Route::get('/home', function () {
        // Este código no se ejecutará ya que el middleware redirigirá antes de llegar aquí
    })->name('home');
    Route::get('/comprador/home', [HomeController::class, 'index'])->name('comprador.home');
    Route::get('/organizador/home', [ControllerOrganizador::class, 'index'])->name('organizador.home');
    Route::get('/otro-lugar', function () {
        return view('otro-lugar');
    });
});