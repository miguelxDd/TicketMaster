<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ControllerOrganizador;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// para compradores
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/otro-lugar', function () {
        return view('otro-lugar');
    });
});
// para organizadores
Route::middleware('auth')->group(function () {
    Route::get('/home', [ControllerOrganizador::class, 'index'])->name('home');
    Route::get('/otro-lugar', function () {
        return view('otro-lugar');
    });
});

