<?php

namespace App\Livewire;

use Filament\Pages\Auth\Login as AuthLogin;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class LoginCustom extends AuthLogin
{
    public function render(): View
    {
        return view('livewire.login-custom');
    }
}
