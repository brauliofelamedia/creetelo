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
        <img src="{{asset('public/images/logo.png')}}" alt="Créetelo" style="width:250px;">
    </a><br>
    <p>Te dejamos los datos para iniciar sesión:😉</p><br>
    <p>Url de acceso: <a href="{{env('APP_URL')}}/admin/login" target="_blank">{{env('APP_URL')}}/admin/login</a></p>
    <p>Nombre: {{ $name }}</p>
    <p>Correo electrónico: {{ $email }}</p>
    <p>Contraseña: {{ $password }}</p>
    <p class="signature">Créetelo</p>
</div>
</body>
</html>
