@extends('layouts.admin')

@section('title', 'Información de la Habitación')

@section('content')

<div class="container-fluid mt-4">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">

                <i class="bi bi-door-open-fill me-2"></i>

                Información de la Habitación

            </h4>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-4">

                    <strong class="text-muted">

                        Número de habitación

                    </strong>

                    <h4 class="mt-2">

                        {{ $habitacion->numero }}

                    </h4>

                </div>

                <div class="col-md-6 mb-4">

                    <strong class="text-muted">

                        Tipo

                    </strong>

                    <h5 class="mt-2">

                        {{ $habitacion->tipo }}

                    </h5>

                </div>

                <div class="col-md-6 mb-4">

                    <strong class="text-muted">

                        Capacidad

                    </strong>

                    <h5 class="mt-2">

                        <i class="bi bi-people-fill text-primary"></i>

                        {{ $habitacion->capacidad }} Personas

                    </h5>

                </div>

                <div class="col-md-6 mb-4">

                    <strong class="text-muted">

                        Precio por noche

                    </strong>

                    <h4 class="text-success mt-2">

                        $ {{ number_format($habitacion->precio_noche,0,',','.') }} COP

                    </h4>

                </div>

                <div class="col-md-6 mb-4">

                    <strong class="text-muted">

                        Estado

                    </strong>

                    <div class="mt-2">

                        @switch($habitacion->estado)

                            @case('Disponible')

                                <span class="badge bg-success fs-6">

                                    Disponible

                                </span>

                            @break

                            @case('Ocupada')

                                <span class="badge bg-danger fs-6">

                                    Ocupada

                                </span>

                            @break

                            @case('Reservada')

                                <span class="badge bg-warning text-dark fs-6">

                                    Reservada

                                </span>

                            @break

                            @default

                                <span class="badge bg-secondary fs-6">

                                    Mantenimiento

                                </span>

                        @endswitch

                    </div>

                </div>

                <div class="col-md-6 mb-4">

                    <strong class="text-muted">

                        Imagen

                    </strong>

                    <div class="mt-2">

                        @if($habitacion->imagen)

                            <img
                                src="{{ asset($habitacion->imagen) }}"
                                class="img-fluid rounded shadow"
                                style="max-height:200px;">

                        @else

                            <div class="alert alert-light border">

                                <i class="bi bi-image text-secondary"></i>

                                Sin imagen registrada.

                            </div>

                        @endif

                    </div>

                </div>

                <div class="col-12">

                    <strong class="text-muted">

                        Descripción

                    </strong>

                    <div class="border rounded p-3 bg-light mt-2">

                        {{ $habitacion->descripcion ?: 'No hay descripción registrada para esta habitación.' }}

                    </div>

                </div>

            </div>

        </div>

        <div class="card-footer text-end">

            <a href="{{ route('habitaciones.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>

                Volver

            </a>

            <a href="{{ route('habitaciones.edit', $habitacion->id) }}"
               class="btn btn-warning">

                <i class="bi bi-pencil-fill"></i>

                Editar

            </a>

        </div>

    </div>

</div>

@endsection