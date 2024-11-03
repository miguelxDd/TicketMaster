<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Log;
use Exception;

class CreateNewUser implements CreatesNewUsers
{
    /**
     * Validar y crear un nuevo usuario registrado.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Log::info('Starting user creation process', ['input' => $input]);

        // Establecer valor predeterminado para estado si no está presente
        if (!isset($input['estado'])) {
            $input['estado'] = 1;
      
        }  //Estableciendo el valor de is_company en 0 si no está presente
        if (!isset($input['is_company'])) {
            $input['is_company'] = 'comprador';
        }

        // Definir los mensajes de error personalizados
        $messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'dui.required' => 'El DUI es obligatorio.',
            'dui.unique' => 'El DUI ya está registrado.',
            'nit.unique' => 'El NIT ya está registrado.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'estado.required' => 'El estado es obligatorio.',
            'foto_perfil.image' => 'La foto de perfil debe ser una imagen.',
            'foto_perfil.mimes' => 'La foto de perfil debe ser un archivo de tipo: jpg, jpeg, png.',
            'foto_perfil.max' => 'La foto de perfil no debe ser mayor a 2048 kilobytes.',
        ];

        // Validar los datos de entrada
        $validator = Validator::make($input, [
            'nombre' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
            'fecha_nacimiento' => ['nullable', 'date'],
            'dui' => ['nullable', 'string', 'size:9', Rule::unique(User::class), 'regex:/^\d{9}$/'],
            'nit' => ['nullable', 'string', 'size:14', Rule::unique(User::class), 'regex:/^\d{14}$/'],
            'telefono' => ['required', 'string', 'size:11', 'regex:/^\d{11}$/'],
            'estado' => ['required', 'boolean'],
            'tipo_usuario' => ['nullable', 'string', 'in:comprador,organizador'],
            'foto_perfil' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], $messages);

        if ($validator->fails()) {
            Log::error('Validation failed', $validator->errors()->toArray());
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        try {
            // Manejar la subida de la foto de perfil
            if (isset($input['foto_perfil'])) {
                $file = $input['foto_perfil'];
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/perfiles', $filename);
                $input['foto_perfil'] = $filename;
                Log::info('Profile picture uploaded successfully', ['filename' => $filename]);
            } else {
                $input['foto_perfil'] = null;
            }

            // Agregar registro de depuración para verificar el valor de is_company
            Log::info('Valor de is_company', ['is_company' => $input['is_company']]);

            // Determinar el tipo de usuario
            $tipoUsuario = isset($input['is_company']) && $input['is_company'] == '1' ? 'organizador' : 'comprador';

            // Agregar registro de depuración para verificar el valor de tipo_usuario
            Log::info('Valor de tipo_usuario antes de crear el usuario', ['tipo_usuario' => $tipoUsuario]);

            // Crear y devolver el nuevo usuario
            $user = User::create([
                'nombre' => $input['nombre'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'fecha_nacimiento' => $input['fecha_nacimiento'],
                'dui' => $input['dui'],
                'nit' => $input['nit'],
                'telefono' => $input['telefono'],
                'estado' => $input['estado'],
                'foto_perfil' => $input['foto_perfil'],
                'tipo_usuario' => $tipoUsuario,
            ]);

            Log::info('User created successfully', ['user' => $user]);
            return $user;
        } catch (Exception $e) {
            Log::error('Error creating user', ['error' => $e->getMessage()]);
            throw new \Exception('Hubo un problema al crear el usuario. Por favor, inténtalo de nuevo.');
        }
    }
}