<section>

    <div class="mb-4">

        <h3 class="fw-bold">

            <i class="bi bi-shield-lock-fill text-success me-2"></i>

            Seguridad

        </h3>

        <p class="text-muted mb-0">

            Cambia tu contraseña para mantener tu cuenta protegida.

        </p>

    </div>

    <form method="POST"
          action="{{ route('password.update') }}">

        @csrf

        @method('PUT')

        <div class="row">

            <div class="col-12 mb-3">

                <label class="form-label fw-semibold">

                    Contraseña actual

                </label>

                <input
                    type="password"
                    name="current_password"
                    class="form-control"
                    required>

                @error('current_password','updatePassword')

                    <div class="text-danger mt-1">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Nueva contraseña

                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>

                @error('password','updatePassword')

                    <div class="text-danger mt-1">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Confirmar contraseña

                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    required>

            </div>

        </div>

        <button
            class="btn btn-success">

            <i class="bi bi-key-fill me-2"></i>

            Actualizar contraseña

        </button>

    </form>

</section>