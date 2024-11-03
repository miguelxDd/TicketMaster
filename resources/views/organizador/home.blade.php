@extends('base')
@section('title', 'Inicio Organizador')
@section('content')
<h1>
    Bienvenido, {{ Auth::user()->nombre }} (Organizador)
</h1>
<p>Esta es la página de inicio para los organizadores.</p>
<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection