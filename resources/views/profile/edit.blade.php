@extends('layouts.app')

@section('title','Mi Perfil')

@section('content')

<style>

.profile-avatar{

    width:170px;
    height:170px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;

    font-size:60px;
    font-weight:bold;

    color:white;

    border:6px solid white;

    box-shadow:0 15px 35px rgba(0,0,0,.18);

    animation:avatar .8s ease;

    transition:.3s;

}

.profile-avatar:hover{

    transform:scale(1.05);

}

.avatar-admin{

    background:linear-gradient(135deg,#2563eb,#60a5fa);

}

.avatar-recep{

    background:linear-gradient(135deg,#16a34a,#4ade80);

}

.avatar-cliente{

    background:linear-gradient(135deg,#374151,#9ca3af);

}

.card-profile{

    border-radius:20px;

}

.info-box{

    background:#f8f9fa;

    border-radius:15px;

    padding:15px;

    margin-bottom:15px;

    transition:.3s;

}

.info-box:hover{

    background:#eef3ff;

}

@keyframes avatar{

    from{

        opacity:0;

        transform:scale(.75);

    }

    to{

        opacity:1;

        transform:scale(1);

    }

}

</style>

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow border-0 card-profile">

                <div class="card-body p-5">

                    <div class="row">

                        {{-- ========================= --}}
                        {{-- Avatar --}}
                        {{-- ========================= --}}

                        <div class="col-lg-4 text-center border-end">

                            @php

                                $avatar = match($user->rol){

                                    'Administrador' => 'avatar-admin',

                                    'Recepcionista' => 'avatar-recep',

                                    default => 'avatar-cliente'

                                };

                            @endphp

                            <div class="profile-avatar {{ $avatar }}">

                                {{ strtoupper(substr($user->nombre,0,1)) }}

                                {{ strtoupper(substr($user->apellido,0,1)) }}

                            </div>

                            <h2 class="fw-bold mt-4 mb-1">

                                {{ $user->nombre }}

                                {{ $user->apellido }}

                            </h2>

                            <p class="text-muted mb-3">

                                {{ $user->email }}

                            </p>

                            <span class="badge px-4 py-2 fs-6 {{ $user->rol == 'Administrador' ? 'bg-primary' : ($user->rol == 'Recepcionista' ? 'bg-success' : 'bg-dark') }}">

                                <i class="bi bi-person-badge-fill me-2"></i>

                                {{ $user->rol }}

                            </span>

                            <div class="mt-3">

                                @if($user->estado)

                                    <span class="badge bg-success px-3 py-2">

                                        <i class="bi bi-check-circle-fill me-1"></i>

                                        Cuenta Activa

                                    </span>

                                @else

                                    <span class="badge bg-danger px-3 py-2">

                                        <i class="bi bi-x-circle-fill me-1"></i>

                                        Cuenta Inactiva

                                    </span>

                                @endif

                            </div>

                            <hr class="my-4">

                            <div class="info-box text-start">

                                <i class="bi bi-calendar-event-fill text-primary me-2"></i>

                                <strong>

                                    Miembro desde

                                </strong>

                                <br>

                                <span class="text-muted">

                                    {{ $user->created_at->format('d/m/Y') }}

                                </span>

                            </div>

                            <div class="info-box text-start">

                                <i class="bi bi-clock-history text-success me-2"></i>

                                <strong>

                                    Último acceso

                                </strong>

                                <br>

                                <span class="text-muted">

                                    {{ now()->format('d/m/Y H:i') }}

                                </span>

                            </div>

                            <div class="info-box text-start">

                                <i class="bi bi-shield-check text-warning me-2"></i>

                                <strong>

                                    Seguridad

                                </strong>

                                <br>

                                <span class="text-muted">

                                    Tu cuenta está protegida.

                                </span>

                            </div>

                        </div>

                        {{-- ========================= --}}
                        {{-- Formularios --}}
                        {{-- ========================= --}}

                        <div class="col-lg-8">

                            @include('profile.partials.update-profile-information-form')

                            <hr class="my-5">

                            @include('profile.partials.update-password-form')

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection