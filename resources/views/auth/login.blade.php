<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Acceso Administrativo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>

        body{

            background:linear-gradient(135deg,#3d434a,#212529);

            min-height:100vh;

            display:flex;

            justify-content:center;

            align-items:center;

            font-family:'Segoe UI',sans-serif;

        }

        .login-card{

            width:100%;
            max-width:480px;

            background:white;

            border-radius:22px;

            border:none;

            box-shadow:0 25px 60px rgba(0,0,0,.25);

        }

        .logo{

            width:120px;
            height:120px;

            margin:auto;

            background:#0d6efd;

            border-radius:50%;

            display:flex;

            justify-content:center;

            align-items:center;

            box-shadow:0 12px 30px rgba(13,110,253,.35);

        }

        .logo i{

            font-size:60px;

            color:white;

        }

        .form-control{

            height:50px;

            border-radius:12px;

        }

        .btn-login{

            border-radius:50px;

            height:50px;

            font-size:18px;

            font-weight:600;

        }

        a{

            text-decoration:none;

        }

    </style>

</head>

<body>

<div class="login-card">

    <div class="card-body p-5">

        <div class="text-center">

            <div class="logo">

                <i class="bi bi-person-workspace"></i>

            </div>

            <h2 class="fw-bold mt-4">

                Acceso Administrativo

            </h2>

            <p class="text-muted">

                Hotel Central La Italia

            </p>

        </div>

        @if(session('status'))

            <div class="alert alert-success">

                {{ session('status') }}

            </div>

        @endif

        <form method="POST"
              action="{{ route('login') }}">

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Correo electrónico

                </label>

                <input

                    type="email"

                    name="email"

                    value="{{ old('email') }}"

                    class="form-control"

                    required

                    autofocus

                >

                @error('email')

                    <small class="text-danger">

                        {{ $message }}

                    </small>

                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Contraseña

                </label>

                <input

                    type="password"

                    name="password"

                    class="form-control"

                    required

                >

                @error('password')

                    <small class="text-danger">

                        {{ $message }}

                    </small>

                @enderror

            </div>

            <div class="form-check mb-4">

                <input

                    class="form-check-input"

                    type="checkbox"

                    name="remember"

                    id="remember"

                >

                <label

                    class="form-check-label"

                    for="remember">

                    Recordar sesión

                </label>

            </div>

            <button

                class="btn btn-primary btn-login w-100">

                <i class="bi bi-box-arrow-in-right me-2"></i>

                Ingresar

            </button>

        </form>

        @if(Route::has('password.request'))

            <div class="text-center mt-4">

                <a href="{{ route('password.request') }}">

                    ¿Olvidó su contraseña?

                </a>

            </div>

        @endif

        <hr class="my-4">

        <div class="text-center">

            <a href="{{ route('home') }}">

                <i class="bi bi-arrow-left me-2"></i>

                Volver al portal principal

            </a>

        </div>

    </div>

</div>

</body>

</html>