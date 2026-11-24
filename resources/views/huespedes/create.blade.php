@extends('layouts.admin')

@section('title', 'Registrar Huésped')

@section('content')

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                <i class="bi bi-person-plus-fill text-primary"></i>

                Registrar Huésped

            </h2>

            <p class="text-muted mb-0">

                Complete la información del huésped.

            </p>

        </div>

        <a href="{{ route('huespedes.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <form
        action="{{ route('huespedes.store') }}"
        method="POST">

        @csrf

        @include('huespedes._form')

    </form>

</div>

@endsection