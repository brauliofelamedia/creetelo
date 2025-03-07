<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Traits\HasRoles;
use Filament\Facades\Filament;

class CheckUserRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $auth = Filament::auth();
        $user = $auth->user();

        $currentUrl = URL::current();
        $explode = explode('/', $currentUrl);

        return $next($request);
    }
}
