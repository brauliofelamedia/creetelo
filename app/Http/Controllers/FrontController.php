<?php

namespace App\Http\Controllers;

use App\Mail\SendContactMail;
use App\Models\Additional;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Skill;
use App\Models\Interest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Nnjeim\World\World;
use Illuminate\Support\Facades\DB;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\State;

class FrontController extends Controller
{
    protected $webhookUrl = 'https://services.leadconnectorhq.com/hooks/4z3IHPMw9JB3Qkz8ttK8/webhook-trigger/4630879d-a8a5-47ab-bf76-ef3af9975685';

    public function index(Request $request)
    {
        $search = $request->search;
        $skillSelect = $request->skillSelect;
        $citySelect = $request->citySelect;
        $childrenSelect = $request->childrenSelect;
        $signSelect = $request->signSelect;
        $interestSelect = $request->interestSelect;
        
        $skills = Skill::all();
        $interests = Interest::all();

        $cities = User::whereNotNull('city')
                      ->distinct()
                      ->orderBy('city', 'asc')
                      ->pluck('city')
                      ->toArray();

        $cityNames = [];
        $citiesFinal = [];

        //dd($cities); 72118 Tepic
        $citiesFinal = City::whereIn('name', $cities)->pluck('id','name')->toArray();

        $query = User::query();

        if ($search && $search != '*') {
            $query->where('name', 'like', '%' . $search . '%');
        }

        //Skills
        if ($interestSelect && $interestSelect != '*') {
            $query->whereHas('interests', function ($q) use ($interestSelect) {
                $q->where('interests.id', $interestSelect);
            });
        }

        if ($skillSelect && $skillSelect != '*') {
            $query->whereHas('skills', function ($q) use ($skillSelect) {
                $q->where('skills.id', $skillSelect);
            });
        }

        if ($citySelect && $citySelect != '*') {
            $query->where('city', $citySelect);
        }

        if ($signSelect && $signSelect != '*') {
            $query->whereHas('additional', function ($q) use ($signSelect) {
                $q->where('sign', $signSelect);
            });
        }

        // Filtrar por la relación additional->children
        if ($childrenSelect && $childrenSelect != '*') {
            $query->whereHas('additional', function ($q) use ($childrenSelect) {
                $q->where('has_children', $childrenSelect);
            });
        }
        
        $query->orderBy('created_at', 'desc');
        $users = $query->with('additional')->paginate(20);

        $countriesMap = Country::all()->pluck('name','iso2')->toArray();

        return view('front.home', compact('search', 'users','skillSelect', 'interests' ,'countriesMap' , 'citySelect','signSelect','interestSelect','skills','childrenSelect', 'citiesFinal'));
    }

    public function changeCountry()
    {
        $users = User::all();
        foreach($users as $user){
            $country = Country::where('id', $user->country)->first();
            $state = State::where('id', $user->state)->first();
            $city = City::where('id', $user->city)->first();

            $user->country = $country ? $country->iso2 : null;
            $user->state = $state ? $state->name : null;
            $user->city = $city ? $city->name : null;
            $user->save();
        }
    }

    public function addNewUser($contact)
    {
        $user = new User;
        $user->password = bcrypt('password');
        $user->contact_id = $contact['id'];
        $user->name = $contact['firstNameLowerCase'];
        $user->last_name = $contact['lastNameLowerCase'];
        $user->email = $contact['email'];
        $user->postal_code = $contact['postalCode'];
        $user->country = $contact['country'];
        $user->address = $contact['address'];
        $user->website = $contact['website'];
        $user->state = $contact['state'];
        $user->phone = $contact['phone'];
        $user->city = $contact['city'];
        $user->save();
        $user->assignRole('user');

        $additional = new Additional;
        $additional->user_id = $user->id;
        $additional->save();

        return $user;
    }

    public function contact_detail($slug)
    {
        $user = User::where('slug', $slug)->with('abilities')->first();
        $otherUsers = User::where('slug', '!=', $slug)->where('country', $user->country)->inRandomOrder()->limit(6)->get();

        $countriesMap = DB::table('countries')
            ->select('id', 'iso2')
            ->get()
            ->pluck('iso2', 'id')
            ->toArray();

        return view('front.contact.detail', compact('user', 'otherUsers','countriesMap'));
    }

