@extends('layouts.admin')

@section('title', 'Editar Reserva')

@section('content')

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                <i class="bi bi-pencil-square text-warning"></i>

                Editar Reserva

            </h2>

            <p class="text-muted mb-0">

                Modifique la información de la reserva.

            </p>

        </div>

        <a href="{{ route('reservas.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <form action="{{ route('reservas.update',$reserva) }}"
          method="POST">

        @csrf

        @method('PUT')

        @include('reservas._form')

    </form>

</div>

@endsection