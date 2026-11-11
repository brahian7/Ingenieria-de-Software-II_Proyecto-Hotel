@extends('layouts.admin')

@section('title','Dashboard')

@section('content')

<div class="container-fluid">

    {{-- Bienvenida --}}
    @include('dashboard.bienvenida')

    {{-- Estadísticas --}}
    @include('dashboard.estadisticas')

    {{-- Actividad --}}
    @include('dashboard.actividad')

    {{-- Indicadores económicos --}}
    @include('dashboard.indicadores')

    {{-- Gráficos --}}
    @include('dashboard.grafico')

    {{-- Últimas reservas --}}
    @include('dashboard.reservas')

    {{-- Acciones rápidas --}}
    @include('dashboard.accesos')

    {{-- Información --}}
    @include('dashboard.informacion')

</div>

@endsection

@include('dashboard.scripts')