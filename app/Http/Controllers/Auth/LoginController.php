<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
         $credentials = $request->only('email', 'password');
 
         if (Auth::attempt($credentials)) {
             // Si las credenciales son correctas, redirigir al dashboard
             return redirect()->intended('dashboard');
         }
 
         // Si las credenciales son incorrectas, redirigir de nuevo al login
         return redirect()->back()->withErrors(['error' => 'Email o contraseña incorrectos']);
     }
 
     // Metodo Logout
     public function logout()
     {
         Auth::logout();
         return redirect('/login');
     }
}
