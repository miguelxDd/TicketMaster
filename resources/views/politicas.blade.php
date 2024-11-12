@extends('baseOrganizador')

@section('title', 'Política de Privacidad || Ticket Master')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-primary mb-4">Política de Privacidad</h1>

    <div class="card shadow-lg border-0 rounded">
        <div class="card-body p-4">
            <p class="text-muted">
                En Ticket Master, nos tomamos muy en serio la privacidad de nuestros usuarios. Esta Política de Privacidad explica cómo recopilamos, usamos, compartimos y protegemos tu información personal cuando usas nuestros servicios. Al utilizar este sitio web, aceptas los términos descritos a continuación.
            </p>

            <h5 class="text-primary mt-4">1. Información que Recopilamos</h5>
            <p>Recopilamos diferentes tipos de información para ofrecer y mejorar nuestros servicios, incluyendo:</p>
            <ul>
                <li><strong>Información de Registro:</strong> Como tu nombre, correo electrónico y datos de inicio de sesión cuando te registras en nuestra plataforma.</li>
                <li><strong>Información del Evento:</strong> Detalles de los eventos que creas o en los que participas, como nombres de eventos y ubicaciones.</li>
                <li><strong>Información de Uso:</strong> Datos sobre cómo interactúas con nuestro sitio, incluyendo las páginas que visitas y el tiempo que pasas en ellas.</li>
            </ul>

            <h5 class="text-primary mt-4">2. Uso de la Información</h5>
            <p>Utilizamos tu información personal para los siguientes fines:</p>
            <ul>
                <li>Proveer, mejorar y personalizar nuestros servicios.</li>
                <li>Comunicarnos contigo sobre actualizaciones, promociones y soporte técnico.</li>
                <li>Proteger nuestra plataforma y garantizar una experiencia segura para todos los usuarios.</li>
            </ul>

            <h5 class="text-primary mt-4">3. Compartir tu Información</h5>
            <p>No compartimos tu información personal con terceros, excepto en las siguientes circunstancias:</p>
            <ul>
                <li>Cuando sea necesario para completar tus transacciones o brindar soporte técnico.</li>
                <li>En caso de requerimientos legales, como órdenes judiciales o solicitudes gubernamentales.</li>
                <li>Con terceros proveedores de servicios que nos ayudan a mejorar y operar nuestra plataforma, bajo estrictos acuerdos de confidencialidad.</li>
            </ul>

            <h5 class="text-primary mt-4">4. Seguridad de la Información</h5>
            <p>Implementamos medidas de seguridad para proteger tu información personal contra accesos no autorizados, alteraciones, divulgación o destrucción. Sin embargo, no podemos garantizar la seguridad absoluta de la información transmitida a través de internet.</p>

            <h5 class="text-primary mt-4">5. Tus Derechos</h5>
            <p>Como usuario, tienes derecho a acceder, rectificar o eliminar tu información personal en cualquier momento. Si deseas ejercer estos derechos, puedes contactarnos mediante la sección de <a href="{{ url('organizador/contacto') }}" class="text-decoration-none">Contacto</a>.</p>

            <h5 class="text-primary mt-4">6. Cambios en la Política de Privacidad</h5>
            <p>Nos reservamos el derecho de modificar esta Política de Privacidad en cualquier momento. Cualquier cambio será publicado en esta página y, cuando sea significativo, te lo notificaremos a través de los medios adecuados.</p>

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
