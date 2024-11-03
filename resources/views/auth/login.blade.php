<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Master - Login y Registro</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container sign-up-container">
            <form action="{{ route('register') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                <h2>Crear Cuenta en Ticket Master</h2>
                <p>Únete y consigue tus boletos al instante.</p>
        
                <!-- Checkbox para seleccionar si es una empresa -->
                <div class="form-group full-width">
                    <input type="checkbox" id="is_company" name="is_company" onchange="toggleCompanyFields()" />
                    <label for="is_company">¿Es usted una empresa?</label>
                </div>
        
                <div class="form-row">
                    <!-- Nombre -->
                    <div class="form-group half-width">
                        <input type="text" name="nombre" placeholder="Nombre o Razón Social" value="{{ old('nombre') }}" required class="form-control">
                        <div class="invalid-feedback">Por favor ingresa tu nombre o razón social.</div>
                    </div>
        
                    <!-- Email -->
                    <div class="form-group half-width">
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="form-control">
                        <div class="invalid-feedback">Proporciona un email válido.</div>
                    </div>
                </div>
        
                <div class="form-row">
                    <!-- Contraseña -->
                    <div class="form-group half-width">
                        <input type="password" name="password" placeholder="Contraseña" required class="form-control">
                        <div class="invalid-feedback">Ingresa una contraseña.</div>
                    </div>
        
                    <!-- Confirmar Contraseña -->
                    <div class="form-group half-width">
                        <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" required class="form-control">
                        <div class="invalid-feedback">Confirma tu contraseña.</div>
                    </div>
                </div>
        
                <div class="form-row">
                    <!-- Fecha de nacimiento (solo para personas) -->
                    <div class="form-group half-width" id="birthdate-field">
                        <input type="date" name="fecha_nacimiento" placeholder="Fecha de nacimiento" value="{{ old('fecha_nacimiento') }}" class="form-control">
                        <div class="invalid-feedback">Por favor selecciona tu fecha de nacimiento.</div>
                    </div>
        
                    <!-- DUI (solo para personas) -->
                    <div class="form-group half-width" id="dui-field">
                        <input type="text" name="dui" placeholder="DUI" value="{{ old('dui') }}" class="form-control">
                        <div class="invalid-feedback">Ingresa tu número de DUI.</div>
                    </div>
                </div>
        
                <div class="form-row">
                    <!-- NIT (obligatorio para empresas) -->
                    <div class="form-group half-width" id="nit-field">
                        <input type="text" name="nit" placeholder="NIT (Opcional)" value="{{ old('nit') }}" class="form-control">
                        <div class="invalid-feedback">Ingresa un número de NIT válido.</div>
                    </div>
        
                    <!-- Teléfono -->
                    <div class="form-group half-width">
                        <input type="text" name="telefono" placeholder="Teléfono" value="{{ old('telefono') }}" required class="form-control">
                        <div class="invalid-feedback">Ingresa tu número de teléfono.</div>
                    </div>
                </div>
        
                <!-- Foto de perfil -->
                <div class="form-group full-width">
                    <label>Foto de perfil (Opcional)</label>
                    <div class="profile-pic-wrapper">
                        <img id="profile-pic-preview" src="https://via.placeholder.com/150" alt="Vista previa de foto de perfil" />
                        <input type="file" name="foto_perfil" id="foto_perfil" class="form-control-file" accept="image/*" onchange="previewProfilePic(event)">
                        <label for="foto_perfil" class="upload-button">Seleccionar Foto</label>
                    </div>
                </div>
                
                <div class="center">
                    <button type="submit" class="btn btn-primary">Registrarse</button>    
                </div>
                
            </form>
        </div>
        
        
        
        <div class="form-container sign-in-container">
            <form action="{{ route('login') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <h2>Iniciar Sesión en Ticket Master</h2>
                <p>Inicia sesión y sigue tus eventos favoritos.</p>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required class="form-control">
                    <div class="invalid-feedback">Proporciona un email válido.</div>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Contraseña" required class="form-control">
                    <div class="invalid-feedback">Ingresa una contraseña.</div>
                </div>
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>¡Bienvenido de nuevo!</h1>
                    <p>¿Ya tienes una cuenta? Inicia sesión para ver tus boletos.</p>
                    <button class="ghost" id="signIn">Iniciar Sesión</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>¡Únete a Ticket Master!</h1>
                    <p>¿Nuevo aquí? Crea una cuenta para acceder a eventos exclusivos.</p>
                    <button class="ghost" id="signUp">Registrarse</button>
                </div>
            </div>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    
</body>
</html>
