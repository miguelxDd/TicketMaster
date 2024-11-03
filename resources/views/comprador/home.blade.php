<!-- resources/views/comprador/home.blade.php -->
@extends('base')
@section('title', 'Inicio Comprador')
@section('content')
<h1>
    Bienvenido, {{ Auth::user()->nombre }} (Comprador)
</h1>
<p>Esta es la página de inicio para los compradores.</p>
<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection

