<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Manejar el proceso de login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
        Log::info('Attempting login', ['credentials' => $credentials]);
    
        if (Auth::attempt($credentials)) {
            // Si las credenciales son correctas, redirigir al home
            Log::info('Login successful, redirecting to /home');
            return redirect()->intended('/home');
        }
    
        // Si las credenciales son incorrectas, redirigir de nuevo al login
        Log::info('Login failed, redirecting back to login');
        return redirect()->back()->withErrors(['error' => 'Email o contraseña incorrectos']);
    }
    

    // Metodo Logout
    public function logout()
    {
        Auth::logout();
        Log::info('User logged out, redirecting to /login');
        return redirect('/login');
    }
}