    public function send_email(Request $request)
    {
        $user = User::find($request->user_id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'phone' => 'nullable|string|max:20',
            'comments' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $lead = new Lead;
        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->phone = $request->phone;
        $lead->comments = $request->comments;
        $lead->user_id = $request->user_id;
        $lead->save();

        // Envío del correo
        if ($user->email) {
            Mail::to($user->email)->send(new SendContactMail($lead));
        }

        return redirect()->back()->with('success', 'Se ha enviado correctamente tu solicitud');
    }

    public function create_user_weebhook(Request $request)
    {
        $token = Str::random(60);
        $expiresAt = Carbon::now()->addHours(72);
        $userExist = User::where('email',$request->email)->first();

        if(!$userExist){
            try {
                $fullName = $request->name . ' ' . $request->last_name . '-' . rand(1000,9999);

                $user = new User();
                $user->name = $request->first_name;
                $user->last_name = (isset($request->last_name))? $request->last_name : '';
                $user->email = $request->email;
                $user->slug = Str::slug($fullName);
                $user->password = bcrypt('2O6o&:_5IT55b(L}Z');
                $user->password_assign_token = $token;
                $user->password_assign_expires_at = $expiresAt;
                $user->contact_id = $request->contact_id;
                $user->assignRole('user');
                $user->save();

                $additional = new Additional();
                $additional->user_id = $user->id;
                $additional->save();
    
                //Generar el link
                $assignLink = route('front.assign_password',$token);

                //Enviar a Webhook
                try {
                    $data = [
                        'url' => $assignLink,
                        'contact_id' => $user->contact_id,
                        'email' => $user->email,
                    ];
                    
                    // Enviar datos al webhook
                    $response = Http::post($this->webhookUrl, $data);
                    
                    // Verificar respuesta
                    if ($response->successful()) {
                        return response()->json([
                            'success' => true,
                            'data' => $response->body(),
                            'message' => 'Datos enviados exitosamente al webhook'
                        ]);
                    } else {                        
                        return response()->json([
                            'success' => false,
                            'message' => 'Error al enviar datos al webhook',
                            'error' => $response->body()
                        ], 500);
                    }
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error interno al procesar la solicitud',
                        'error' => $e->getMessage()
                    ], 500);
                }
                
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Ocurrió un error en el servidor.',
                    'message' => $e->getMessage(),
                ], 500);
            }
        } else {
            return response()->json([
                'message' => 'El usuario ya tiene una cuenta asignada.'
            ]);
        }
    }

    public function assign_password($token)
    {
        $user = User::where('password_assign_token', $token)->first();

        if (!$user) {
            session()->flash('filament.notifications', [
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'danger',
                    'title' => 'El token es invalido',
                    'body' => 'Te invitamos a solicitar un correo de recuperación en el formulario inferior.',
                    'actions' => [],
                    'duration' => 12000,
                ]
            ]);
            
            return redirect()->route('filament.admin.auth.password-reset.request');
        }

        if (Carbon::parse($user->password_assign_expires_at)->isPast()) {

            $tokenNew = Str::random(60);
            $expiresAt = Carbon::now()->addHours(72);

            $user->password_assign_token = $tokenNew;
            $user->password_assign_expires_at = $expiresAt;
            $user->save();

            return redirect()->route('front.assign_password', $tokenNew);
        } else {
            return view('front.user.assign-password', compact('user'));
        }
    
    }

    public function assign_save(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
            'repeat_password' => 'required|string|same:password',
        ]);

         // Encriptar la nueva contraseña
         $user = User::where('password_assign_token',$request->token)->first();

         $user->password = Hash::make($request->password);
         $user->password_assign_token = '';
         $user->password_assign_expires_at = NULL;
         $user->save();
 
         // Iniciar sesión automáticamente con los datos del usuario
         Auth::login($user);

         return redirect()->route('dashboard.account.index')->with(['message'=>'Se ha creado correctamente la contraseña.']);
    }

    //Magic login
    public function magic()
    {
        return view('front.magic');
    }

    public function magic_generate(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user){
            $code = hash('sha256', random_bytes(32));

            // Send Weebhook data
            $link = config('app.url') . '/magic/login/code/' . $code;
            
            $response = Http::post('https://services.leadconnectorhq.com/hooks/4z3IHPMw9JB3Qkz8ttK8/webhook-trigger/151b0486-284b-47a7-9ca6-3672458eb0be', [
                'link' => $link,
                'email' => $request->email
            ]);

            if (!$response->successful()) {
                throw new \Exception('Failed to send webhook');
            }

            // Update user only after successful email sending
            $user->magic_link_token = $code;
            $user->magic_link_expires_at = now()->addMinutes(5);
            $user->save();

            return redirect()->route('front.magic')->with('success', 'Se ha enviado un enlace mágico a tu correo.');
            
        } else {
            return redirect()->route('front.magic')->with('error', 'El correo no concuerda con nuestros registros');
        }
    }

    public function login_code($code)
    {
        $user = User::where('magic_link_token', $code)
            ->where('magic_link_expires_at', '>=', now())
            ->first();

        if (!$user) {
            return redirect()->route('front.magic')->with('error', 'El enlace ha expirado o es inválido, solicita uno nuevo');
        }

        Auth::login($user);
        $user->magic_link_token = null;
        $user->magic_link_expires_at = null;
        $user->save();
        
        return redirect()->route('dashboard.account.index');
    }
}
