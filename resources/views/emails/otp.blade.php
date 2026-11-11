<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
</head>

<body style="font-family: Arial, Helvetica, sans-serif; background:#f5f5f5; padding:30px;">

    <div style="max-width:600px;margin:auto;background:white;padding:30px;border-radius:10px;">

        <h2 style="color:#0d6efd;">
            Hotel Central
        </h2>

        <p>
            Hola,
        </p>

        <p>
            Tu código de verificación es:
        </p>

        <h1 style="
            text-align:center;
            letter-spacing:8px;
            color:#0d6efd;
            font-size:42px;">
            {{ $codigo }}
        </h1>

        <p>
            Este código expirará en <strong>10 minutos</strong>.
        </p>

        <hr>

        <small style="color:gray;">
            Si no solicitaste este código puedes ignorar este correo.
        </small>

    </div>

</body>

</html>