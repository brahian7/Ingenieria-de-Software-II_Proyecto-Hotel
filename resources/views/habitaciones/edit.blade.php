@extends('layouts.admin')

@section('content')

<div class="container">

    <h2 class="mb-4">

        Editar Habitación

    </h2>

    <form
        action="{{ route('habitaciones.update',$habitacion) }}"
        method="POST">

        @csrf
        @method('PUT')

        @include('habitaciones._form')

    </form>

</div>

@endsection