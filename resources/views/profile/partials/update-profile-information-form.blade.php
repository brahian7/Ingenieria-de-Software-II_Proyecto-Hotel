<section>

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold">

                <i class="bi bi-person-fill me-2 text-primary"></i>

                Información Personal

            </h3>

            <p class="text-muted mb-0">

                Actualiza la información de tu perfil.

            </p>

        </div>

    </div>

    <form method="POST"
          action="{{ route('profile.update') }}">

        @csrf

        @method('PATCH')

        <div class="row">

            {{-- Nombre --}}

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Nombre

                </label>

                <input
                    type="text"
                    name="nombre"
                    class="form-control"
                    value="{{ old('nombre', $user->nombre) }}"
                    required>

                @error('nombre')

                    <div class="text-danger mt-1">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            {{-- Apellido --}}

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Apellido

                </label>

                <input
                    type="text"
                    name="apellido"
                    class="form-control"
                    value="{{ old('apellido', $user->apellido) }}"
                    required>

                @error('apellido')

                    <div class="text-danger mt-1">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            {{-- Email --}}

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Correo electrónico

                </label>

                <input
                    type="email"
                    class="form-control bg-light"
                    value="{{ $user->email }}"
                    readonly>

                <small class="text-muted">

                    El correo es utilizado para iniciar sesión y no puede modificarse.

                </small>

            </div>

            {{-- Rol --}}

            <div class="col-md-3 mb-3">

                <label class="form-label fw-semibold">

                    Rol

                </label>

                <input
                    type="text"
                    class="form-control bg-light"
                    value="{{ $user->rol }}"
                    readonly>

            </div>

            {{-- Estado --}}

            <div class="col-md-3 mb-3">

                <label class="form-label fw-semibold">

                    Estado

                </label>

                <input
                    type="text"
                    class="form-control bg-light"
                    value="{{ $user->estado ? 'Activo' : 'Inactivo' }}"
                    readonly>

            </div>

        </div>

        <div class="mt-4">

            <button
                class="btn btn-primary btn-lg">

                <i class="bi bi-floppy me-2"></i>

                Guardar cambios

            </button>

        </div>

    </form>

</section>