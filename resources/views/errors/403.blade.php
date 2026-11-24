@extends('layouts.admin')

@section('title', 'Acceso denegado')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card border-0 shadow">

                <div class="card-body text-center p-5">

                    <i class="bi bi-shield-lock-fill text-danger"
                       style="font-size:80px;"></i>

                    <h2 class="fw-bold mt-4">

                        Acceso denegado

                    </h2>

                    <p class="text-muted mt-3">

                        No tienes permisos para acceder a esta sección del sistema.

                    </p>

                    <a href="{{ route('dashboard') }}"
                       class="btn btn-primary mt-3">

                        <i class="bi bi-arrow-left-circle me-2"></i>

                        Volver al Dashboard

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection