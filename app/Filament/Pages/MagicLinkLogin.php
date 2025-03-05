<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\MagicLinkLogin as MagicLinkMail;

class MagicLinkLogin extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $title = 'Acceso con Magic Link';
    protected static ?string $slug = 'magic-link-request';
    
    // Permitir acceso sin autenticación
    protected static string $layout = 'filament-panels::components.layout.simple';
    
    protected function getLayoutData(): array
    {
        return [
            'title' => 'Acceso con Magic Link',
        ];
    }
    
    public ?array $data = [];
    
    public function mount(): void
    {
        /*if (auth()->check()) {
            redirect()->intended('/');
        }*/
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Correo electrónico')
                    ->email()
                    ->required()
                    ->exists('users', 'email')
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function sendMagicLink(): void
    {
        $user = User::where('email', $this->data['email'])->first();
        
        $token = Str::random(60);
        $user->magic_link_token = $token;
        $user->magic_link_expires_at = Carbon::now()->addHours(1);
        $user->save();

        Mail::to($user->email)->send(new MagicLinkMail($token));

        Notification::make()
            ->success()
            ->title('Enlace enviado')
            ->body('Revisa tu correo electrónico para acceder.')
            ->send();
    }
}
