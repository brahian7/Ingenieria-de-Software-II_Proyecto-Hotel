@extends('layouts.admin')

@section('title', 'Habitaciones')

@section('content')

<div class="container-fluid">

    {{-- Encabezado --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                🛏 Gestión de Habitaciones
            </h2>

            <p class="text-muted mb-0">
                Administra todas las habitaciones del Hotel Central La Italia.
            </p>

        </div>

        <a href="{{ route('habitaciones.create') }}"
           class="btn btn-primary shadow">

            <i class="bi bi-plus-circle-fill me-2"></i>

            Nueva Habitación

        </a>

    </div>

    {{-- Tarjetas --}}
    <div class="row mb-4">

        <div class="col-md-3">

            <div class="card border-0 shadow">

                <div class="card-body text-center">

                    <i class="bi bi-door-open-fill text-primary fs-1"></i>

                    <h3 class="mt-2">
                        {{ $habitaciones->total() }}
                    </h3>

                    <small class="text-muted">
                        Total Habitaciones
                    </small>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow">

                <div class="card-body text-center">

                    <i class="bi bi-check-circle-fill text-success fs-1"></i>

                    <h3 class="mt-2">
                        {{ $habitaciones->where('estado','Disponible')->count() }}
                    </h3>

                    <small class="text-muted">
                        Disponibles
                    </small>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow">

                <div class="card-body text-center">

                    <i class="bi bi-person-fill-lock text-danger fs-1"></i>

                    <h3 class="mt-2">
                        {{ $habitaciones->where('estado','Ocupada')->count() }}
                    </h3>

                    <small class="text-muted">
                        Ocupadas
                    </small>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow">

                <div class="card-body text-center">

                    <i class="bi bi-tools text-warning fs-1"></i>

                    <h3 class="mt-2">
                        {{ $habitaciones->where('estado','Mantenimiento')->count() }}
                    </h3>

                    <small class="text-muted">
                        Mantenimiento
                    </small>

                </div>

            </div>

        </div>

    </div>

    {{-- Buscador --}}
    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('habitaciones.index') }}">

                <div class="row g-2">

                    <div class="col-md-6">

                        <input
                            type="text"
                            name="buscar"
                            class="form-control"
                            placeholder="Buscar por número o tipo..."
                            value="{{ request('buscar') }}">

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-dark w-100">

                            <i class="bi bi-search"></i>

                            Buscar

                        </button>

                    </div>

                    <div class="col-md-2">

                        <a href="{{ route('habitaciones.index') }}"
                           class="btn btn-secondary w-100">

                            <i class="bi bi-arrow-clockwise"></i>

                            Limpiar

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Tabla --}}
    <div class="card border-0 shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>Número</th>
                            <th>Tipo</th>
                            <th>Capacidad</th>
                            <th>Precio / Noche</th>
                            <th>Estado</th>
                            <th class="text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($habitaciones as $habitacion)

                        <tr>

                            <td>

                                <strong>{{ $habitacion->numero }}</strong>

                            </td>

                            <td>{{ $habitacion->tipo }}</td>

                            <td>{{ $habitacion->capacidad }} Personas</td>

                            <td>

                                $ {{ number_format($habitacion->precio_noche,0,',','.') }} COP

                            </td>

                            <td>

                                @switch($habitacion->estado)

                                    @case('Disponible')

                                        <span class="badge bg-success">
                                            Disponible
                                        </span>

                                    @break

                                    @case('Ocupada')

                                        <span class="badge bg-danger">
                                            Ocupada
                                        </span>

                                    @break

                                    @case('Reservada')

                                        <span class="badge bg-warning text-dark">
                                            Reservada
                                        </span>

                                    @break

                                    @default

                                        <span class="badge bg-secondary">
                                            Mantenimiento
                                        </span>

                                @endswitch

                            </td>

                            <td class="text-center">

                                <a href="{{ route('habitaciones.show',$habitacion) }}"
                                   class="btn btn-info btn-sm"
                                   title="Ver">

                                    <i class="bi bi-eye-fill"></i>

                                </a>

                                <a href="{{ route('habitaciones.edit',$habitacion) }}"
                                   class="btn btn-warning btn-sm"
                                   title="Editar">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                <form action="{{ route('habitaciones.destroy',$habitacion) }}"
                                      method="POST"
                                      class="d-inline formulario-eliminar">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Eliminar">

                                        <i class="bi bi-trash-fill"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center text-muted py-4">

                                <i class="bi bi-door-closed fs-2"></i>

                                <br>

                                No hay habitaciones registradas.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-4">

                {{ $habitaciones->links() }}

            </div>

        </div>

    </div>

</div>

@endsection

