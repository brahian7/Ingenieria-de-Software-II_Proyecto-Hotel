<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Reserva Confirmada</title>

</head>

<body style="margin:0;padding:0;background:#f5f7fb;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f7fb;padding:40px 0;">

<tr>

<td align="center">

<table width="650" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:15px;overflow:hidden;box-shadow:0 5px 15px rgba(0,0,0,.08);">

<tr>

<td style="background:#0d6efd;padding:30px;text-align:center;">

<h1 style="color:white;margin:0;">

🏨 Hotel Central La Italia

</h1>

<p style="color:#dce8ff;margin-top:8px;">

Confirmación de Reserva

</p>

</td>

</tr>

<tr>

<td style="padding:35px;">

<h2 style="color:#0d6efd;">

Hola {{ $reserva->huesped->nombres }}

{{ $reserva->huesped->apellidos }}

</h2>

<p style="font-size:16px;color:#555;line-height:28px;">

Su reserva ha sido registrada exitosamente.

A continuación encontrará toda la información.

</p>

<hr>

<table width="100%" cellpadding="8">

<tr>

<td><strong>Código de Reserva</strong></td>

<td>{{ $reserva->codigo_reserva }}</td>

</tr>

<tr>

<td><strong>Habitación</strong></td>

<td>

{{ $reserva->habitacion->numero }}

-

{{ $reserva->habitacion->tipo }}

</td>

</tr>

<tr>

<td><strong>Check In</strong></td>

<td>

{{ $reserva->fecha_ingreso->format('d/m/Y') }}

</td>

</tr>

<tr>

<td><strong>Check Out</strong></td>

<td>

{{ $reserva->fecha_salida->format('d/m/Y') }}

</td>

</tr>

<tr>

<td><strong>Personas</strong></td>

<td>

{{ $reserva->cantidad_personas }}

</td>

</tr>

<tr>

<td><strong>Total</strong></td>

<td style="color:green;font-weight:bold;">

$

{{ number_format($reserva->total,0,',','.') }}

</td>

</tr>

</table>

<br>

<div style="background:#f8f9fa;padding:20px;border-left:5px solid #0d6efd;border-radius:10px;">

<strong>Información del Hotel</strong>

<br><br>

📍 Cartago - Valle del Cauca

<br>

🏨 Hotel Central La Italia

<br>

📧 hotelcentrallaitalia@gmail.com

</div>

<br>

<p style="font-size:15px;color:#666;line-height:28px;">

Gracias por elegirnos.

Será un gusto atenderlo.

</p>

<div style="text-align:center;margin-top:35px;">

<a href="{{ url('/') }}"

style="background:#0d6efd;color:white;text-decoration:none;padding:14px 28px;border-radius:8px;display:inline-block;">

Visitar nuestro sitio

</a>

</div>

</td>

</tr>

<tr>

<td style="background:#f1f3f5;padding:20px;text-align:center;font-size:13px;color:#777;">

© {{ date('Y') }}

Hotel Central La Italia

<br>

Todos los derechos reservados.

</td>

</tr>

</table>

</td>

</tr>

</table>

</body>

</html>