@php

use Carbon\Carbon;

Carbon::setLocale('es');

$hora = now()->hour;

if ($hora >= 5 && $hora < 12) {

    $saludo = '☀ Buenos días';

} elseif ($hora >= 12 && $hora < 18) {

    $saludo = '🌤 Buenas tardes';

} else {

    $saludo = '🌙 Buenas noches';

}

@endphp

<div class="card border-0 shadow-lg overflow-hidden mb-5"
     data-aos="fade-down"
     style="background:linear-gradient(135deg,#1d4ed8,#2563eb);border-radius:24px;">

    <div class="card-body p-5">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <span class="badge bg-light text-primary fs-6 px-3 py-2 mb-3">

                    Sistema de Gestión Hotelera

                </span>

                <h2 class="fw-bold text-white mb-3">

                    {{ $saludo }}, {{ Auth::user()->nombre }}

                </h2>

                <p class="text-white opacity-75 fs-5 mb-4">

                    Bienvenido nuevamente.

                    Aquí tienes el resumen de la operación del hotel para hoy.

                </p>

                <div class="row text-white mt-4">

                    <div class="col-md-6 mb-3">

                        <i class="bi bi-building-fill me-2"></i>

                        <strong>Hotel Central La Italia</strong>

                    </div>

                    <div class="col-md-6 mb-3">

                        <i class="bi bi-geo-alt-fill me-2"></i>

                        Cartago, Valle del Cauca

                    </div>

                    <div class="col-md-6">

                        <i class="bi bi-calendar-event-fill me-2"></i>

                        {{ ucfirst(now()->translatedFormat('l, d \d\e F \d\e Y')) }}

                    </div>

                    <div class="col-md-6">

                        <i class="bi bi-clock-fill me-2"></i>

                        {{ now()->format('h:i A') }}

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="bg-white rounded-4 shadow-lg p-4">

                    <h4 class="fw-bold text-primary mb-4">

                        <i class="bi bi-bar-chart-fill me-2"></i>

                        Resumen del día

                    </h4>

                    {{-- Reservas de hoy --}}

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span>

                            <i class="bi bi-calendar-check text-success me-2"></i>

                            Reservas hoy

                        </span>

                        <span class="badge bg-success fs-6">

                            {{ $reservasHoy }}

                        </span>

                    </div>

                    {{-- Check In --}}

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span>

                            <i class="bi bi-door-open text-warning me-2"></i>

                            Check-in

                        </span>

                        @if($checkInHoy > 0)

                            <span class="badge bg-warning text-dark fs-6">

                                {{ $checkInHoy }} Hoy

                            </span>

                        @else

                            <span class="badge bg-secondary fs-6">

                                Sin ingresos

                            </span>

                        @endif

                    </div>

                    {{-- Check Out --}}

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span>

                            <i class="bi bi-door-closed text-info me-2"></i>

                            Check-out

                        </span>

                        @if($checkOutHoy > 0)

                            <span class="badge bg-info fs-6">

                                {{ $checkOutHoy }} Hoy

                            </span>

                        @else

                            <span class="badge bg-secondary fs-6">

                                Sin salidas

                            </span>

                        @endif

                    </div>

                    {{-- Estado del sistema --}}

                    <div class="d-flex justify-content-between align-items-center">

                        <span>

                            <i class="bi bi-cpu-fill text-primary me-2"></i>

                            Estado

                        </span>

                        <span class="badge bg-success">

                            Operativo

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>