<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Reserva;
use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservaController extends ApiController
{
    /**
     * Listado
     */
    public function index()
    {
        $reservas = Reserva::with([
            'huesped',
            'habitacion',
            'usuario'
        ])
        ->orderByDesc('fecha_reserva')
        ->get();

        return $this->successResponse(
            $reservas,
            'Listado de reservas obtenido correctamente.'
        );
    }

    /**
     * Mostrar una reserva
     */
    public function show($id)
    {
        $reserva = Reserva::with([
            'huesped',
            'habitacion',
            'usuario'
        ])->find($id);

        if (!$reserva) {

            return $this->errorResponse(
                'Reserva no encontrada.',
                404
            );

        }

        return $this->successResponse(
            $reserva,
            'Reserva encontrada.'
        );
    }

        /**
     * Registrar una reserva
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

        // Verificar disponibilidad de la habitación
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

            return $this->errorResponse(
                'La habitación ya está reservada para esas fechas.',
                409
            );

        }

        // Usuario autenticado mediante Sanctum
        $datos['usuario_id'] = Auth::id();

        $habitacion = Habitacion::findOrFail($datos['habitacion_id']);

        // Código de reserva
        $ultimoId = (Reserva::max('id') ?? 0) + 1;

        $datos['codigo_reserva'] = 'RES-' . str_pad($ultimoId, 6, '0', STR_PAD_LEFT);

        // Cantidad de noches
        $datos['cantidad_noches'] = Carbon::parse($datos['fecha_ingreso'])
            ->diffInDays(Carbon::parse($datos['fecha_salida']));

        // Precio al momento de reservar
        $datos['precio_noche'] = $habitacion->precio_noche;

        // Total
        $datos['total'] = $datos['cantidad_noches'] * $habitacion->precio_noche;

        // Crear reserva
        $reserva = Reserva::create($datos);

        // Cambiar estado habitación
        $habitacion->update([
            'estado' => 'Reservada'
        ]);

        return $this->successResponse(
            $reserva,
            'Reserva registrada correctamente.',
            201
        );
    }

        /**
     * Actualizar una reserva
     */
    public function update(Request $request, string $id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva) {

            return $this->errorResponse(
                'Reserva no encontrada.',
                404
            );

        }

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

        // Verificar disponibilidad
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

            return $this->errorResponse(
                'La habitación ya está reservada para esas fechas.',
                409
            );

        }

        // Cambio de habitación
        if ($reserva->habitacion_id != $datos['habitacion_id']) {

            Habitacion::find($reserva->habitacion_id)
                ?->update([
                    'estado' => 'Disponible'
                ]);

            Habitacion::find($datos['habitacion_id'])
                ?->update([
                    'estado' => 'Reservada'
                ]);
        }

        $habitacion = Habitacion::findOrFail($datos['habitacion_id']);

        $datos['cantidad_noches'] = Carbon::parse($datos['fecha_ingreso'])
            ->diffInDays(Carbon::parse($datos['fecha_salida']));

        $datos['precio_noche'] = $habitacion->precio_noche;

        $datos['total'] = $datos['cantidad_noches'] * $habitacion->precio_noche;

        $reserva->update($datos);

        return $this->successResponse(
            $reserva->fresh(),
            'Reserva actualizada correctamente.'
        );
    }

        /**
     * Eliminar una reserva
     */
    public function destroy(string $id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva) {

            return $this->errorResponse(
                'Reserva no encontrada.',
                404
            );

        }

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

            return $this->successResponse(
                null,
                'Reserva eliminada correctamente.'
            );

        } catch (\Exception $e) {

            return $this->errorResponse(
                'No se pudo eliminar la reserva.',
                500
            );

        }
    }
}