<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Hotel Central La Italia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>

        body{

            background:linear-gradient(135deg,#bfc3c8,#8d949b);

            min-height:100vh;

            display:flex;

            justify-content:center;

            align-items:center;

            font-family:'Segoe UI',sans-serif;

        }

        .card-home{

            border:none;

            border-radius:28px;

            background:#fff;

            box-shadow:0 25px 60px rgba(0,0,0,.18);

            transition:.35s;

        }

        .card-home:hover{

            transform:translateY(-8px);

        }

        .logo-circle{

            width:140px;

            height:140px;

            margin:auto;

            border-radius:50%;

            background:#0d6efd;

            display:flex;

            justify-content:center;

            align-items:center;

            box-shadow:0 10px 30px rgba(13,110,253,.30);

            animation:flotar 3s ease-in-out infinite;

        }

        .logo-circle i{

            font-size:70px;

            color:white;

        }

        @keyframes flotar{

            0%{transform:translateY(0);}

            50%{transform:translateY(-8px);}

            100%{transform:translateY(0);}

        }

        h1{

            font-weight:700;

            color:#343a40;

        }

        .subtitulo{

            font-size:20px;

            color:#6c757d;

        }

        hr{

            opacity:.15;

        }

        .beneficio{

            font-size:18px;

            color:#495057;

            margin-bottom:14px;

        }

        .beneficio i{

            color:#198754;

        }

        .btn-reservar{

            border-radius:50px;

            font-size:20px;

            font-weight:600;

            padding:15px;

            transition:.3s;

        }

        .btn-reservar:hover{

            transform:scale(1.02);

        }

        footer{

            color:#6c757d;

            font-size:14px;

            margin-top:35px;

        }

        .admin{

            position:fixed;

            bottom:25px;

            right:25px;

            text-decoration:none;

            color:#343a40;

            font-size:30px;

            transition:.3s;

            display:flex;

            align-items:center;

        }

        .admin span{

            opacity:0;

            margin-right:12px;

            transition:.3s;

            font-size:14px;

            font-weight:600;

        }

        .admin:hover span{

            opacity:1;

        }

        .admin:hover{

            color:#0d6efd;

            transform:scale(1.12);

        }

    </style>

</head>

<body>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card card-home">

                <div class="card-body text-center p-5">

                    <div class="logo-circle">

                        <i class="bi bi-buildings-fill"></i>

                    </div>

                    <h1 class="mt-4">

                        Hotel Central La Italia

                    </h1>

                    <p class="subtitulo">

                        Tu comodidad comienza aquí.

                    </p>

                    <hr class="my-4">

                    <div class="beneficio">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        Habitaciones cómodas

                    </div>

                    <div class="beneficio">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        Acceso a WIFI

                    </div>

                    <div class="beneficio">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        Parqueadero

                    </div>

                    <div class="mt-5">

                        <a href="{{ route('register') }}"

                           class="btn btn-primary btn-lg w-100 btn-reservar">

                            <i class="bi bi-calendar-check me-2"></i>

                            Reservar una habitación

                        </a>

                    </div>

                    <div class="mt-4">

                        <p class="mb-2">

                            ¿Ya tienes una cuenta?

                        </p>

                        <a href="{{ route('login') }}"

                           class="btn btn-outline-primary">

                            Iniciar sesión

                        </a>

                    </div>

                    <div class="mt-4">

                        <span class="text-muted">

                            ¿No tienes cuenta?

                        </span>

                        <br>

                        <a href="{{ route('register') }}"

                           class="fw-bold text-decoration-none">

                            Crear cuenta

                        </a>

                    </div>

                    <footer>

                        <hr>

                        <strong>

                            Hotel Central La Italia

                        </strong>

                        <br>

                        Cartago - Valle del Cauca

                        <br>

                        © {{ date('Y') }} Todos los derechos reservados.

                    </footer>

                </div>

            </div>

        </div>

    </div>

</div>

<a href="{{ route('login') }}"

   class="admin"

   title="Acceso administrativo">

    <span>

        Acceso administrativo

    </span>

    <i class="bi bi-person-circle"></i>

</a>

</body>

</html>