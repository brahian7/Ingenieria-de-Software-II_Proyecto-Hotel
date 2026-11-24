@extends('layouts.cliente')

@section('title', 'Reservar Habitación')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <h4>

            <i class="bi bi-search"></i>

            Buscar Habitaciones Disponibles

        </h4>

    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('cliente.reservar.store') }}">

            @csrf

            <div class="row">

                <div class="col-md-4">

                    <label class="form-label">

                        Fecha ingreso

                    </label>

                    <input
                        type="date"
                        id="fecha_ingreso"
                        name="fecha_ingreso"
                        class="form-control"
                        min="{{ date('Y-m-d') }}"
                        value="{{ old('fecha_ingreso', $datos['fecha_ingreso'] ?? '') }}"
                        required>

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Fecha salida

                    </label>

                    <input
                        type="date"
                        id="fecha_salida"
                        name="fecha_salida"
                        class="form-control"
                        min="{{ date('Y-m-d') }}"
                        value="{{ old('fecha_salida', $datos['fecha_salida'] ?? '') }}"
                        required>

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Personas

                    </label>

                    <input
                        type="number"
                        name="cantidad_personas"
                        class="form-control"
                        min="1"
                        value="{{ old('cantidad_personas', $datos['cantidad_personas'] ?? '') }}"
                        required>

                </div>

            </div>

            <div class="mt-4">

                <button class="btn btn-primary">

                    <i class="bi bi-search me-2"></i>

                    Buscar Disponibilidad

                </button>

            </div>

        </form>

    </div>

</div>

@if(isset($habitaciones))

<hr class="my-5">

<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <h4 class="fw-bold mb-4">

            <i class="bi bi-search text-primary me-2"></i>

            Resultado de la búsqueda

        </h4>

        <div class="row text-center">

            <div class="col-md-3">

                <strong>Check-in</strong>

                <br>

                {{ \Carbon\Carbon::parse($datos['fecha_ingreso'])->format('d/m/Y') }}

            </div>

            <div class="col-md-3">

                <strong>Check-out</strong>

                <br>

                {{ \Carbon\Carbon::parse($datos['fecha_salida'])->format('d/m/Y') }}

            </div>

            <div class="col-md-3">

                <strong>Personas</strong>

                <br>

                {{ $datos['cantidad_personas'] }}

            </div>

            <div class="col-md-3">

                <strong>Disponibles</strong>

                <br>

                <span class="badge bg-success fs-6">

                    {{ $habitaciones->count() }}

                    habitación(es)

                </span>

            </div>

        </div>

    </div>

</div>

<h3 class="fw-bold mb-4">

    <i class="bi bi-building-check text-success me-2"></i>

    Habitaciones disponibles para las fechas seleccionadas

</h3>

@if($habitaciones->count())

<div class="row">

@foreach($habitaciones as $habitacion)

<div class="col-md-4 mb-4">

    <div class="card shadow h-100 border-0">

        <div class="card-body">

            <h4 class="card-title">

                Habitación {{ $habitacion->numero }}

            </h4>

            <hr>

            <p>

                <strong>Tipo:</strong>

                {{ $habitacion->tipo }}

            </p>

            <p>

                <strong>Precio por noche:</strong>

                ${{ number_format($habitacion->precio_noche,0,',','.') }}

            </p>

            @if(isset($habitacion->capacidad))

            <p>

                <strong>Capacidad:</strong>

                {{ $habitacion->capacidad }}

                personas

            </p>

            @endif

            <span class="badge bg-success px-3 py-2 mb-3">

                <i class="bi bi-check-circle-fill me-1"></i>

                Disponible

            </span>

            <form method="POST"
                  action="{{ route('cliente.reservar.confirmar') }}">

                @csrf

                <input type="hidden"
                       name="habitacion_id"
                       value="{{ $habitacion->id }}">

                <input type="hidden"
                       name="fecha_ingreso"
                       value="{{ $datos['fecha_ingreso'] }}">

                <input type="hidden"
                       name="fecha_salida"
                       value="{{ $datos['fecha_salida'] }}">

                <input type="hidden"
                       name="cantidad_personas"
                       value="{{ $datos['cantidad_personas'] }}">

                <button class="btn btn-primary w-100">

                    <i class="bi bi-calendar2-check me-2"></i>

                    Reservar ahora

                </button>

            </form>

        </div>

    </div>

</div>

@endforeach

</div>

@else

<div class="alert alert-warning shadow-sm">

    <h5>

        <i class="bi bi-exclamation-circle-fill me-2"></i>

        No encontramos habitaciones disponibles

    </h5>

    <hr>

    <p class="mb-0">

        Intenta cambiar las fechas de ingreso o salida para consultar otras habitaciones.

    </p>

</div>

@endif

@endif

@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const ingreso = document.getElementById('fecha_ingreso');
    const salida = document.getElementById('fecha_salida');

    ingreso.addEventListener('change', function () {

        salida.min = this.value;

        if (salida.value === '' || salida.value <= this.value) {

            let fecha = new Date(this.value);

            fecha.setDate(fecha.getDate() + 1);

            salida.value = fecha.toISOString().split('T')[0];

        }

    });

});

</script>

@endpush