<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Permitir el acceso a la página de términos para todos los tipos de usuarios
        if ($request->is('terminos')) {
            return $next($request);
        }elseif ($request->is('politicas')) {
            return $next($request);
        }
        

        if ($user->tipo_usuario === 'comprador' && !$request->is('comprador/*')) {
            return redirect()->route('comprador.home');
        } elseif ($user->tipo_usuario === 'organizador' && !$request->is('organizador/*')) {
            return redirect()->route('organizador.home');
        } elseif ($user->tipo_usuario !== 'organizador' && $request->is('organizador/*')) {
            return redirect('/otro-lugar');
        }

        return $next($request);
    }
}