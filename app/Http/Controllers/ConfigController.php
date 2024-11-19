<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Contact;
use App\Services\ContactServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class ConfigController extends Controller
{
    /*public function callback(Request $request)
    {
        $config = Config::where('id',1)->first();
        $config->code = Crypt::encrypt($request->code);
        $config->save();
    
        return redirect()->route('filament.admin.resources.configs.edit',1)->with('message','Se ha registrado correctamente el código de acceso.');
    }*/

    public function finish()
    {
        $contactServices = new ContactServices();
        $users = $contactServices->getContacts();
        return 'Se termino la configuración';
    }

    public function webhook(Request $request)
    {
        return $request->all();
    }

    public function connect()
    {
        $config = Config::where('id',1)->first();
        $client_id = $config->client_id;
        if($client_id){
            $url = "https://marketplace.leadconnectorhq.com/oauth/chooselocation?response_type=code&redirect_uri=https://creetelo.local/admin/configs/authorization&client_id=".$client_id."&scope=contacts.readonly&loginWindowOpenMode=self";
            return redirect()->away($url);
        } else {
            echo 'No se ha asignado el client_id';
        }
    }

    public function getAuthorizationCode(Request $request)
    {
        $config = Config::where('id',1)->first();
        $config->code = $request->code;
        $config->save();

        try {
            $response = Http::asForm()->post('https://services.leadconnectorhq.com/oauth/token', [
                'client_id' => $config->client_id,
                'client_secret' => $config->client_secret_id,
                'grant_type' => 'authorization_code',
                'code' => $request->code,
                //'redirect_uri' => route('config.finish'),
                'user_type' => 'Company'
            ]);

            $response->throw();
            $data = $response->json();

            // Handle successful response and return access token
            $config->access_token =$data['access_token'];
            $config->refresh_token = $data['refresh_token'];
            $config->company_id = $data['companyId']; 
            $config->location_id = $data['locationId'];
            $config->save();

            return redirect()->route('config.finish');

        } catch (\Throwable $exception) {
            Log::error('Error exchanging authorization code:', [$exception->getMessage()]);
            return $exception->getMessage();
            return response()->json(['error' => 'Error exchanging code'], 500);
        }
    }
}
