<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if($user){
            if ($user->hasRole('admin')) {
                return redirect()->route('filament.pages.dashboard');
            }
        
            if ($user->hasRole('user')) {
                return redirect('dashboard.account.index');
            }    
        }
        
        //return abort(403, 'Acceso denegado.');
        return $next($request);
    }
}
