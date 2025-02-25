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

class FrontController extends Controller
{
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

        //dd($users);

        return view('front.home', compact('search', 'users','skillSelect', 'interests' , 'citySelect','signSelect','interestSelect','skills','childrenSelect', 'cities'));
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

        return view('front.contact.detail', compact('user', 'otherUsers'));
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
            
                $user = new User();
                $user->name = $request->first_name;
                $user->last_name = (isset($request->last_name))? $request->last_name : '';
                $user->email = $request->email;
                $user->slug = Str::slug($user->fullname);
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
    
                return response()->json([
                    'message' => 'Se ha generado enlace para asignar la contraseña.',
                    'url' => $assignLink
                ]);
                
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
        
        $user = User::where('password_assign_token', $token)
                    ->where('password_assign_expires_at', '>', Carbon::now())
                    ->first();

        return view('front.user.assign-password',compact('user'));
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
}
