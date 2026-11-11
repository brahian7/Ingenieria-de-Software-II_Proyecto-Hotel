<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Habitacion;
use App\Models\Huesped;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Dashboard del Cliente
        |--------------------------------------------------------------------------
        */

        if (Auth::user()->rol === 'Cliente') {

            return view('dashboard.cliente');

        }

        /*
        |--------------------------------------------------------------------------
        | Estadísticas Generales
        |--------------------------------------------------------------------------
        */

        $usuarios = User::count();

        $habitaciones = Habitacion::count();

        $huespedes = Huesped::count();

        $reservas = Reserva::count();

        /*
        |--------------------------------------------------------------------------
        | Estado de Habitaciones
        |--------------------------------------------------------------------------
        */

        $disponibles = Habitacion::where('estado', 'Disponible')->count();

        $ocupadas = Habitacion::where('estado', 'Ocupada')->count();

        $reservadas = Habitacion::where('estado', 'Reservada')->count();

        $mantenimiento = Habitacion::where('estado', 'Mantenimiento')->count();

        /*
        |--------------------------------------------------------------------------
        | Estado de Reservas
        |--------------------------------------------------------------------------
        */

        $reservasPendientes = Reserva::where('estado', 'Pendiente')->count();

        $reservasActivas = Reserva::where('estado', 'Activa')->count();

        $reservasFinalizadas = Reserva::where('estado', 'Finalizada')->count();

        $reservasCanceladas = Reserva::where('estado', 'Cancelada')->count();

        /*
        |--------------------------------------------------------------------------
        | Huéspedes Hospedados
        |--------------------------------------------------------------------------
        */

        $huespedesHospedados = Reserva::where('estado', 'Activa')->count();

        /*
        |--------------------------------------------------------------------------
        | Ingresos
        |--------------------------------------------------------------------------
        */

        // Histórico
        $ingresos = Reserva::sum('total');

        // Hoy
        $ingresosHoy = Reserva::whereDate('fecha_reserva', today())
            ->sum('total');

        // Mes
        $ingresosMes = Reserva::whereMonth('fecha_reserva', now()->month)
            ->whereYear('fecha_reserva', now()->year)
            ->sum('total');

        // Año
        $ingresosAnio = Reserva::whereYear('fecha_reserva', now()->year)
            ->sum('total');

        /*
        |--------------------------------------------------------------------------
        | Ocupación
        |--------------------------------------------------------------------------
        */

        if ($habitaciones > 0) {

            $ocupacion = round(

                (($ocupadas + $reservadas) / $habitaciones) * 100

            );

        } else {

            $ocupacion = 0;

        }

        /*
        |--------------------------------------------------------------------------
        | Actividad del Día
        |--------------------------------------------------------------------------
        */

        $reservasHoy = Reserva::whereDate('fecha_reserva', today())
            ->count();

        $checkInHoy = Reserva::whereDate('fecha_ingreso', today())
            ->count();

        $checkOutHoy = Reserva::whereDate('fecha_salida', today())
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Reservas del Mes
        |--------------------------------------------------------------------------
        */

        $reservasMes = Reserva::whereMonth('fecha_reserva', now()->month)
            ->whereYear('fecha_reserva', now()->year)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Últimas Reservas
        |--------------------------------------------------------------------------
        */

        $ultimasReservas = Reserva::with([
                'huesped',
                'habitacion'
            ])
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Vista
        |--------------------------------------------------------------------------
        */

        return view('dashboard.index', compact(

            'usuarios',

            'habitaciones',

            'huespedes',

            'reservas',

            'disponibles',

            'ocupadas',

            'reservadas',

            'mantenimiento',

            'reservasPendientes',

            'reservasActivas',

            'reservasFinalizadas',

            'reservasCanceladas',

            'huespedesHospedados',

            'ingresos',

            'ingresosHoy',

            'ingresosMes',

            'ingresosAnio',

            'ocupacion',

            'reservasMes',

            'reservasHoy',

            'checkInHoy',

            'checkOutHoy',

            'ultimasReservas'

        ));
    }
}