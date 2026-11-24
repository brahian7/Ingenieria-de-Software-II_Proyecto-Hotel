<x-guest-layout>

<style>

@keyframes aparecer{

    from{

        opacity:0;

        transform:translateY(40px);

    }

    to{

        opacity:1;

        transform:translateY(0);

    }

}

.registro-card{

    animation:aparecer .8s ease;

}

.btn-primary{

    background:#3E5C76;

    border-color:#3E5C76;

    transition:.3s;

}

.btn-primary:hover{

    background:#2F4858;

    border-color:#2F4858;

    transform:translateY(-2px);

}

.icono-principal{

    width:90px;

    height:90px;

    background:#3E5C76;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    margin:auto;

    margin-bottom:20px;

    box-shadow:0 10px 30px rgba(62,92,118,.30);

}

.input-group .btn{

    border-left:none;

}

.form-control:focus{

    box-shadow:none;

    border-color:#3E5C76;

}

</style>

<div class="registro-card">

<div class="text-center mb-5">

    <div class="icono-principal">

        <i class="bi bi-person-plus-fill text-white fs-1"></i>

    </div>

    <h2 class="fw-bold">

        Crear cuenta

    </h2>

    <p class="text-muted">

        Regístrate para comenzar a reservar habitaciones.

    </p>

</div>

<form method="POST"
      action="{{ route('register') }}">

    @csrf

    <div class="row">

        <div class="col-md-6 mb-4">

            <label class="form-label fw-semibold">

                Nombre

            </label>

            <input
                type="text"
                name="nombre"
                class="form-control"
                placeholder="Ingresa tu nombre"
                value="{{ old('nombre') }}"
                required>

            <x-input-error
                :messages="$errors->get('nombre')"
                class="mt-2"/>

        </div>

        <div class="col-md-6 mb-4">

            <label class="form-label fw-semibold">

                Apellido

            </label>

            <input
                type="text"
                name="apellido"
                class="form-control"
                placeholder="Ingresa tu apellido"
                value="{{ old('apellido') }}"
                required>

            <x-input-error
                :messages="$errors->get('apellido')"
                class="mt-2"/>

        </div>

    </div>

    <div class="mb-4">

        <label class="form-label fw-semibold">

            Correo electrónico

        </label>

        <input
            type="email"
            name="email"
            class="form-control"
            placeholder="ejemplo@correo.com"
            value="{{ old('email') }}"
            required>

        <x-input-error
            :messages="$errors->get('email')"
            class="mt-2"/>

    </div>

    <div class="row">

        <div class="col-md-6 mb-4">

            <label class="form-label fw-semibold">

                Contraseña

            </label>

            <div class="input-group">

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Mínimo 8 caracteres"
                    required>

                <button
                    class="btn btn-outline-secondary"
                    type="button"
                    onclick="togglePassword('password',this)">

                    <i class="bi bi-eye"></i>

                </button>

            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"/>

        </div>

        <div class="col-md-6 mb-4">

            <label class="form-label fw-semibold">

                Confirmar contraseña

            </label>

            <div class="input-group">

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Repite tu contraseña"
                    required>

                <button
                    class="btn btn-outline-secondary"
                    type="button"
                    onclick="togglePassword('password_confirmation',this)">

                    <i class="bi bi-eye"></i>

                </button>

            </div>

        </div>

    </div>

    <div class="alert alert-light border rounded-4">

        <h6 class="fw-bold mb-3">

            <i class="bi bi-stars text-warning me-2"></i>

            Beneficios de crear una cuenta

        </h6>

        <ul class="mb-0">

            <li>Reserva habitaciones en pocos minutos.</li>

            <li>Consulta el historial de tus reservas.</li>

            <li>Cancela reservas fácilmente.</li>

            <li>Proceso 100% seguro.</li>

        </ul>

    </div>

    <div class="d-grid mt-4">

        <button class="btn btn-primary btn-lg">

            <i class="bi bi-person-check-fill me-2"></i>

            Crear mi cuenta

        </button>

    </div>

    <div class="text-center mt-4">

        ¿Ya tienes una cuenta?

        <a
            href="{{ route('login') }}"
            class="fw-bold text-decoration-none"
            style="color:#3E5C76;">

            Inicia sesión

        </a>

    </div>

</form>

</div>

<script>

function togglePassword(id, boton){

    let input=document.getElementById(id);

    let icono=boton.querySelector("i");

    if(input.type==="password"){

        input.type="text";

        icono.classList.remove("bi-eye");

        icono.classList.add("bi-eye-slash");

    }else{

        input.type="password";

        icono.classList.remove("bi-eye-slash");

        icono.classList.add("bi-eye");

    }

}

</script>

</x-guest-layout>