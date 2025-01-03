<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Config;
use App\Services\ContactServices;
use Exception;

class CheckToken
{
    private $client;
    private $config;

    public function __construct()
    {
        $this->config = Config::where('id',1)->first();
        $this->client = new Client([
            'base_uri' => 'https://services.leadconnectorhq.com',
        ]);
    }

    public function handle(Request $request, Closure $next): Response
    {
        // Fetch configuration data
        $config = Config::where('id', 1)->firstOrFail();
        $contactServices = new ContactServices();
        $token = $contactServices->checkToken();

        if($token->getStatusCode() == 401){
            $this->generateToken();
        }

        return $next($request);
    }

    private function generateToken()
    {
        try {
            $response = $this->client->post('https://services.leadconnectorhq.com/oauth/token', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'client_id' => $this->config->client_id,
                    'client_secret' => $this->config->client_secret_id,
                    'grant_type' => 'refresh_token',
                    'code' => $this->config->code,
                    'refresh_token' => $this->config->refresh_token,
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            if ($statusCode === 200) {
                $responseData = json_decode($responseBody, true);

                $config = Config::where('id',1)->first();
                $config->access_token = $responseData['access_token'];
                $config->refresh_token = $responseData['refresh_token'];
                $config->save();

            } else {
                return response()->json(['error' => 'Token exchange failed'], $statusCode);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Request failed'], 500);
        }
    }
}
