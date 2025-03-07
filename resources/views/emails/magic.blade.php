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

        a {
            color: #9200a5;
            text-decoration: none;
            padding:5px 15px;
            display: inline-block;
            color:white;
        }
    </style>
</head>
<body>
<div>
    <a href="{{env('APP_URL')}}" target="_blank">
        <img src="{{asset('public/images/logo.png')}}" alt="Créetelo" style="width:250px;">
    </a><br>
    <p>Te dejamos el link de acceso de un solo uso: 😉</p><br>
    <p><a href="{{env('APP_URL')}}/magic-login/{{$code}}" target="_blank">Iniciar sesión ahora</a></p>
    <p class="signature">Créetelo</p>
</div>
</body>
</html>
