<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ControllerOrganizador;

class RedirectBasedOnUserType
{
    /**
     * Handle an incoming request.
     *s
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->tipo_usuario === 'comprador' && !$request->is('comprador/home')) {
            return redirect()->action([HomeController::class, 'index']);
        } elseif ($user->tipo_usuario === 'organizador' && !$request->is('organizador/home')) {
            return redirect()->action([ControllerOrganizador::class, 'index']);
        }

        return $next($request);
    }
}