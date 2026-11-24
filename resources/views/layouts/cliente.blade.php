<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    {{-- Flatpickr --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">

    <div class="container">

        <a class="navbar-brand fw-bold"
           href="{{ route('dashboard') }}">

            <i class="bi bi-building-fill me-2"></i>

            Hotel Central La Italia

        </a>

        <div class="ms-auto d-flex align-items-center">

            <span class="text-white me-3">

                {{ Auth::user()->nombre }}

            </span>

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button class="btn btn-outline-light">

                    <i class="bi bi-box-arrow-right"></i>

                    Cerrar sesión

                </button>

            </form>

        </div>

    </div>

</nav>

<div class="container py-5">

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

{{-- Flatpickr --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

{{-- Mensajes de éxito --}}
@if(session('success'))

<script>

Swal.fire({

    icon: 'success',

    title: '¡Excelente!',

    text: "{{ session('success') }}",

    confirmButtonColor: '#198754'

});

</script>

@endif

{{-- Mensajes de error --}}
@if(session('error'))

<script>

Swal.fire({

    icon: 'error',

    title: 'Ha ocurrido un problema',

    text: "{{ session('error') }}",

    confirmButtonColor: '#dc3545'

});

</script>

@endif

{{-- Confirmación para cancelar reserva --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.formulario-eliminar').forEach(function(formulario){

        formulario.addEventListener('submit', function(e){

            e.preventDefault();

            Swal.fire({

                title: '¿Cancelar reserva?',

                text: 'La reserva será cancelada y la habitación volverá a estar disponible.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc3545',

                cancelButtonColor: '#6c757d',

                confirmButtonText: 'Sí, cancelar',

                cancelButtonText: 'No'

            }).then((result)=>{

                if(result.isConfirmed){

                    formulario.submit();

                }

            });

        });

    });

});

</script>

@stack('scripts')

</body>
</html>