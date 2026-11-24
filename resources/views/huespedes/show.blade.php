@extends('layouts.admin')

@section('title', 'Información del Huésped')

@section('content')

<div class="container-fluid mt-4">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">

                <i class="bi bi-person-badge-fill me-2"></i>

                Información del Huésped

            </h4>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <strong>Tipo de documento</strong>

                    <p>{{ $huesped->tipo_documento }}</p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Número de documento</strong>

                    <p>{{ $huesped->numero_documento }}</p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Nombres</strong>

                    <p>{{ $huesped->nombres }}</p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Apellidos</strong>

                    <p>{{ $huesped->apellidos }}</p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Teléfono</strong>

                    <p>{{ $huesped->telefono }}</p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Correo</strong>

                    <p>{{ $huesped->correo ?: 'No registrado' }}</p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Ciudad</strong>

                    <p>{{ $huesped->ciudad ?: 'No registrada' }}</p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Fecha de registro</strong>

                    <p>{{ $huesped->fecha_registro->format('d/m/Y') }}</p>

                </div>

                <div class="col-12">

                    <strong>Dirección</strong>

                    <p>{{ $huesped->direccion ?: 'No registrada' }}</p>

                </div>

            </div>

        </div>

        <div class="card-footer text-end">

            <a href="{{ route('huespedes.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>

                Volver

            </a>

            <a href="{{ route('huespedes.edit',$huesped) }}"
               class="btn btn-warning">

                <i class="bi bi-pencil-fill"></i>

                Editar

            </a>

        </div>

    </div>

</div>

@endsection