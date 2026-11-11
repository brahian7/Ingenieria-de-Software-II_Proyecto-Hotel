<?php

namespace App\Http\Controllers\Api;

use App\Models\Habitacion;
use Illuminate\Http\Request;

class HabitacionController extends ApiController
{
    /**
     * Listar habitaciones
     */
    public function index()
    {
        $habitaciones = Habitacion::orderBy('numero')->get();

        return $this->successResponse(
            $habitaciones,
            'Listado de habitaciones obtenido correctamente.'
        );
    }

    /**
     * Registrar habitación
     */
    public function store(Request $request)
    {
        $datos = $request->validate([

            'numero' => 'required|unique:habitaciones,numero',

            'tipo' => 'required',

            'capacidad' => 'required|integer|min:1',

            'precio_noche' => 'required|numeric|min:0',

            'estado' => 'required',

            'descripcion' => 'nullable|string'

        ]);

        $habitacion = Habitacion::create($datos);

        return $this->successResponse(
            $habitacion,
            'Habitación registrada correctamente.',
            201
        );
    }

    /**
     * Mostrar habitación
     */
    public function show(string $id)
    {
        $habitacion = Habitacion::find($id);

        if (!$habitacion) {

            return $this->errorResponse(
                'Habitación no encontrada.',
                404
            );

        }

        return $this->successResponse(
            $habitacion,
            'Habitación encontrada.'
        );
    }

    /**
     * Actualizar habitación
     */
    public function update(Request $request, string $id)
    {
        $habitacion = Habitacion::find($id);

        if (!$habitacion) {

            return $this->errorResponse(
                'Habitación no encontrada.',
                404
            );

        }

        $datos = $request->validate([

            'numero' => 'required|unique:habitaciones,numero,' . $habitacion->id,

            'tipo' => 'required',

            'capacidad' => 'required|integer|min:1',

            'precio_noche' => 'required|numeric|min:0',

            'estado' => 'required',

            'descripcion' => 'nullable|string'

        ]);

        $habitacion->update($datos);

        return $this->successResponse(
            $habitacion,
            'Habitación actualizada correctamente.'
        );
    }

    /**
     * Eliminar habitación
     */
    public function destroy(string $id)
    {
        $habitacion = Habitacion::find($id);

        if (!$habitacion) {

            return $this->errorResponse(
                'Habitación no encontrada.',
                404
            );

        }

        $habitacion->delete();

        return $this->successResponse(
            null,
            'Habitación eliminada correctamente.'
        );
    }
}