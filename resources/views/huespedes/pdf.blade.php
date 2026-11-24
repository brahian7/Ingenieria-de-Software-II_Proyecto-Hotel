<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Listado de Huéspedes</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
            color:#333;
        }

        h1,h2,h3,p{
            margin:0;
        }

        .encabezado{
            text-align:center;
            border-bottom:2px solid #0d6efd;
            padding-bottom:15px;
            margin-bottom:20px;
        }

        .titulo{
            font-size:22px;
            font-weight:bold;
            color:#0d6efd;
        }

        .subtitulo{
            color:#666;
            margin-top:5px;
        }

        .info{
            margin-top:15px;
            margin-bottom:20px;
        }

        .info td{
            padding:4px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{

            background:#0d6efd;
            color:white;
            padding:8px;
            border:1px solid #ccc;
        }

        td{

            padding:7px;
            border:1px solid #ddd;
        }

        tr:nth-child(even){

            background:#f7f7f7;

        }

        .footer{

            margin-top:25px;

            text-align:center;

            color:#777;

            font-size:10px;

        }

        .badge{

            display:inline-block;

            padding:4px 10px;

            background:#198754;

            color:white;

            border-radius:5px;

            font-size:11px;

        }

    </style>

</head>

<body>

<div class="encabezado">

    <div class="titulo">

        HOTEL CENTRAL

    </div>

    <div class="subtitulo">

        Sistema de Gestión Hotelera

    </div>

    <br>

    <h2>

        REPORTE DE HUÉSPEDES

    </h2>

</div>

<table class="info">

    <tr>

        <td>

            <strong>Fecha de generación:</strong>

            {{ now()->format('d/m/Y H:i') }}

        </td>

        <td align="right">

            <strong>Total huéspedes:</strong>

            {{ $huespedes->count() }}

        </td>

    </tr>

    <tr>

        <td colspan="2">

            @if(
                $filtros['buscar'] ||
                $filtros['ciudad'] ||
                $filtros['documento'] ||
                $filtros['correo']
            )

                <span class="badge">

                    Reporte filtrado

                </span>

            @else

                <span class="badge">

                    Reporte general

                </span>

            @endif

        </td>

    </tr>

</table>

<table>

    <thead>

    <tr>

        <th>Documento</th>

        <th>Nombre Completo</th>

        <th>Teléfono</th>

        <th>Correo</th>

        <th>Ciudad</th>

    </tr>

    </thead>

    <tbody>

    @forelse($huespedes as $huesped)

        <tr>

            <td>

                {{ $huesped->numero_documento }}

            </td>

            <td>

                {{ $huesped->nombres }}

                {{ $huesped->apellidos }}

            </td>

            <td>

                {{ $huesped->telefono }}

            </td>

            <td>

                {{ $huesped->correo ?? 'No registra' }}

            </td>

            <td>

                {{ $huesped->ciudad ?? 'No registra' }}

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="5" align="center">

                No existen huéspedes.

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

<div class="footer">

    Hotel Central © {{ date('Y') }}

    <br>

    Documento generado automáticamente por el Sistema de Gestión Hotelera.

</div>

</body>

</html>