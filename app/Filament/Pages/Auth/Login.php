<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Component;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Forms\Components\Actions\Action;
use Filament\Actions\StaticAction;
use Illuminate\Contracts\View\View;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\CodeLink;
use \Filament\Forms\Components\Actions;
use Filament\Forms\Get;

class Login extends BaseLogin
{
    public function form(Form $form): Form
    {
        return $form
            ->extraAttributes(['class' => 'login-form-container'])
            ->schema([
                $this->getLoginFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
                Actions::make([])
                    ->fullWidth()
                    ->actions($this->getFooterButtons()),
            ]);
    }

    protected function getLoginFormComponent(): Component 
    {
        return TextInput::make('email')
            ->label('Correo electrónico')
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    public function getTitle(): string | Htmlable
    {
        return 'Inicia sesión';
    }

    protected function getFooterButtons(): array
    {
        return [
            Action::make('request-code')
            ->label('Acceder con link mágico')
            ->icon('heroicon-o-envelope')
            ->button()
            ->color('gray')
            ->modalWidth('sm')
            ->modalHeading('Solicitar acceso con link mágico')
            ->modalDescription('Se enviará un enlace mágico a tu bandeja de correo. Tendrás 5 minutos para iniciar sesión antes de que caduque.')
            ->modalSubmitAction(fn (StaticAction $action) => $action->label('Solicitar código'))
            ->modalCancelAction(fn (StaticAction $action) => $action->label('Cancelar'))
            ->extraAttributes([
                'class' => 'magic-link-button',
                'tabindex' => 3
            ])
            ->form([
                TextInput::make('email')
                    ->label('Correo electrónico')
                    ->email()
                    ->required()
            ])
            ->action(function (array $data) {
            $user = User::where('email', $data['email'])->first();
            
            if (!$user) {
                Notification::make()
                    ->title('El correo electrónico no existe')
                    ->danger()
                    ->send();
                return;
            }

            // Generate and store verification code
            $code = hash('sha256', random_bytes(32));

            try {
                // Send email with code
                Mail::to($user->email)->send(new CodeLink($code));

                // Update user only after successful email sending
                $user->magic_link_token = $code;
                $user->magic_link_expires_at = now()->addMinutes(5);
                $user->save();

            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error al enviar el correo')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                return;
            }
            
            Notification::make()
                ->title('Se ha enviado un correo con el link mágico, revisa tu bandeja / spam.')
                ->info()
                ->send();
            }),
        ];
    }

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }
}