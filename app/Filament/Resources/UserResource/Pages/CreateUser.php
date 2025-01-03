<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterUser;
use Filament\Notifications\Notification;
class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $user = $this->record;

        //Generamos la contraseña
        $password = Str::random(10);
        $user->password = bcrypt($password);
        $user->save();

        //Enviamos el correo de bienvenida
        Mail::to($user->email)->send(new RegisterUser($user, $password));
        Notification::make()
            ->title('Se ha enviado correctamente el correo de bienvenida')
            ->success()
            ->send();
    }

}
