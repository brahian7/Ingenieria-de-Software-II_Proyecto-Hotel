@extends('layouts.admin')

@section('title', 'Huéspedes')

@section('content')

<div class="container-fluid mt-4">

    {{-- Encabezado --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">
                <i class="bi bi-people-fill text-primary"></i>
                Gestión de Huéspedes
            </h2>

            <p class="text-muted mb-0">
                Administre, consulte y controle todos los huéspedes registrados.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('huespedes.pdf', request()->query()) }}"
               class="btn btn-danger px-4">

                <i class="bi bi-file-earmark-pdf me-2"></i>

                Exportar PDF

            </a>

            <a href="{{ route('huespedes.create') }}"
               class="btn btn-primary px-4">

                <i class="bi bi-plus-circle me-2"></i>

                Nuevo Huésped

            </a>

        </div>

    </div>

    {{-- Filtros --}}
    <div class="card border-0 shadow-lg rounded-4 mb-4">

        <div class="card-body p-4">

            <form method="GET"
                  action="{{ route('huespedes.index') }}">

                <div class="row g-3 align-items-end">

                    <div class="col-md-3">

                        <label class="form-label fw-bold">
                            Buscar
                        </label>

                        <input
                            type="text"
                            name="buscar"
                            class="form-control"
                            placeholder="Nombre o apellido..."
                            value="{{ request('buscar') }}">

                    </div>

                    <div class="col-md-2">

                        <label class="form-label fw-bold">
                            Ciudad
                        </label>

                        <select
                            name="ciudad"
                            class="form-select">

                            <option value="">Todas</option>

                            @foreach($ciudades as $ciudad)

                                <option
                                    value="{{ $ciudad }}"
                                    {{ request('ciudad') == $ciudad ? 'selected' : '' }}>

                                    {{ $ciudad }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-2">

                        <label class="form-label fw-bold">
                            Documento
                        </label>

                        <input
                            type="text"
                            name="documento"
                            class="form-control"
                            value="{{ request('documento') }}">

                    </div>

                    <div class="col-md-2">

                        <label class="form-label fw-bold">
                            Correo
                        </label>

                        <input
                            type="text"
                            name="correo"
                            class="form-control"
                            value="{{ request('correo') }}">

                    </div>

                    <div class="col-md-3 d-grid">

                        <button
                            class="btn btn-primary mb-2">

                            <i class="bi bi-search me-2"></i>

                            Buscar

                        </button>

                        <a
                            href="{{ route('huespedes.index') }}"
                            class="btn btn-outline-secondary">

                            Limpiar

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Tabla --}}
    <div class="card border-0 shadow">

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead class="table-dark">

                    <tr>

                        <th>Documento</th>

                        <th>Huésped</th>

                        <th>Teléfono</th>

                        <th>Correo</th>

                        <th>Ciudad</th>

                        <th class="text-center">Acciones</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($huespedes as $huesped)

                    <tr>

                        <td>

                            <strong>

                                {{ $huesped->numero_documento }}

                            </strong>

                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <div
                                    class="rounded-circle bg-primary text-white fw-bold d-flex justify-content-center align-items-center me-3"
                                    style="width:55px;height:55px;font-size:22px;">

                                    {{ strtoupper(substr($huesped->nombres,0,1)) }}

                                </div>

                                <div>

                                    <h5 class="mb-1">

                                        {{ $huesped->nombres }}
                                        {{ $huesped->apellidos }}

                                    </h5>

                                </div>

                            </div>

                        </td>

                        <td>

                            {{ $huesped->telefono }}

                        </td>

                        <td>

                            {{ $huesped->correo ?? 'No registrado' }}

                        </td>

                        <td>

                            {{ $huesped->ciudad ?? 'No registrada' }}

                        </td>

                        <td class="text-center">

                            <div class="btn-group">

                                <a
                                    href="{{ route('huespedes.show',$huesped) }}"
                                    class="btn btn-outline-primary">

                                    <i class="bi bi-eye-fill"></i>

                                </a>

                                <a
                                    href="{{ route('huespedes.edit',$huesped) }}"
                                    class="btn btn-outline-warning">

                                    <i class="bi bi-pencil-fill"></i>

                                </a>

                                <form
                                    action="{{ route('huespedes.destroy',$huesped) }}"
                                    method="POST"
                                    class="d-inline formulario-eliminar">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-outline-danger">

                                        <i class="bi bi-trash-fill"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="text-center py-5 text-muted">

                            <i class="bi bi-people fs-1"></i>

                            <br><br>

                            No existen huéspedes registrados.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-4">

        {{ $huespedes->withQueryString()->links() }}

    </div>

</div>

@endsection