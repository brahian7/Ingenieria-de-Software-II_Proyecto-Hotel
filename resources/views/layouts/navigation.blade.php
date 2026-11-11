<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">

    <div class="container-fluid">

        {{-- Logo del hotel --}}
        <a class="navbar-brand fw-bold d-flex align-items-center"
           href="{{ route('dashboard') }}">

            <i class="bi bi-building-fill fs-3 me-2 text-warning"></i>

            Hotel Central La Italia

        </a>

        <div class="d-flex align-items-center ms-auto">

            {{-- Volver al dashboard --}}
            <a href="{{ route('dashboard') }}"
               class="btn btn-outline-light me-3">

                <i class="bi bi-arrow-left-circle me-2"></i>

                Dashboard

            </a>

            {{-- Usuario --}}
            <span class="text-white me-3">

                <i class="bi bi-person-circle me-1"></i>

                {{ Auth::user()->nombre }}

                {{ Auth::user()->apellido }}

            </span>

            {{-- Perfil --}}
            <a href="{{ route('profile.edit') }}"
               class="btn btn-outline-info me-2">

                <i class="bi bi-person-gear me-1"></i>

                Mi Perfil

            </a>

            {{-- Cerrar sesión --}}
            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button class="btn btn-danger">

                    <i class="bi bi-box-arrow-right me-1"></i>

                    Salir

                </button>

            </form>

        </div>

    </div>

</nav>