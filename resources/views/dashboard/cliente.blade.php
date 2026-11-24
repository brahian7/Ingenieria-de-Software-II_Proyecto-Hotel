@extends('layouts.cliente')

@section('title', 'Portal del Cliente')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0">

                <div class="card-body text-center p-5">

                    <i class="bi bi-person-circle text-primary"
                       style="font-size:70px;"></i>

                    <h2 class="mt-3">

                        Bienvenido

                        {{ Auth::user()->nombre }}

                    </h2>

                    <p class="text-muted">

                        Desde aquí podrás administrar tus reservas.

                    </p>

                    <hr>

                    <div class="d-grid gap-3">

                        <a href="{{ route('cliente.reservar') }}"
                           class="btn btn-primary btn-lg">

                            <i class="bi bi-calendar-plus me-2"></i>

                            Reservar Habitación

                        </a>

                        <a href="{{ route('cliente.reservas') }}"
                           class="btn btn-outline-secondary btn-lg">

                            <i class="bi bi-calendar-check me-2"></i>

                            Mis Reservas

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection