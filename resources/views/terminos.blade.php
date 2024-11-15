@extends('baseOrganizador')

@section('title', 'Términos y Condiciones || Ticket Master')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-primary mb-4">Términos y Condiciones</h1>

    <div class="card shadow-lg border-0 rounded">
        <div class="card-body p-4">
            <p class="text-muted">
                Bienvenido a Ticket Master. Al acceder y utilizar este sitio web, aceptas cumplir con los siguientes Términos y Condiciones. Por favor, lee cuidadosamente cada sección para comprender tus derechos y responsabilidades al utilizar nuestros servicios.
            </p>
            
            <h5 class="text-primary mt-4">1. Uso de la Plataforma</h5>
            <p>Ticket Master permite a los organizadores de eventos gestionar y promocionar sus eventos. Al registrarte y utilizar nuestros servicios, aceptas proporcionar información precisa y actualizada. Cualquier uso indebido de la plataforma, incluido el uso para fines ilegales o no autorizados, está estrictamente prohibido.</p>

            <h5 class="text-primary mt-4">2. Responsabilidad del Usuario</h5>
            <p>Como usuario, eres responsable de la seguridad de tu cuenta y de todas las actividades realizadas desde ella. Nos reservamos el derecho de suspender o cancelar tu cuenta si detectamos actividades sospechosas o fraudulentas.</p>

            <h5 class="text-primary mt-4">3. Política de Cancelación y Reembolsos</h5>
            <p>Los organizadores son responsables de establecer sus propias políticas de cancelación y reembolso para cada evento. Ticket Master no se hace responsable de reembolsos o cancelaciones de entradas. Te recomendamos revisar las políticas del evento antes de comprar entradas.</p>

            <h5 class="text-primary mt-4">4. Propiedad Intelectual</h5>
            <p>Todos los derechos de propiedad intelectual relacionados con los contenidos, diseños, logotipos y marcas utilizadas en este sitio son propiedad de Ticket Master o de los terceros que hayan autorizado su uso. Queda prohibido cualquier uso no autorizado de dichos materiales.</p>

            <h5 class="text-primary mt-4">5. Modificaciones a los Términos</h5>
            <p>Nos reservamos el derecho de modificar estos Términos y Condiciones en cualquier momento. Cualquier cambio será comunicado a los usuarios y entrará en vigencia a partir de su publicación en el sitio web. Te recomendamos revisar esta sección periódicamente.</p>

            <h5 class="text-primary mt-4">6. Protección de Datos</h5>
            <p>La seguridad y confidencialidad de tus datos es importante para nosotros. Consulta nuestra <a href="{{ url('/politicas') }}" class="text-decoration-none">Política de Privacidad</a> para conocer cómo recolectamos, usamos y protegemos tu información personal.</p>

            <h5 class="text-primary mt-4">7. Contacto</h5>
            <p>Si tienes alguna pregunta sobre estos Términos y Condiciones, puedes comunicarte con nuestro equipo de soporte a través de la sección <a href="{{ url('organizador/contacto') }}" class="text-decoration-none">Contacto</a> en el sitio web.</p>
            
            <p class="text-muted mt-4">Última actualización: [12/11/2024]</p>
        </div>
    </div>
</div>
@endsection

@section('footer')
<footer class="bg-dark text-white text-center py-3 mt-auto">
    <p class="mb-0">Ticket Master 2024 &copy; Todos los derechos reservados</p>
</footer>
@endsection
