<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MagicLinkController extends Controller
{
    public function login($token)
    {
        $user = User::where('magic_link_token', $token)
                    ->where('magic_link_expires_at', '>', Carbon::now())
                    ->first();

        if (!$user) {
            return redirect()->route('magic-link.request')
                           ->with('error', 'El enlace ha expirado o no es válido.');
        }

        $user->magic_link_token = null;
        $user->magic_link_expires_at = null;
        $user->save();

        Auth::login($user);

        return redirect('/');
    }
}
