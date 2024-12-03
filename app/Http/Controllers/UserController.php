<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Services\ContactServices;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\UserService;
use App\Models\UserSkill;
use App\Models\UserSocial;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user()->with('abilities','services')->first();

        if ($user->services) {
            $userServices = $user->services->pluck('service_id')->toArray();
        } else {
            $userServices = null;
        }

        if ($user->abilities) {
            $userSkills = $user->abilities->pluck('skill_id')->toArray();
        } else {
            $userSkills = null;
        }

        $countries = Config::get('countries.countries');
        $services = Service::get();
        $skills = Skill::get();
        return view('front.user.index',compact('user','countries','services','skills','userServices','userSkills'));
    }

    public function social_update(Request $request)
    {
        $redesSocialesCollection = collect($request->social);
        $urlsCollection = collect($request->url);

        $perfiles = $redesSocialesCollection->zip($urlsCollection)->map(function ($item) {
            return [$item[0] => $item[1]];
        })->collapse();

        $perfiles = $perfiles->toArray();
        $user = Auth::user();
        //Eliminamos todos los registros
        $user->socials()->delete();

        foreach ($perfiles as $title => $url) {

            $social = new UserSocial();
            $social->title = $title;
            $social->icon = $title;
            $social->url = $url;
            $social->user_id = $user->id;
            $social->save();
            
        }

        return redirect()->back()->with('success','Se han actualizado las redes sociales');
    }

    public function social_delete(Request $request)
    {
        $social = UserSocial::find($request->id);
        $social->delete();

        return response()->json([
            'success' => 'El registro se eliminado correctamente'
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_me' => 'nullable|string',
            'skills' => 'nullable|string',
            'phone' => 'nullable|string',
            'website' => 'nullable|url',
            'address' => 'nullable|string',
            'country' => 'string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'ocupation' => 'nullable|string',
            'company_or_venture' => 'nullable|string',
        ]);

        $request->merge([
            'name' => strtolower($request->name),
            'last_name' => strtolower($request->last_name)
        ]);

        $newData = $request->except('_token','_method','abilities','services');

        foreach ($newData as $key => $value) {
            if ($user->$key !== $value) {
                $user->$key = $value;
            }
        }

        $user->save();
    
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('public/avatars');
            $user->avatar = $avatarPath;
            $user->save();
        }

        //Actualizamos habilidades
        if(!$request->abilities){
            $user->abilities()->delete();
        } else {
            $currentSkills = $user->abilities->pluck('id')->toArray();
            $skillsToAdd = array_diff($request->abilities, $currentSkills);
            $skillsToRemove = array_diff($currentSkills, $request->abilities);
            $user->abilities()->whereIn('id', $skillsToRemove)->delete();

            foreach ($skillsToAdd as $skillId) {
                $skill = new UserSkill();
                $skill->user_id = $user->id;
                $skill->skill_id = $skillId;
                $skill->save();
            }
        }

        //Actualizamos servicios
        if(!$request->services){
            $user->services()->delete();
        } else {
            if(!is_null($user->services)){
                $currentServices = $user->services->pluck('id')->toArray();
                $servicesToAdd = array_diff($request->services, $currentServices);
                $servicesToRemove = array_diff($currentServices, $request->services);
                $user->services()->whereIn('id', $servicesToRemove)->delete();
            } else {
                foreach ($request->services as $serviceId) {
                    // Crear una nueva instancia de Service
                    $service = new UserService();
                    $service->user_id = $user->id;
                    $service->service_id = $serviceId;
                    $service->save();
                }
            }
        }

        //Actualizar campos del CRM
        $contactServices = new ContactServices();
        $contactServices->updateContact($user,$newData);

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function showLogin()
    {
        return view('front.user.login');
    }

    public function login(Request $request)
    {
        dd($request->all());

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['email' => 'Las credenciales son incorrectas.']);
    }

    public function syncContacts()
    {
        $contactServices = new ContactServices();
        $data = $contactServices->getContacts(null,1);
        $total = $data['total'];
        $iteration = intval(ceil($total / 20));

        for($i = 0; $i < $iteration; $i++){
            $data1 = $contactServices->getContacts(null,$i+1); 
            //dd($data1);

            //Create and update users
            foreach($data1['contacts'] as $contact){
                $userExist = User::where('contact_id',$contact['id'])->first();

                if(!isset($userExist)){
                    $user = new User();
                    $user->password = bcrypt('password');
                    $user->contact_id = $contact['id'];
                    $user->name = $contact['firstNameLowerCase'];
                    $user->last_name = $contact['lastNameLowerCase'];
                    $user->email = $contact['email'];
                    $user->postal_code = $contact['postalCode'];
                    $user->country =  $contact['country'];
                    $user->address = $contact['address'];
                    $user->website = $contact['website'];
                    $user->state = $contact['state'];
                    $user->phone = $contact['phone'];
                    $user->city = $contact['city'];
                    $user->save();

                    $user->assignRole('user');

                } else {
                    if($userExist->email == 'braulio@felamedia.com'){
                        $userExist->contact_id = $contact['id'];
                        $userExist->name = $contact['firstNameLowerCase'];
                        $userExist->last_name = $contact['lastNameLowerCase'];
                        $userExist->postal_code = $contact['postalCode'];
                        $userExist->country =  $contact['country'];
                        $userExist->address = $contact['address'];
                        $userExist->website = $contact['website'];
                        $userExist->state = $contact['state'];
                        $userExist->phone = $contact['phone'];
                        $userExist->city = $contact['city'];
                        $userExist->save();
                    }
                }
            }
        }

        
        
    }
}
