<x-guest-layout>

    <div class="text-center mb-5">

        <h1 class="fw-bold mb-4">
            Verificación de seguridad
        </h1>

        <p class="fs-5 text-secondary mb-2">
            Hemos enviado un código de verificación a tu correo electrónico.
        </p>

        <p class="fs-5 text-secondary mb-1">
            Hemos enviado un código de verificación a
        </p>

        <p class="fw-bold text-primary fs-5 mb-3">

            <i class="bi bi-envelope-fill me-2"></i>

            {{ $correo }}

        </p>

        <h2
            id="contadorOtp"
            class="fw-bold text-danger mb-4"
        >
            10:00
        </h2>

    </div>

    @if(session('status'))

        <div class="alert alert-success text-center">

            {{ session('status') }}

        </div>

    @endif

    <form
        method="POST"
        action="{{ route('otp.store') }}"
    >

        @csrf

        <div class="mb-4">

            <label
                for="codigo"
                class="form-label fw-semibold fs-5"
            >
                Código OTP
            </label>

            <input
                id="codigo"
                name="codigo"
                type="text"
                maxlength="6"
                autofocus
                required
                class="form-control form-control-lg text-center"
                style="
                    letter-spacing:12px;
                    font-size:28px;
                    font-weight:bold;
                "
            >

            @error('codigo')

                <div class="text-danger mt-2">

                    {{ $message }}

                </div>

            @enderror

        </div>

        <button
            id="btnVerificar"
            type="submit"
            class="btn btn-primary w-100 py-3 fs-5 fw-bold shadow"
        >

            <i class="bi bi-shield-check me-2"></i>

            Verificar código

        </button>

    </form>

    <div class="text-center mt-4">

        <p class="text-secondary mb-3">

            Podrás solicitar otro código en

            <span
                id="contadorReenvio"
                class="fw-bold text-danger"
            >
                01:00
            </span>

        </p>

        <form
            method="POST"
            action="{{ route('otp.resend') }}"
        >

            @csrf

            <button
                id="btnReenviar"
                type="submit"
                class="btn btn-outline-primary px-4"
                disabled
            >

                <i class="bi bi-arrow-repeat me-2"></i>

                Reenviar código

            </button>

        </form>

    </div>

    <script>

        const expiracion = {{ $expiraEn }} * 1000;

        const creado = {{ $creadoEn }} * 1000;

        const contadorOtp = document.getElementById('contadorOtp');

        const contadorReenvio = document.getElementById('contadorReenvio');

        const btnVerificar = document.getElementById('btnVerificar');

        const btnReenviar = document.getElementById('btnReenviar');

        function actualizarTemporizadores(){

            const ahora = new Date().getTime();

            /*
            |--------------------------------------------------------------------------
            | OTP (10 minutos)
            |--------------------------------------------------------------------------
            */

            let restanteOtp = expiracion - ahora;

            if(restanteOtp <= 0){

                contadorOtp.innerHTML = "00:00";

                btnVerificar.disabled = true;

                btnVerificar.classList.remove("btn-primary");

                btnVerificar.classList.add("btn-secondary");

                btnVerificar.innerHTML =
                    '<i class="bi bi-clock-history me-2"></i>Código expirado';

            }else{

                let minutos = Math.floor(restanteOtp / 60000);

                let segundos = Math.floor((restanteOtp % 60000)/1000);

                contadorOtp.innerHTML =
                    String(minutos).padStart(2,'0')
                    + ":"
                    + String(segundos).padStart(2,'0');

            }

            /*
            |--------------------------------------------------------------------------
            | Reenvío (60 segundos)
            |--------------------------------------------------------------------------
            */

            let restanteReenvio = 60000 - (ahora - creado);

            if(restanteReenvio <= 0){

                contadorReenvio.innerHTML = "00:00";

                btnReenviar.disabled = false;

            }else{

                let minutos = Math.floor(restanteReenvio / 60000);

                let segundos = Math.floor((restanteReenvio % 60000)/1000);

                contadorReenvio.innerHTML =
                    String(minutos).padStart(2,'0')
                    + ":"
                    + String(segundos).padStart(2,'0');

            }

        }

        actualizarTemporizadores();

        setInterval(actualizarTemporizadores,1000);

    </script>

</x-guest-layout>