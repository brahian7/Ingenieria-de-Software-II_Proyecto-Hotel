@extends('layouts.cliente')

@section('title','Mis Reservas')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="mb-0">

        <i class="bi bi-calendar-check-fill me-2"></i>

        Mis Reservas

    </h2>

    <div>

        <a href="{{ route('home') }}"
           class="btn btn-outline-secondary">

            <i class="bi bi-house-door me-2"></i>

            Inicio

        </a>

        <a href="{{ route('cliente.reservar') }}"
           class="btn btn-primary ms-2">

            <i class="bi bi-plus-circle me-2"></i>

            Nueva Reserva

        </a>

    </div>

</div>

@if($reservas->count())

<table class="table table-bordered table-hover align-middle">

    <thead class="table-dark">

        <tr>

            <th>Código</th>

            <th>Habitación</th>

            <th>Ingreso</th>

            <th>Salida</th>

            <th>Total</th>

            <th>Estado</th>

            <th>Acciones</th>

        </tr>

    </thead>

    <tbody>

        @foreach($reservas as $reserva)

        <tr>

            <td>

                {{ $reserva->codigo_reserva }}

            </td>

            <td>

                {{ $reserva->habitacion->numero }}

            </td>

            <td>

                {{ \Carbon\Carbon::parse($reserva->fecha_ingreso)->format('d/m/Y') }}

            </td>

            <td>

                {{ \Carbon\Carbon::parse($reserva->fecha_salida)->format('d/m/Y') }}

            </td>

            <td>

                ${{ number_format($reserva->total,0,',','.') }}

            </td>

            <td>

                @php
                    $color = match($reserva->estado) {
                        'Pendiente' => 'warning',
                        'Confirmada' => 'success',
                        'Cancelada' => 'danger',
                        'Finalizada' => 'secondary',
                        default => 'primary',
                    };
                @endphp

                <span class="badge bg-{{ $color }}">

                    {{ $reserva->estado }}

                </span>

            </td>

            <td>

                @if($reserva->estado == 'Pendiente')

                    <form
                        action="{{ route('cliente.reservas.cancelar',$reserva) }}"
                        method="POST"
                        class="formulario-eliminar">

                        @csrf

                        @method('PATCH')

                        <button
                            type="submit"
                            class="btn btn-danger btn-sm">

                            <i class="bi bi-x-circle me-1"></i>

                            Cancelar

                        </button>

                    </form>

                @else

                    <span class="text-muted">

                        —

                    </span>

                @endif

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@else

<div class="alert alert-info">

    <i class="bi bi-info-circle me-2"></i>

    Todavía no has realizado ninguna reserva.

</div>

<div class="text-center mt-4">

    <a href="{{ route('cliente.reservar') }}"
       class="btn btn-primary btn-lg">

        <i class="bi bi-plus-circle me-2"></i>

        Reservar una Habitación

    </a>

</div>

@endif

@endsection