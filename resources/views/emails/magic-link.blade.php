@component('mail::message')
# Acceso a tu cuenta

Haz clic en el siguiente botón para acceder a tu cuenta:

@component('mail::button', ['url' => route('magic-link.login', $token)])
Acceder a mi cuenta
@endcomponent

Este enlace expirará en 1 hora.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
