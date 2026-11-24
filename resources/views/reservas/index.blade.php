@extends('layouts.admin')

@section('title','Reservas')

@section('content')

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-calendar-check-fill text-primary me-2"></i>
                Gestión de Reservas
            </h2>

            <p class="text-muted mb-0">
                Administre, consulte y controle todas las reservas del hotel.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('reservas.exportar.pdf', request()->query()) }}"
               class="btn btn-danger">

                <i class="bi bi-file-earmark-pdf-fill me-2"></i>

                Exportar PDF

            </a>

            <a href="{{ route('reservas.create') }}"
               class="btn btn-primary">

                <i class="bi bi-plus-circle-fill me-2"></i>

                Nueva Reserva

            </a>

        </div>

    </div>


    <div class="card border-0 shadow-lg">

        <div class="card-header bg-white py-4">

            <form method="GET">

                <div class="row g-3 align-items-end">

                    <div class="col-lg-4">

                        <label class="form-label fw-semibold">

                            Buscar

                        </label>

                        <input
                            type="text"
                            name="buscar"
                            class="form-control"
                            placeholder="Nombre, documento o habitación..."
                            value="{{ request('buscar') }}">

                    </div>

                    <div class="col-lg-2">

                        <label class="form-label fw-semibold">

                            Estado

                        </label>

                        <select
                            name="estado"
                            class="form-select">

                            <option value="">Todos</option>

                            <option value="Pendiente"
                                {{ request('estado')=='Pendiente' ? 'selected' : '' }}>
                                Pendiente
                            </option>

                            <option value="Confirmada"
                                {{ request('estado')=='Confirmada' ? 'selected' : '' }}>
                                Confirmada
                            </option>

                            <option value="Finalizada"
                                {{ request('estado')=='Finalizada' ? 'selected' : '' }}>
                                Finalizada
                            </option>

                            <option value="Cancelada"
                                {{ request('estado')=='Cancelada' ? 'selected' : '' }}>
                                Cancelada
                            </option>

                        </select>

                    </div>

                    <div class="col-lg-2">

                        <label class="form-label fw-semibold">

                            Desde

                        </label>

                        <input
                            type="date"
                            name="desde"
                            class="form-control"
                            value="{{ request('desde') }}">

                    </div>

                    <div class="col-lg-2">

                        <label class="form-label fw-semibold">

                            Hasta

                        </label>

                        <input
                            type="date"
                            name="hasta"
                            class="form-control"
                            value="{{ request('hasta') }}">

                    </div>

                    <div class="col-lg-2">

                        <div class="d-grid gap-2">

                            <button class="btn btn-primary">

                                <i class="bi bi-search me-1"></i>

                                Buscar

                            </button>

                            <a href="{{ route('reservas.index') }}"
                               class="btn btn-outline-secondary">

                                Limpiar

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-dark">

                    <tr>

                        <th class="ps-4">Código</th>

                        <th>Huésped</th>

                        <th>Habitación</th>

                        <th>Ingreso</th>

                        <th>Salida</th>

                        <th>Noches</th>

                        <th>Total</th>

                        <th>Estado</th>

                        <th class="text-center">Acciones</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($reservas as $reserva)

                    @php

                        $color='secondary';

                        $icon='question-circle';

                        if($reserva->estado=='Pendiente'){
                            $color='warning';
                            $icon='clock-history';
                        }

                        if($reserva->estado=='Confirmada'){
                            $color='success';
                            $icon='check-circle-fill';
                        }

                        if($reserva->estado=='Finalizada'){
                            $color='primary';
                            $icon='flag-fill';
                        }

                        if($reserva->estado=='Cancelada'){
                            $color='danger';
                            $icon='x-circle-fill';
                        }

                    @endphp

                    <tr>

                        <td class="ps-4 fw-bold">

                            {{ $reserva->codigo_reserva }}

                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <div class="rounded-circle bg-primary text-white fw-bold d-flex justify-content-center align-items-center me-3"
                                     style="width:45px;height:45px;">

                                    {{ strtoupper(substr($reserva->huesped->nombres,0,1)) }}

                                </div>

                                <div>

                                    <div class="fw-semibold">

                                        {{ $reserva->huesped->nombres }}
                                        {{ $reserva->huesped->apellidos }}

                                    </div>

                                    <small class="text-muted">

                                        {{ $reserva->huesped->numero_documento }}

                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>

                            <span class="badge bg-light text-dark border px-3 py-2">

                                <i class="bi bi-door-open me-1"></i>

                                Habitación {{ $reserva->habitacion->numero }}

                            </span>

                        </td>

                        <td>

                            <i class="bi bi-box-arrow-in-right text-success me-1"></i>

                            {{ $reserva->fecha_ingreso->format('d/m/Y') }}

                        </td>

                        <td>

                            <i class="bi bi-box-arrow-right text-danger me-1"></i>

                            {{ $reserva->fecha_salida->format('d/m/Y') }}

                        </td>

                        <td>

                            {{ $reserva->cantidad_noches }}

                        </td>

                        <td class="fw-bold text-success">

                            $

                            {{ number_format($reserva->total,0,',','.') }}

                        </td>

                        <td>

                            <span class="badge bg-{{ $color }} px-3 py-2">

                                <i class="bi bi-{{ $icon }} me-1"></i>

                                {{ $reserva->estado }}

                            </span>

                        </td>

                        <td class="text-center">

                            <div class="btn-group">

                                                            <a href="{{ route('reservas.show', $reserva) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   data-bs-toggle="tooltip"
                                   title="Ver reserva">

                                    <i class="bi bi-eye-fill"></i>

                                </a>

                                <a href="{{ route('reservas.edit', $reserva) }}"
                                   class="btn btn-sm btn-outline-warning"
                                   data-bs-toggle="tooltip"
                                   title="Editar reserva">

                                    <i class="bi bi-pencil-fill"></i>

                                </a>

                                <form action="{{ route('reservas.destroy', $reserva) }}"
                                      method="POST"
                                      class="formulario-eliminar d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="tooltip"
                                        title="Eliminar reserva">

                                        <i class="bi bi-trash-fill"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9" class="text-center py-5">

                            <i class="bi bi-calendar-x display-3 text-secondary"></i>

                            <h4 class="mt-4">

                                No existen reservas registradas

                            </h4>

                            <p class="text-muted mb-4">

                                Intenta modificar los filtros de búsqueda o registra una nueva reserva.

                            </p>

                            <a href="{{ route('reservas.create') }}"
                               class="btn btn-primary">

                                <i class="bi bi-plus-circle-fill me-2"></i>

                                Crear primera reserva

                            </a>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($reservas->hasPages())

            <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap">

                <div class="text-muted">

                    Mostrando

                    <strong>{{ $reservas->firstItem() }}</strong>

                    -

                    <strong>{{ $reservas->lastItem() }}</strong>

                    de

                    <strong>{{ $reservas->total() }}</strong>

                    reservas

                </div>

                <div>

                    {{ $reservas->appends(request()->query())->links() }}

                </div>

            </div>

        @endif

    </div>

</div>

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

    tooltipTriggerList.map(function (tooltipTriggerEl) {

        return new bootstrap.Tooltip(tooltipTriggerEl);

    });

});

</script>

@endpush

@endsection