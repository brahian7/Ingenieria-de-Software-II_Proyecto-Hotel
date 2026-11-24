<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Habitacion;
use App\Models\Reserva;
use App\Models\Huesped;

class ReservaClienteController extends Controller
{
    /**
     * Mostrar reservas del cliente.
     */
    public function index()
    {
        $reservas = Reserva::with('habitacion')
            ->where('usuario_id', Auth::id())
            ->latest()
            ->get();

        return view('cliente.reservas.index', compact('reservas'));
    }

    /**
     * Mostrar formulario de búsqueda.
     */
    public function create()
    {
        return view('cliente.reservas.create');
    }

    /**
     * Buscar habitaciones disponibles.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([

            'fecha_ingreso' => 'required|date|after_or_equal:today',

            'fecha_salida' => 'required|date|after:fecha_ingreso',

            'cantidad_personas' => 'required|integer|min:1',

        ]);

        $habitaciones = Habitacion::where('estado', 'Disponible')

            ->whereNotIn('id', function ($query) use ($datos) {

                $query->select('habitacion_id')
                    ->from('reservas')
                    ->whereNotIn('estado', ['Cancelada', 'Finalizada'])

                    ->where(function ($q) use ($datos) {

                        $q->whereBetween('fecha_ingreso', [
                            $datos['fecha_ingreso'],
                            $datos['fecha_salida']
                        ])

                        ->orWhereBetween('fecha_salida', [
                            $datos['fecha_ingreso'],
                            $datos['fecha_salida']
                        ])

                        ->orWhere(function ($qq) use ($datos) {

                            $qq->where('fecha_ingreso', '<=', $datos['fecha_ingreso'])
                               ->where('fecha_salida', '>=', $datos['fecha_salida']);

                        });

                    });

            })

            ->get();

        return view('cliente.reservas.create', compact(
            'habitaciones',
            'datos'
        ));
    }

    /**
     * Confirmar la habitación seleccionada.
     */
    public function confirmar(Request $request)
    {
        $datos = $request->validate([

            'habitacion_id' => 'required|exists:habitaciones,id',

            'fecha_ingreso' => 'required|date',

            'fecha_salida' => 'required|date',

            'cantidad_personas' => 'required|integer|min:1',

        ]);

        return view('cliente.reservas.confirmar', compact('datos'));
    }

    /**
     * Guardar la reserva.
     */
    public function guardar(Request $request)
    {
        $datos = $request->validate([

            'habitacion_id' => 'required|exists:habitaciones,id',

            'fecha_ingreso' => 'required|date',

            'fecha_salida' => 'required|date|after:fecha_ingreso',

            'cantidad_personas' => 'required|integer|min:1',

            'tipo_documento' => 'required',

            'numero_documento' => 'required',

            'telefono' => 'required',

            'direccion' => 'required',

            'ciudad' => 'required',

        ]);

        $huesped = Huesped::firstOrCreate(

            [
                'numero_documento' => $datos['numero_documento']
            ],

            [

                'tipo_documento' => $datos['tipo_documento'],

                'nombres' => Auth::user()->nombre,

                'apellidos' => Auth::user()->apellido,

                'telefono' => $datos['telefono'],

                'correo' => Auth::user()->email,

                'direccion' => $datos['direccion'],

                'ciudad' => $datos['ciudad'],

                'fecha_registro' => now()

            ]

        );

        $habitacion = Habitacion::findOrFail($datos['habitacion_id']);

        $cantidadNoches = Carbon::parse($datos['fecha_ingreso'])
            ->diffInDays(Carbon::parse($datos['fecha_salida']));

        $ultimoId = (Reserva::max('id') ?? 0) + 1;

        $codigo = 'RES-' . str_pad($ultimoId, 6, '0', STR_PAD_LEFT);

        Reserva::create([

            'codigo_reserva' => $codigo,

            'usuario_id' => Auth::id(),

            'huesped_id' => $huesped->id,

            'habitacion_id' => $habitacion->id,

            'fecha_reserva' => now(),

            'fecha_ingreso' => $datos['fecha_ingreso'],

            'fecha_salida' => $datos['fecha_salida'],

            'cantidad_personas' => $datos['cantidad_personas'],

            'cantidad_noches' => $cantidadNoches,

            'precio_noche' => $habitacion->precio_noche,

            'total' => $cantidadNoches * $habitacion->precio_noche,

            'estado' => 'Pendiente',

            'observaciones' => 'Reserva realizada desde el Portal del Cliente'

        ]);

        $habitacion->update([

            'estado' => 'Reservada'

        ]);

        return redirect()
            ->route('cliente.reservas')
            ->with('success', '¡Reserva realizada correctamente!');
    }

    /**
     * Cancelar reserva.
     */
    public function cancelar(Reserva $reserva)
    {
        if ($reserva->usuario_id != Auth::id()) {

            abort(403);

        }

        if ($reserva->estado != 'Pendiente') {

            return back()->with(
                'error',
                'Esta reserva ya no puede cancelarse.'
            );

        }

        $reserva->update([

            'estado' => 'Cancelada'

        ]);

        $reserva->habitacion->update([

            'estado' => 'Disponible'

        ]);

        return back()->with(

            'success',

            'La reserva fue cancelada correctamente.'

        );
    }
}