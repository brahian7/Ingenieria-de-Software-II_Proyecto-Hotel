@extends('layouts.admin')

@section('title', 'Nueva Reserva')

@section('content')

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                <i class="bi bi-calendar-plus-fill text-primary"></i>

                Nueva Reserva

            </h2>

            <p class="text-muted mb-0">

                Registre una nueva reserva para un huésped.

            </p>

        </div>

        <a href="{{ route('reservas.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <form action="{{ route('reservas.store') }}"
          method="POST">

        @csrf

        @include('reservas._form')

    </form>

</div>

@endsection