<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        p {
            font-size: 12px;
        }

        .signature {
            font-style: italic;
        }
    </style>
</head>
<body>
<div>
    <a href="{{env('APP_URL')}}" target="_blank">
        <img src="{{env()->url('public/images/logo.png')}}" alt="logo" style="width:100px;">
    </a><br>
    <p>Se recibio la siguiente información:😉</p><br>
    <p>Nombre: {{ $name }}</p>
    <p>Correo electrónico: {{ $email }}</p>
    <p>Teléfono / WhatsApp: {{ $phone }}</p>
    <p>Comentarios: {{ $comments }}</p><br><br>
    <p class="signature">Créetelo</p>
</div>
</body>
</html>
