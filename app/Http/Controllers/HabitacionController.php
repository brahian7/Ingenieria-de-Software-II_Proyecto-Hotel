<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    /**
     * Mostrar listado de habitaciones.
     */
    public function index()
    {
        $habitaciones = Habitacion::orderBy('numero')->paginate(10);

        return view('habitaciones.index', compact('habitaciones'));
    }

    /**
     * Mostrar formulario para crear.
     */
    public function create()
    {
        return view('habitaciones.create');
    }

    /**
     * Guardar habitación.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([

            'numero' => 'required|max:10|unique:habitaciones',

            'tipo' => 'required',

            'capacidad' => 'required|integer|min:1',

            'precio_noche' => 'required|numeric|min:0',

            'estado' => 'required',

            'descripcion' => 'nullable',

            'imagen' => 'nullable|string'

        ]);

        Habitacion::create($datos);

        return redirect()
                ->route('habitaciones.index')
                ->with('success', 'Habitación creada correctamente.');
    }

    /**
     * Mostrar una habitación.
     */
            public function show($id)
    {
        $habitacion = Habitacion::findOrFail($id);

        return view('habitaciones.show', compact('habitacion'));
    }

    /**
     * Mostrar formulario para editar.
     */
        public function edit($id)
{
    $habitacion = Habitacion::findOrFail($id);

    return view('habitaciones.edit', compact('habitacion'));
}

    /**
     * Actualizar habitación.
     */
        public function update(Request $request, $id)
    {
        $habitacion = Habitacion::findOrFail($id);

        $datos = $request->validate([

            'numero' => 'required|max:10|unique:habitaciones,numero,' . $habitacion->id,

            'tipo' => 'required',

            'capacidad' => 'required|integer|min:1',

            'precio_noche' => 'required|numeric|min:0',

            'estado' => 'required',

            'descripcion' => 'nullable',

            'imagen' => 'nullable|string'

        ]);

        $habitacion->update($datos);

        return redirect()
                ->route('habitaciones.index')
                ->with('success', 'Habitación actualizada correctamente.');
    }

    /**
 * Eliminar habitación.
 */
    public function destroy($id)
    {
        try {

            $habitacion = Habitacion::findOrFail($id);

            $habitacion->delete();

            return redirect()
                ->route('habitaciones.index')
                ->with('success', 'Habitación eliminada correctamente.');

        } catch (\Exception $e) {

            return redirect()
                ->route('habitaciones.index')
                ->with('error', 'No se pudo eliminar la habitación.');

        }
    }
}