<nav class="navbar navbar-expand-lg navbar-dark shadow" style="background-color:#0F4C81;">

    <div class="container-fluid">

        {{-- Logo del sistema --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">

            <i class="bi bi-building-fill me-2 fs-4"></i>

            <div>

                <div class="fw-bold fs-5">
                    Hotel Central La Italia
                </div>

                <small class="text-white-50">
                    Sistema de Gestión Hotelera
                </small>

            </div>

        </a>

        {{-- Usuario --}}
        <div class="dropdown">

            <button class="btn btn-outline-light dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown">

                <i class="bi bi-person-circle me-1"></i>

                {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}

            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow">

                <li class="px-3 py-2">

                    <strong>

                        {{ Auth::user()->nombre }}
                        {{ Auth::user()->apellido }}

                    </strong>

                    <br>

                    <small class="text-muted">

                        {{ Auth::user()->rol }}

                    </small>

                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>

                    <a class="dropdown-item"
                       href="{{ route('profile.edit') }}">

                        <i class="bi bi-person me-2"></i>

                        Mi perfil

                    </a>

                </li>

                <li>

                    <hr class="dropdown-divider">

                </li>

                <li>

                    <form action="{{ route('logout') }}"
                          method="POST">

                        @csrf

                        <button type="submit"
                                class="dropdown-item text-danger">

                            <i class="bi bi-box-arrow-right me-2"></i>

                            Cerrar sesión

                        </button>

                    </form>

                </li>

            </ul>

        </div>

    </div>

</nav>
