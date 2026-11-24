    <!DOCTYPE html>
    <html lang="es">

    <head>

    <meta charset="UTF-8">

    <title>Listado de Reservas</title>

    <style>

    body{

        font-family: DejaVu Sans, sans-serif;

        font-size:12px;

        color:#333;

    }

    .header{

        border-bottom:3px solid #0d6efd;

        margin-bottom:20px;

        padding-bottom:10px;

    }

    .logo{

        float:left;

        width:80px;

    }

    .info{

        margin-left:100px;

    }

    h1{

        margin:0;

        color:#0d6efd;

        font-size:24px;

    }

    small{

        color:#666;

    }

    table{

        width:100%;

        border-collapse:collapse;

        margin-top:20px;

    }

    th{

        background:#0d6efd;

        color:white;

        padding:10px;

        font-size:11px;

    }

    td{

        border:1px solid #ddd;

        padding:8px;

        font-size:11px;

    }

    tr:nth-child(even){

        background:#f8f9fa;

    }

    .badge{

        padding:4px 8px;

        border-radius:4px;

        color:white;

        font-size:10px;

    }

    .pendiente{

        background:#ffc107;

        color:black;

    }

    .activa{

        background:#198754;

    }

    .finalizada{

        background:#0d6efd;

    }

    .cancelada{

        background:#dc3545;

    }

    .footer{

        margin-top:30px;

        border-top:2px solid #ddd;

        padding-top:15px;

    }

    .resumen{

        width:300px;

        float:right;

    }

    .resumen td{

        border:none;

        padding:6px;

    }

    .text-right{

        text-align:right;

    }

    .text-center{

        text-align:center;

    }

    </style>

    </head>

    <body>

    <div class="header">

        <div class="info">

            <h1>Hotel Central La Italia</h1>

            <small>

                Sistema de Gestión Hotelera

            </small>

            <br>

            <small>

                Cartago - Valle del Cauca

            </small>

            <br><br>

            <strong>

                REPORTE GENERAL DE RESERVAS

            </strong>

            <br>

            Fecha de generación:

            {{ now()->format('d/m/Y H:i') }}

            <br>

            Generado por:

            {{ auth()->user()->nombre }}

        </div>

    </div>

    <table>

    <thead>

    <tr>

    <th>Código</th>

    <th>Huésped</th>

    <th>Documento</th>

    <th>Habitación</th>

    <th>Ingreso</th>

    <th>Salida</th>

    <th>Personas</th>

    <th>Total</th>

    <th>Estado</th>

    </tr>

    </thead>

    <tbody>

    @foreach($reservas as $reserva)

    <tr>

    <td>

    {{ $reserva->codigo_reserva }}

    </td>

    <td>

    {{ $reserva->huesped->nombres }}

    {{ $reserva->huesped->apellidos }}

    </td>

    <td>

    {{ $reserva->huesped->numero_documento }}

    </td>

    <td>

    {{ $reserva->habitacion->numero }}

    </td>

    <td>

    {{ $reserva->fecha_ingreso->format('d/m/Y') }}

    </td>

    <td>

    {{ $reserva->fecha_salida->format('d/m/Y') }}

    </td>

    <td class="text-center">

    {{ $reserva->cantidad_personas }}

    </td>

    <td class="text-right">

    $

    {{ number_format($reserva->total,0,',','.') }}

    </td>

    <td>

    @php

    $clase='pendiente';

    if($reserva->estado=='Activa') $clase='activa';

    if($reserva->estado=='Finalizada') $clase='finalizada';

    if($reserva->estado=='Cancelada') $clase='cancelada';

    @endphp

    <span class="badge {{ $clase }}">

    {{ $reserva->estado }}

    </span>

    </td>

    </tr>

    @endforeach

    </tbody>

    </table>

    <div class="footer">

    <table class="resumen">

    <tr>

    <td>

    <strong>Total reservas</strong>

    </td>

    <td class="text-right">

    {{ $reservas->count() }}

    </td>

    </tr>

    <tr>

    <td>

    <strong>Ingresos</strong>

    </td>

    <td class="text-right">

    $

    {{ number_format($totalIngresos,0,',','.') }}

    </td>

    </tr>

    </table>

    </div>

    </body>

    </html>