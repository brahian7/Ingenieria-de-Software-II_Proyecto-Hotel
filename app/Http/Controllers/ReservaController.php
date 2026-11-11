<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Habitacion;
use App\Models\Huesped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservaConfirmadaMail;

class ReservaController extends Controller
    {

            public function exportarPDF(Request $request)
        {
            $buscar = $request->buscar;
            $estado = $request->estado;
            $desde = $request->desde;
            $hasta = $request->hasta;

            $reservas = Reserva::with([
                'huesped',
                'habitacion',
                'usuario'
            ])

            ->when($buscar, function ($query) use ($buscar) {

                $query->where(function ($q) use ($buscar) {

                    $q->whereHas('huesped', function ($sub) use ($buscar) {

                        $sub->where('nombres', 'like', "%{$buscar}%")
                            ->orWhere('apellidos', 'like', "%{$buscar}%")
                            ->orWhere('numero_documento', 'like', "%{$buscar}%");

                    })

                    ->orWhereHas('habitacion', function ($sub) use ($buscar) {

                        $sub->where('numero', 'like', "%{$buscar}%");

                    });

                });

            })

            ->when($estado, function ($query) use ($estado) {

                $query->where('estado', $estado);

            })

            ->when($desde, function ($query) use ($desde) {

                $query->whereDate('fecha_ingreso', '>=', $desde);

            })

            ->when($hasta, function ($query) use ($hasta) {

                $query->whereDate('fecha_salida', '<=', $hasta);

            })

            ->orderByDesc('fecha_reserva')

            ->get();

            $totalIngresos = $reservas->sum('total');

            $pdf = Pdf::loadView(
                'reservas.pdf',
                compact(
                    'reservas',
                    'totalIngresos'
                )
            );

            $pdf->setPaper('a4', 'landscape');

            return $pdf->download(
                'Listado_Reservas_' . now()->format('Ymd_His') . '.pdf'
            );
        }

    /**
     * Mostrar listado de reservas.
     */
            public function index(Request $request)
        {
            $buscar = $request->buscar;
            $estado = $request->estado;
            $habitacion = $request->habitacion;
            $fechaIngreso = $request->fecha_ingreso;
            $fechaSalida = $request->fecha_salida;

            $reservas = Reserva::with(['huesped','habitacion'])

                ->when($buscar, function ($query) use ($buscar) {

                    $query->where(function($q) use ($buscar){

                        $q->whereHas('huesped', function ($sub) use ($buscar){

                            $sub->where('nombre','like',"%{$buscar}%")
                                ->orWhere('apellido','like',"%{$buscar}%")
                                ->orWhere('numero_documento','like',"%{$buscar}%");

                        })

                        ->orWhereHas('habitacion', function ($sub) use ($buscar){

                            $sub->where('numero','like',"%{$buscar}%");

                        })

                        ->orWhere('codigo_reserva','like',"%{$buscar}%");

                    });

                })

                ->when($estado, function($query) use ($estado){

                    $query->where('estado',$estado);

                })

                ->when($habitacion, function($query) use ($habitacion){

                    $query->where('habitacion_id',$habitacion);

                })

                ->when($fechaIngreso, function($query) use ($fechaIngreso){

                    $query->whereDate('fecha_ingreso',$fechaIngreso);

                })

                ->when($fechaSalida, function($query) use ($fechaSalida){

                    $query->whereDate('fecha_salida',$fechaSalida);

                })

                ->latest()

                ->paginate(10)

                ->withQueryString();

            $habitaciones = Habitacion::orderBy('numero')->get();

            return view('reservas.index', compact(

                'reservas',
                'buscar',
                'estado',
                'habitacion',
                'fechaIngreso',
                'fechaSalida',
                'habitaciones'

            ));
        }

    /**
     * Mostrar formulario para crear.
     */
        public function create()
    {
        $huespedes = Huesped::orderBy('nombres')->get();

        $habitaciones = Habitacion::where('estado', 'Disponible')
                                    ->orderBy('numero')
                                    ->get();

        return view('reservas.create', compact(
            'huespedes',
            'habitaciones'
        ));
    }

    /**
     * Guardar reserva.
     */
    public function store(Request $request)
{
    $datos = $request->validate([

        'huesped_id' => 'required|exists:huespedes,id',

        'habitacion_id' => 'required|exists:habitaciones,id',

        'fecha_reserva' => 'required|date',

        'fecha_ingreso' => 'required|date|after_or_equal:today',

        'fecha_salida' => 'required|date|after:fecha_ingreso',

        'cantidad_personas' => 'required|integer|min:1',

        'estado' => 'required',

        'observaciones' => 'nullable|string'

    ]);

    /*
    |--------------------------------------------------------------------------
    | Verificar disponibilidad
    |--------------------------------------------------------------------------
    */

    $ocupada = Reserva::where('habitacion_id', $datos['habitacion_id'])

        ->whereNotIn('estado', ['Cancelada', 'Finalizada'])

        ->where(function ($query) use ($datos) {

            $query->whereBetween('fecha_ingreso', [
                $datos['fecha_ingreso'],
                $datos['fecha_salida']
            ])

            ->orWhereBetween('fecha_salida', [
                $datos['fecha_ingreso'],
                $datos['fecha_salida']
            ])

            ->orWhere(function ($q) use ($datos) {

                $q->where('fecha_ingreso', '<=', $datos['fecha_ingreso'])

                  ->where('fecha_salida', '>=', $datos['fecha_salida']);

            });

        })

        ->exists();

    if ($ocupada) {

        return back()
            ->withInput()
            ->with('error', 'La habitación ya está reservada para esas fechas.');

    }

    /*
    |--------------------------------------------------------------------------
    | Usuario autenticado
    |--------------------------------------------------------------------------
    */

    $datos['usuario_id'] = Auth::id();

    /*
    |--------------------------------------------------------------------------
    | Habitación
    |--------------------------------------------------------------------------
    */

    $habitacion = Habitacion::findOrFail($datos['habitacion_id']);

    /*
    |--------------------------------------------------------------------------
    | Código de reserva
    |--------------------------------------------------------------------------
    */

    $ultimoId = (Reserva::max('id') ?? 0) + 1;

    $datos['codigo_reserva'] = 'RES-' . str_pad($ultimoId, 6, '0', STR_PAD_LEFT);

    /*
    |--------------------------------------------------------------------------
    | Cantidad de noches
    |--------------------------------------------------------------------------
    */

    $datos['cantidad_noches'] = Carbon::parse($datos['fecha_ingreso'])

        ->diffInDays(Carbon::parse($datos['fecha_salida']));

    /*
    |--------------------------------------------------------------------------
    | Precio por noche
    |--------------------------------------------------------------------------
    */

    $datos['precio_noche'] = $habitacion->precio_noche;

    /*
    |--------------------------------------------------------------------------
    | Total
    |--------------------------------------------------------------------------
    */

    $datos['total'] =

        $datos['cantidad_noches'] *

        $habitacion->precio_noche;

    /*
    |--------------------------------------------------------------------------
    | Crear reserva
    |--------------------------------------------------------------------------
    */

    $reserva = Reserva::create($datos);

    /*
    |--------------------------------------------------------------------------
    | Actualizar estado de la habitación
    |--------------------------------------------------------------------------
    */

    $habitacion->update([

        'estado' => 'Reservada'

    ]);

    /*
    |--------------------------------------------------------------------------
    | Enviar correo al huésped
    |--------------------------------------------------------------------------
    */

    try {

        $reserva->load([
            'huesped',
            'habitacion',
            'usuario'
        ]);

        if (!empty($reserva->huesped->correo)) {

            Mail::to($reserva->huesped->correo)
                ->send(new ReservaConfirmadaMail($reserva));

        }

    } catch (\Exception $e) {

        report($e);

    }

    /*
    |--------------------------------------------------------------------------
    | Redirección
    |--------------------------------------------------------------------------
    */

    return redirect()

        ->route('reservas.index')

        ->with('success', 'Reserva registrada correctamente. El correo de confirmación fue enviado al huésped.');

}

    /**
     * Mostrar una reserva.
     */
        public function show(Reserva $reserva)
    {
        $reserva->load([
            'huesped',
            'habitacion',
            'usuario'
        ]);

        return view('reservas.show', compact('reserva'));
    }

     /**
     * Mostrar formulario para editar.
     */
    public function edit(Reserva $reserva)
{
    $huespedes = Huesped::orderBy('nombres')->get();

    $habitaciones = Habitacion::orderBy('numero')->get();

    return view('reservas.edit', compact(
        'reserva',
        'huespedes',
        'habitaciones'
    ));
}

    
    /**
     * Actualizar reserva.
     */
    public function update(Request $request, Reserva $reserva)
{
    $datos = $request->validate([

        'huesped_id' => 'required|exists:huespedes,id',

        'habitacion_id' => 'required|exists:habitaciones,id',

        'fecha_reserva' => 'required|date',

        'fecha_ingreso' => 'required|date',

        'fecha_salida' => 'required|date|after:fecha_ingreso',

        'cantidad_personas' => 'required|integer|min:1',

        'estado' => 'required',

        'observaciones' => 'nullable|string'

    ]);

    /*
    |--------------------------------------------------------------------------
    | Verificar disponibilidad
    |--------------------------------------------------------------------------
    */

    $ocupada = Reserva::where('habitacion_id', $datos['habitacion_id'])

        ->where('id', '!=', $reserva->id)

        ->whereNotIn('estado', ['Cancelada', 'Finalizada'])

        ->where(function ($query) use ($datos) {

            $query->whereBetween('fecha_ingreso', [
                $datos['fecha_ingreso'],
                $datos['fecha_salida']
            ])

            ->orWhereBetween('fecha_salida', [
                $datos['fecha_ingreso'],
                $datos['fecha_salida']
            ])

            ->orWhere(function ($q) use ($datos) {

                $q->where('fecha_ingreso', '<=', $datos['fecha_ingreso'])

                  ->where('fecha_salida', '>=', $datos['fecha_salida']);

            });

        })

        ->exists();

    if ($ocupada) {

        return back()
            ->withInput()
            ->with('error', 'La habitación ya está reservada para esas fechas.');

    }

    /*
    |--------------------------------------------------------------------------
    | Liberar habitación anterior si cambió
    |--------------------------------------------------------------------------
    */

    if ($reserva->habitacion_id != $datos['habitacion_id']) {

        Habitacion::find($reserva->habitacion_id)?->update([
            'estado' => 'Disponible'
        ]);

    }

    /*
    |--------------------------------------------------------------------------
    | Actualizar reserva
    |--------------------------------------------------------------------------
    */

    $reserva->update($datos);

    /*
    |--------------------------------------------------------------------------
    | Estado de la habitación según la reserva
    |--------------------------------------------------------------------------
    */

    $estadoHabitacion = match ($datos['estado']) {

        'Pendiente' => 'Reservada',

        'Confirmada' => 'Ocupada',

        'Finalizada' => 'Disponible',

        'Cancelada' => 'Disponible',

        default => 'Disponible',

    };

    Habitacion::find($datos['habitacion_id'])?->update([
        'estado' => $estadoHabitacion
    ]);

    return redirect()
        ->route('reservas.index')
        ->with('success', 'Reserva actualizada correctamente.');
}

    /**
     * Eliminar reserva.
     */
        public function destroy(Reserva $reserva)
    {
        try {

            $habitacion = $reserva->habitacion;

            $reserva->delete();

            if ($habitacion) {

                $tieneReservas = Reserva::where('habitacion_id', $habitacion->id)

                    ->whereNotIn('estado', ['Cancelada', 'Finalizada'])

                    ->exists();

                if (!$tieneReservas) {

                    $habitacion->update([

                        'estado' => 'Disponible'

                    ]);

                }

            }

            return redirect()

                ->route('reservas.index')

                ->with('success', 'Reserva eliminada correctamente.');

        } catch (\Exception $e) {

            return redirect()

                ->route('reservas.index')

                ->with('error', 'No se pudo eliminar la reserva.');

        }
    }
}