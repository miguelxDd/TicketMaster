<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Localidad;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventoController extends Controller
{
    public function guardar(Request $request)
    {
        // Agregar registro de depuración
        Log::info('Datos recibidos en el controlador:', $request->all());

        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'nombreEvento' => 'required|string|min:5|max:200',
            'descripcionEvento' => 'required|string',
            'fechaEvento' => 'required|date|after:now|before:'.now()->addYears(2),
            'ubicacionEvento' => 'required|string',
            'estadoEvento' => 'required|in:activo,cancelado,finalizado',
            'localidades.*.nombre' => 'required|string',
            'localidades.*.precio' => 'required|numeric',
            'localidades.*.capacidad' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            Log::error('Validación fallida:', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Guardar los datos del evento en la base de datos
        try {
            Log::info('Intentando guardar el evento...');
            $evento = new Evento();
            $evento->organizador_id = Auth::id(); // Asignar el ID del organizador autenticado
            $evento->nombre = $request->input('nombreEvento');
            $evento->descripcion = $request->input('descripcionEvento');
            $evento->fecha = $request->input('fechaEvento');
            $evento->ubicacion = $request->input('ubicacionEvento');
            $evento->estado = $request->input('estadoEvento');
            $evento->save();

            Log::info('Evento guardado:', $evento->toArray());
        } catch (\Exception $e) {
            Log::error('Error al guardar el evento:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error al guardar el evento.')->withInput();
        }

        // Guardar los datos de las localidades en la base de datos
        try {
            Log::info('Intentando guardar las localidades...');
            foreach ($request->input('localidades') as $localidadData) {
                $localidad = new Localidad();
                $localidad->evento_id = $evento->id;
                $localidad->nombre = $localidadData['nombre'];
                $localidad->precio = $localidadData['precio'];
                $localidad->capacidad = $localidadData['capacidad'];
                $localidad->asientos_disponibles = $localidadData['capacidad'];
                $localidad->save();

                Log::info('Localidad guardada:', $localidad->toArray());
            }
        } catch (\Exception $e) {
            Log::error('Error al guardar las localidades:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error al guardar las localidades.')->withInput();
        }

        return redirect()->route('organizador.home')->with('success', 'Evento creado exitosamente.');
    }
    public function misEventos()
    {
        $eventos = Evento::where('organizador_id', Auth::id())->get();
        return view('organizador.misEventos', ['eventos' => $eventos]);
    }
    //editar y eliminar
    public function editar($id)
    {
        // Obtener el evento por su ID
        $evento = Evento::findOrFail($id);
        // Retornar la vista con los datos del evento
        return view('organizador.editar', compact('evento'));
    }

    public function eliminar($id)
    {
        // Eliminar el evento por su ID
        $evento = Evento::findOrFail($id);
        $evento->delete();
        return redirect()->route('organizador.home')->with('success', 'Evento eliminado exitosamente.');
    }
    public function actualizar(Request $request, $id)
    {
        Log::info('Iniciando actualización del evento', ['evento_id' => $id]);

        $evento = Evento::findOrFail($id);
        Log::info('Evento encontrado', ['evento' => $evento]);

        try {
            $validatedData = $request->validate([
                'nombreEvento' => 'required|string|min:5|max:200',
                'descripcionEvento' => 'required|string',
                'fechaEvento' => 'required|date|after:now|before:'.now()->addYears(2),
                'ubicacionEvento' => 'required|string',
                'estadoEvento' => 'required|in:activo,cancelado,finalizado',
                'localidades.*.nombre' => 'required|string',
                'localidades.*.precio' => 'required|numeric',
                'localidades.*.capacidad' => 'required|integer|min:1',
            ]);

            Log::info('Validación completada', ['validated_data' => $validatedData]);

            $evento->nombre = $request->input('nombreEvento');
            $evento->descripcion = $request->input('descripcionEvento');
            $evento->fecha = $request->input('fechaEvento');
            $evento->ubicacion = $request->input('ubicacionEvento');
            $evento->estado = $request->input('estadoEvento');
            $evento->save();

            Log::info('Evento actualizado', ['evento' => $evento]);

            foreach ($request->input('localidades') as $localidadId => $localidadData) {
                if (strpos($localidadId, 'new_') === false) {
                    $localidad = Localidad::findOrFail($localidadId);
                    Log::info('Actualizando localidad existente', ['localidad_id' => $localidadId]);
                } else {
                    $localidad = new Localidad();
                    $localidad->evento_id = $evento->id;
                    Log::info('Creando nueva localidad', ['localidad_data' => $localidadData]);
                }
                $localidad->nombre = $localidadData['nombre'];
                $localidad->precio = $localidadData['precio'];
                $localidad->capacidad = $localidadData['capacidad'];
                $localidad->asientos_disponibles = $localidadData['capacidad']; // Asegurarse de establecer asientos_disponibles
                $localidad->save();

                Log::info('Localidad guardada', ['localidad' => $localidad]);
            }

            Log::info('Actualización del evento completada', ['evento_id' => $id]);

            return redirect()->route('organizador.misEventos')->with('success', 'Evento actualizado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error durante la actualización del evento:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error durante la actualización del evento.')->withInput();
        }
    }
}