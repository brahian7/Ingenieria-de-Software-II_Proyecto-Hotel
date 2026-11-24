@extends('layouts.admin')

@section('title', 'Nueva Habitación')

@section('content')

<div class="container-fluid">

    <div class="row">

        {{-- Formulario --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow">

                <div class="card-header bg-primary text-white">

                    <h3 class="mb-0">

                        <i class="bi bi-door-open-fill me-2"></i>

                        Registrar Nueva Habitación

                    </h3>

                </div>

                <div class="card-body p-4">

                    <p class="text-muted mb-4">

                        Complete la información para registrar una nueva habitación del
                        <strong>Hotel Central La Italia</strong>.

                    </p>

                    <form action="{{ route('habitaciones.store') }}"
                          method="POST">

                        @csrf

                        @include('habitaciones._form')

                    </form>

                </div>

            </div>

        </div>

        {{-- Panel lateral --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow h-100">

                <div class="card-body text-center">

                    <i class="bi bi-building-fill text-primary"
                       style="font-size:70px;"></i>

                    <h4 class="mt-3 fw-bold">

                        Hotel Central La Italia

                    </h4>

                    <p class="text-muted">

                        Registro de habitaciones

                    </p>

                    <hr>

                    <div class="text-start">

                        <p>

                            <i class="bi bi-check-circle-fill text-success me-2"></i>

                            Registro rápido y seguro.

                        </p>

                        <p>

                            <i class="bi bi-shield-check text-primary me-2"></i>

                            Información protegida.

                        </p>

                        <p>

                            <i class="bi bi-stars text-warning me-2"></i>

                            Administración moderna.

                        </p>

                        <p>

                            <i class="bi bi-house-check text-success me-2"></i>

                            Habitaciones disponibles en tiempo real.

                        </p>

                    </div>

                    <hr>

                    <div class="alert alert-light border">

                        <h6 class="fw-bold">

                            Consejo

                        </h6>

                        <small class="text-muted">

                            Verifique que el número de habitación no exista antes de registrarla.

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
