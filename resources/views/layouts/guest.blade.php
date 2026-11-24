<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Hotel Central La Italia')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>

        body{

            min-height:100vh;

            background:linear-gradient(135deg,#0d6efd,#1d4ed8);

            display:flex;

            justify-content:center;

            align-items:center;

            padding:40px;

        }

        .login-card{

            border:none;

            border-radius:25px;

            overflow:hidden;

            box-shadow:0 25px 60px rgba(0,0,0,.20);

        }

        .left-panel{

            background:white;

            padding:60px;

        }

        .right-panel{

            background:linear-gradient(135deg,#0d6efd,#2563eb);

            color:white;

            padding:60px;

        }

        .hotel-icon{

            width:90px;

            height:90px;

            background:white;

            color:#0d6efd;

            border-radius:20px;

            display:flex;

            justify-content:center;

            align-items:center;

            font-size:45px;

            margin-bottom:25px;

        }

        .form-control{

            border-radius:12px;

            padding:12px;

        }

        .btn-primary{

            border-radius:12px;

            padding:12px;

            font-weight:bold;

        }

        .feature{

            margin-bottom:15px;

            font-size:17px;

        }

    </style>

</head>

<body>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-xl-10">

            <div class="card login-card">

                <div class="row g-0">

                    <div class="col-lg-6 left-panel">

                        {{ $slot }}

                    </div>

                    <div class="col-lg-6 right-panel d-flex flex-column justify-content-center">

                        <div class="hotel-icon">

                            <i class="bi bi-building-fill"></i>

                        </div>

                        <h2 class="fw-bold">

                            Hotel Central La Italia

                        </h2>

                        <p class="opacity-75 mb-5">

                            Sistema de Gestión Hotelera

                        </p>

                        <div class="feature">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            Reserva habitaciones completamente en línea.

                        </div>

                        <div class="feature">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            Consulta el estado de tus reservas.

                        </div>

                        <div class="feature">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            Cancela reservas cuando lo necesites.

                        </div>

                        <div class="feature">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            Información protegida y segura.

                        </div>

                        <div class="mt-5">

                            <i class="bi bi-geo-alt-fill me-2"></i>

                            Cartago, Valle del Cauca

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>