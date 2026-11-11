<?php

namespace App\Http\Controllers;

use App\Models\Huesped;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HuespedController extends Controller
{
    /**
 * Mostrar listado de huéspedes.
 */
        public function index(Request $request)
{
    $buscar = $request->buscar;
    $ciudad = $request->ciudad;
    $documento = $request->documento;
    $correo = $request->correo;

    $huespedes = Huesped::query()

        ->when($buscar, function ($query) use ($buscar) {

            $query->where(function ($q) use ($buscar) {

                $q->where('nombres', 'like', "%{$buscar}%")
                  ->orWhere('apellidos', 'like', "%{$buscar}%");

            });

        })

        ->when($ciudad, function ($query) use ($ciudad) {

            $query->where('ciudad', $ciudad);

        })

        ->when($documento, function ($query) use ($documento) {

            $query->where('numero_documento', 'like', "%{$documento}%");

        })

        ->when($correo, function ($query) use ($correo) {

            $query->where('correo', 'like', "%{$correo}%");

        })

        ->orderBy('nombres')
        ->paginate(10)
        ->withQueryString();

    $ciudades = Huesped::select('ciudad')
        ->whereNotNull('ciudad')
        ->where('ciudad', '<>', '')
        ->distinct()
        ->orderBy('ciudad')
        ->pluck('ciudad');

    return view('huespedes.index', compact(
        'huespedes',
        'buscar',
        'ciudad',
        'documento',
        'correo',
        'ciudades'
    ));
}

/**
 * Exportar huéspedes a PDF.
 */
    public function pdf(Request $request)
    {
        $buscar = $request->buscar;
        $ciudad = $request->ciudad;
        $documento = $request->documento;
        $correo = $request->correo;

        $huespedes = Huesped::query()

            ->when($buscar, function ($query) use ($buscar) {

                $query->where(function ($q) use ($buscar) {

                    $q->where('nombres', 'like', "%{$buscar}%")
                    ->orWhere('apellidos', 'like', "%{$buscar}%");

                });

            })

            ->when($ciudad, function ($query) use ($ciudad) {

                $query->where('ciudad', $ciudad);

            })

            ->when($documento, function ($query) use ($documento) {

                $query->where('numero_documento', 'like', "%{$documento}%");

            })

            ->when($correo, function ($query) use ($correo) {

                $query->where('correo', 'like', "%{$correo}%");

            })

            ->orderBy('nombres')

            ->get();

        $filtros = [
            'buscar' => $buscar,
            'ciudad' => $ciudad,
            'documento' => $documento,
            'correo' => $correo,
        ];

        $pdf = Pdf::loadView('huespedes.pdf', compact(
            'huespedes',
            'filtros'
        ));

        return $pdf->stream('Listado_Huespedes.pdf');
    }

        /**
     * Mostrar formulario para crear un huésped.
     */
        public function create()
        {
            return view('huespedes.create');
        }

        /**
     * Guardar huésped.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([

        'tipo_documento' => 'required|max:20',

        'numero_documento' => 'required|max:20|unique:huespedes',

        'nombres' => 'required|max:100',

        'apellidos' => 'required|max:100',

        'telefono' => 'required|max:20',

        'correo' => 'nullable|email',

        'direccion' => 'nullable|max:255',

        'ciudad' => 'nullable|max:100',

        'fecha_registro' => 'required|date',

    ]);

    Huesped::create($datos);

    return redirect()
            ->route('huespedes.index')
            ->with('success', 'Huésped registrado correctamente.');
}

        /**
     * Mostrar un huésped.
     */
            public function show($id)
    {
        $huesped = Huesped::findOrFail($id);

        return view('huespedes.show', compact('huesped'));
    }

        /**
     * Mostrar formulario para editar.
     */
        public function edit($id)
    {
        $huesped = Huesped::findOrFail($id);

        return view('huespedes.edit', compact('huesped'));
    }

        /**
     * Actualizar huésped.
     */
        public function update(Request $request, $id)
    {
        $huesped = Huesped::findOrFail($id);

        $datos = $request->validate([

            'tipo_documento' => 'required|max:20',

            'numero_documento' => 'required|max:20|unique:huespedes,numero_documento,' . $huesped->id,

            'nombres' => 'required|max:100',

            'apellidos' => 'required|max:100',

            'telefono' => 'required|max:20',

            'correo' => 'nullable|email',

            'direccion' => 'nullable|max:255',

            'ciudad' => 'nullable|max:100',

            'fecha_registro' => 'required|date',

        ]);

        $huesped->update($datos);

        return redirect()
                ->route('huespedes.index')
                ->with('success', 'Huésped actualizado correctamente.');
    }
        /**
     * Eliminar huésped.
     */
        public function destroy($id)
    {
        try {

            $huesped = Huesped::findOrFail($id);

            $huesped->delete();

            return redirect()
                    ->route('huespedes.index')
                    ->with('success', 'Huésped eliminado correctamente.');

        } catch (\Exception $e) {

            return redirect()
                    ->route('huespedes.index')
                    ->with('error', 'No se puede eliminar este huésped porque tiene registros asociados.');

        }
    }

}
