<?php

namespace App\Http\Controllers\Api;

use App\Models\Huesped;
use Illuminate\Http\Request;

class HuespedController extends ApiController
{
    /**
     * Listar huéspedes
     */
    public function index()
    {
        $huespedes = Huesped::orderBy('nombres')->get();

        return $this->successResponse(
            $huespedes,
            'Listado de huéspedes obtenido correctamente.'
        );
    }

    /**
     * Registrar huésped
     */
    public function store(Request $request)
    {
        $datos = $request->validate([

            'tipo_documento' => 'required',

            'numero_documento' => 'required|unique:huespedes,numero_documento',

            'nombres' => 'required|string|max:100',

            'apellidos' => 'required|string|max:100',

            'telefono' => 'nullable|string|max:20',

            'correo' => 'nullable|email',

            'direccion' => 'nullable|string',

            'ciudad' => 'nullable|string|max:100',

            'fecha_registro' => 'required|date',

        ]);

        $huesped = Huesped::create($datos);

        return $this->successResponse(
            $huesped,
            'Huésped registrado correctamente.',
            201
        );
    }

    /**
     * Mostrar huésped
     */
    public function show(string $id)
    {
        $huesped = Huesped::find($id);

        if (!$huesped) {

            return $this->errorResponse(
                'Huésped no encontrado.',
                404
            );

        }

        return $this->successResponse(
            $huesped,
            'Huésped encontrado.'
        );
    }

    /**
     * Actualizar huésped
     */
    public function update(Request $request, string $id)
    {
        $huesped = Huesped::find($id);

        if (!$huesped) {

            return $this->errorResponse(
                'Huésped no encontrado.',
                404
            );

        }

        $datos = $request->validate([

            'tipo_documento' => 'required',

            'numero_documento' => 'required|unique:huespedes,numero_documento,' . $huesped->id,

            'nombres' => 'required|string|max:100',

            'apellidos' => 'required|string|max:100',

            'telefono' => 'nullable|string|max:20',

            'correo' => 'nullable|email',

            'direccion' => 'nullable|string',

            'ciudad' => 'nullable|string|max:100',

            'fecha_registro' => 'required|date',

        ]);

        $huesped->update($datos);

        return $this->successResponse(
            $huesped,
            'Huésped actualizado correctamente.'
        );
    }

    /**
     * Eliminar huésped
     */
    public function destroy(string $id)
    {
        $huesped = Huesped::find($id);

        if (!$huesped) {

            return $this->errorResponse(
                'Huésped no encontrado.',
                404
            );

        }

        $huesped->delete();

        return $this->successResponse(
            null,
            'Huésped eliminado correctamente.'
        );
    }
}