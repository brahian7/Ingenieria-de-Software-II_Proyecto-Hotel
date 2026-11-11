@extends('layouts.admin')

@section('title', 'Detalle de la Reserva')

@section('content')

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                <i class="bi bi-calendar-check-fill text-primary"></i>

                Detalle de la Reserva

            </h2>

            <p class="text-muted mb-0">

                Información completa de la reserva seleccionada.

            </p>

        </div>

        <a href="{{ route('reservas.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <div class="row">

        {{-- Datos del huésped --}}
        <div class="col-lg-6 mb-4">

            <div class="card shadow border-0 h-100">

                <div class="card-header bg-primary text-white">

                    <h5 class="mb-0">

                        <i class="bi bi-person-fill me-2"></i>

                        Huésped

                    </h5>

                </div>

                <div class="card-body">

                    <p>

                        <strong>Nombre:</strong>

                        {{ $reserva->huesped->nombres }}

                        {{ $reserva->huesped->apellidos }}

                    </p>

                    <p>

                        <strong>Documento:</strong>

                        {{ $reserva->huesped->tipo_documento }}

                        {{ $reserva->huesped->numero_documento }}

                    </p>

                    <p>

                        <strong>Teléfono:</strong>

                        {{ $reserva->huesped->telefono }}

                    </p>

                    <p>

                        <strong>Correo:</strong>

                        {{ $reserva->huesped->correo ?: 'No registrado' }}

                    </p>

                    <p class="mb-0">

                        <strong>Ciudad:</strong>

                        {{ $reserva->huesped->ciudad ?: 'No registrada' }}

                    </p>

                </div>

            </div>

        </div>

        {{-- Datos de la habitación --}}
        <div class="col-lg-6 mb-4">

            <div class="card shadow border-0 h-100">

                <div class="card-header bg-success text-white">

                    <h5 class="mb-0">

                        <i class="bi bi-door-open-fill me-2"></i>

                        Habitación

                    </h5>

                </div>

                <div class="card-body">

                    <p>

                        <strong>Número:</strong>

                        {{ $reserva->habitacion->numero }}

                    </p>

                    <p>

                        <strong>Tipo:</strong>

                        {{ $reserva->habitacion->tipo }}

                    </p>

                    <p>

                        <strong>Capacidad:</strong>

                        {{ $reserva->habitacion->capacidad }}

                        Personas

                    </p>

                    <p class="mb-0">

                        <strong>Precio por noche:</strong>

                        $ {{ number_format($reserva->habitacion->precio_noche,0,',','.') }}

                    </p>

                </div>

            </div>

        </div>
                {{-- Información de la reserva --}}
        <div class="col-12 mb-4">

            <div class="card shadow border-0">

                <div class="card-header bg-dark text-white">

                    <h5 class="mb-0">

                        <i class="bi bi-calendar-event-fill me-2"></i>

                        Información de la Reserva

                    </h5>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3 mb-3">

                            <strong>Fecha de reserva</strong>

                            <p>

                                {{ $reserva->fecha_reserva->format('d/m/Y') }}

                            </p>

                        </div>

                        <div class="col-md-3 mb-3">

                            <strong>Fecha ingreso</strong>

                            <p>

                                {{ $reserva->fecha_ingreso->format('d/m/Y') }}

                            </p>

                        </div>

                        <div class="col-md-3 mb-3">

                            <strong>Fecha salida</strong>

                            <p>

                                {{ $reserva->fecha_salida->format('d/m/Y') }}

                            </p>

                        </div>

                        <div class="col-md-3 mb-3">

                            <strong>Cantidad de personas</strong>

                            <p>

                                {{ $reserva->cantidad_personas }}

                            </p>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 mb-3">

                            <strong>Noches</strong>

                            <p>

                                {{ $reserva->fecha_ingreso->diffInDays($reserva->fecha_salida) }}

                            </p>

                        </div>

                        <div class="col-md-3 mb-3">

                            <strong>Total estimado</strong>

                            <p class="fw-bold text-success">

                                $

                                {{ number_format(
                                    $reserva->habitacion->precio_noche *
                                    $reserva->fecha_ingreso->diffInDays($reserva->fecha_salida),
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </p>

                        </div>

                        <div class="col-md-3 mb-3">

                            <strong>Estado</strong>

                            <p>

                                @switch($reserva->estado)

                                    @case('Pendiente')

                                        <span class="badge bg-warning text-dark">

                                            Pendiente

                                        </span>

                                    @break

                                    @case('Confirmada')

                                        <span class="badge bg-success">

                                            Confirmada

                                        </span>

                                    @break

                                    @case('Cancelada')

                                        <span class="badge bg-danger">

                                            Cancelada

                                        </span>

                                    @break

                                    @default

                                        <span class="badge bg-info">

                                            Finalizada

                                        </span>

                                @endswitch

                            </p>

                        </div>

                        <div class="col-md-3 mb-3">

                            <strong>Registrada por</strong>

                            <p>

                                {{ $reserva->usuario->name }}

                            </p>

                        </div>

                    </div>

                    <hr>

                    <strong>Observaciones</strong>

                    <p class="mb-0">

                        {{ $reserva->observaciones ?: 'Sin observaciones registradas.' }}

                    </p>

                </div>

                <div class="card-footer text-end">

                    <a href="{{ route('reservas.index') }}"
                       class="btn btn-secondary">

                        <i class="bi bi-arrow-left"></i>

                        Volver

                    </a>

                    <a href="{{ route('reservas.edit',$reserva) }}"
                       class="btn btn-warning">

                        <i class="bi bi-pencil-fill"></i>

                        Editar

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection