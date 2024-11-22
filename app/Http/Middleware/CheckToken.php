<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Config;
use App\Services\ContactServices;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Fetch configuration data
        $config = Config::where('id', 1)->firstOrFail();
        $contactServices = new ContactServices();
        $token = $contactServices->checkToken();

        if($token->status() == 401){
            try {
                // Make HTTP request to exchange token
                $response = Http::asForm()
                    ->post('https://services.leadconnectorhq.com/oauth/token', [
                        'client_id' => $config->client_id,
                        'client_secret' => $config->client_secret_id,
                        'grant_type' => 'refresh_token',
                        'refresh_token' => $config->refresh_token,
                    ]);
    
                $response->throw(); 
                $data = $response->json();
    
                return response()->json($response);
    
                $config->access_token = $data['access_token'] ?? null;
                $config->refresh_token = $data['refresh_token'] ?? null;
                $config->save();
    
            } catch (\Throwable $exception) {
                return response()->json(['error' => 'Failed to exchange token. Please try again later.'], 500);
            }
        }

        return $next($request);
    }
}
