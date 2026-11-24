<div class="col-md-2 d-none d-md-block bg-dark text-white min-vh-100 p-0">

    <div class="p-3">

        {{-- Encabezado --}}
        <div class="text-center mb-4">

            <i class="bi bi-building-fill fs-1 text-warning"></i>

            <h5 class="mt-2 mb-1">

                Hotel Central

            </h5>

            <small class="text-light opacity-75">

                {{ Auth::user()->rol }}

            </small>

        </div>

        <div class="list-group shadow-sm">

            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
               class="list-group-item list-group-item-action">

                <i class="bi bi-speedometer2 me-2"></i>

                Dashboard

            </a>

            {{-- Solo Administrador --}}
            @if(Auth::user()->rol == 'Administrador')

                <a href="{{ route('habitaciones.index') }}"
                   class="list-group-item list-group-item-action">

                    <i class="bi bi-door-open-fill me-2"></i>

                    Habitaciones

                </a>

            @endif

            {{-- Administrador y Recepcionista --}}
            <a href="{{ route('huespedes.index') }}"
               class="list-group-item list-group-item-action">

                <i class="bi bi-people-fill me-2"></i>

                Huéspedes

            </a>

            <a href="{{ route('reservas.index') }}"
               class="list-group-item list-group-item-action">

                <i class="bi bi-calendar-check-fill me-2"></i>

                Reservas

            </a>

            {{-- Perfil --}}
            <a href="{{ route('profile.edit') }}"
               class="list-group-item list-group-item-action">

                <i class="bi bi-person-circle me-2"></i>

                Mi Perfil

            </a>

            {{--
            ==========================================================
            MÓDULO DE USUARIOS
            Descomentar este bloque cuando se implemente el CRUD
            ==========================================================

            @if(Auth::user()->rol == 'Administrador')

                <a href="{{ route('usuarios.index') }}"
                   class="list-group-item list-group-item-action">

                    <i class="bi bi-person-gear me-2"></i>

                    Usuarios

                </a>

            @endif

            --}}

        </div>

    </div>

</div>