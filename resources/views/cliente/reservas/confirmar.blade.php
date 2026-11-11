@extends('layouts.cliente')

@section('title','Confirmar Reserva')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">

        <h4>

            <i class="bi bi-person-vcard"></i>

            Completa tus datos

        </h4>

    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('cliente.reservar.guardar') }}">

            @csrf

            {{-- Datos de la reserva --}}
            <input type="hidden"
                   name="habitacion_id"
                   value="{{ $datos['habitacion_id'] }}">

            <input type="hidden"
                   name="fecha_ingreso"
                   value="{{ $datos['fecha_ingreso'] }}">

            <input type="hidden"
                   name="fecha_salida"
                   value="{{ $datos['fecha_salida'] }}">

            <input type="hidden"
                   name="cantidad_personas"
                   value="{{ $datos['cantidad_personas'] }}">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Tipo de documento

                    </label>

                    <select
                        name="tipo_documento"
                        class="form-select"
                        required>

                        <option value="">Seleccione...</option>

                        <option value="Cédula">Cédula</option>

                        <option value="Pasaporte">Pasaporte</option>

                        <option value="Tarjeta de identidad">Tarjeta de identidad</option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Número de documento

                    </label>

                    <input
                        type="text"
                        name="numero_documento"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Teléfono

                    </label>

                    <input
                        type="text"
                        name="telefono"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Ciudad

                    </label>

                    <input
                        type="text"
                        name="ciudad"
                        class="form-control"
                        required>

                </div>

                <div class="col-12 mb-3">

                    <label class="form-label">

                        Dirección

                    </label>

                    <input
                        type="text"
                        name="direccion"
                        class="form-control"
                        required>

                </div>

            </div>

            <div class="d-grid">

                <button
                    class="btn btn-success btn-lg">

                    <i class="bi bi-check-circle me-2"></i>

                    Confirmar Reserva

                </button>

            </div>

        </form>

    </div>

</div>

@endsection