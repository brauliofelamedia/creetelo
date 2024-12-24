<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use App\Models\Service;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserService;
use App\Models\UserSkill;
use App\Models\UserSocial;
use App\Services\ContactServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->with('abilities', 'services')->first();

        if ($user->services()) {
            $userServices = $user->services()->pluck('service_id')->toArray();
        } else {
            $userServices = null;
        }

        if ($user->abilities()) {
            $userSkills = $user->abilities()->pluck('skill_id')->toArray();
        } else {
            $userSkills = null;
        }

        $countries = Config::get('countries.countries');
        $services = Service::get();
        $skills = Skill::get();

        return view('front.user.index', compact('user', 'countries', 'services', 'skills', 'userServices', 'userSkills'));
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

            $social = new UserSocial;
            $social->title = $title;
            $social->icon = $title;
            $social->url = $url;
            $social->user_id = $user->id;
            $social->save();

        }

        return redirect()->back()->with('success', 'Se han actualizado las redes sociales');
    }

    public function social_delete(Request $request)
    {
        $social = UserSocial::find($request->id);
        $social->delete();

        return response()->json([
            'success' => 'El registro se eliminado correctamente',
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
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
            'last_name' => strtolower($request->last_name),
        ]);

        $newData = $request->only('name', 'last_name', 'email', 'avatar','about_me','skills','phone','website','address','country','state','city','postal_code','ocupation','company_or_venture');

        foreach ($newData as $key => $value) {
            if ($value !== $user->$key) {
                $user->$key = $value;
            }
        }

        //Custom fields
        $custom_fields = [
            [
                'id' => 'sixYg1SDbGp1Dr83ecgL',
                'value' => $request->how_vain,
            ],
            [
                'id' => 'PSO3jtCSiTYWEPXqWlEl',
                'value' => $request->skills,
            ],
            [
                'id' => 'Fm8fWY7tYe9EDr2UFzoE',
                'value' => $request->business_about,
            ],
            [
                'id' => '1PxpPNM77dNI7ROGigcn',
                'value' => $request->corporate_job,
            ],
            [
                'id' => 'Ne4Papu31MsOMVWqnUhQ',
                'value' => $request->mission,
            ],
            [
                'id' => 'GH51Vq5vHbzfrqGTOHpa',
                'value' => $request->ideal_audience,
            ],
            [
                'id' => 'IyRQeegggS20PElYpJSQ',
                'value' => $request->dont_work_with,
            ],
            [
                'id' => '07s42m66gEKrbFT6J5hP',
                'value' => $request->values,
            ],
            [
                'id' => 'C1LLobFuQR7dfdNCJhxi',
                'value' => $request->tone,
            ],
            [
                'id' => 'tZzHUsQVOZgKnteOjpBu',
                'value' => $request->looking_for_in_creelo,
            ],
            [
                'id' => 'q3BHfdxzT2uKfNO3icXG',
                'value' => $request->birthplace,
            ],
            [
                'id' => 'JuiCbkHWsSc3iKfmOBpo',
                'value' => $request->sign,
            ],
            [
                'id' => '6HdseExNUaBuLIxAyQPA',
                'value' => $request->hobbies,
            ],
            [
                'id' => 'CoYlNTkC5eumwPqo4gXM',
                'value' => $request->favorite_drink,
            ],
            [
                'id' => 'xy0zfzMRFpOdXYJkHS2c',
                'value' => $request->has_children,
            ],
            [
                'id' => '1fFJJsONHbRMQJCstvg1',
                'value' => $request->is_married,
            ],
            [
                'id' => 'iofVGERZPPqeC8FHkcgz',
                'value' => $request->favorite_trip,
            ],
            [
                'id' => 'CFCeOt6NQHr72WQIj7N2',
                'value' => $request->next_trip,
            ],
            [
                'id' => 'Kn7tmKz8ESe3HEB02w7b',
                'value' => $request->favorite_dessert,
            ],
            [
                'id' => 'aou0gq7fDscz6n8DJFyk',
                'value' => $request->favorite_food,
            ],
            [
                'id' => 'jH0uBem7yGWoCKa94CDw',
                'value' => $request->movie_recommendation,
            ],
            [
                'id' => 'rvCxO1sqFsTMoHwT98Dz',
                'value' => $request->book_recommendation,
            ],
            [
                'id' => 'HelwPSnquD5zPTRYu26H',
                'value' => $request->podcast_recommendation,
            ],
            [
                'id' => 'D1O41ZwrhZGnCkDmFE8V',
                'value' => $request->irreplaceable,
            ],
            [
                'id' => 'i3qCyUklW7qd5nHflDIg',
                'value' => $request->achievement,
            ],
            [
                'id' => 'pJgAz1qIItYg22DoR0rU',
                'value' => $request->biggest_dream,
            ],
            [
                'id' => 'd8XcWxaZcBu4erXZ56iq',
                'value' => $request->gift,
            ],
            [
                'id' => '25W5tvKnlj0BmAN4WgHs',
                'value' => $request->gift_link,
            ],
            [
                'id' => '6LQ12hAVi2eqWHyiudVg',
                'value' => $request->like_to_receive,
            ],
            [
                'id' => 'u8FAHwpq7qUJsucDxwUY',
                'value' => $request->brings_you_happiness,
            ],
        ];

        $user->additional->fill([
            'how_vain' => $request->how_vain,
            'skills' => $request->skills,
            'business_about' => $request->business_about,
            'corporate_job' => $request->corporate_job,
            'mission' => $request->mission,
            'ideal_audience' => $request->ideal_audience,
            'dont_work_with' => $request->dont_work_with,
            'values' => $request->values,
            'tone' => $request->tone,
            'looking_for_in_creelo' => $request->looking_for_in_creelo,
            'birthplace' => $request->birthplace,
            'sign' => $request->sign,
            'hobbies' => $request->hobbies,
            'favorite_drink' => $request->favorite_drink,
            'has_children' => $request->has_children,
            'is_married' => $request->is_married,
            'favorite_trip' => $request->favorite_trip,
            'next_trip' => $request->next_trip,
            'favorite_dessert' => $request->favorite_dessert,
            'favorite_food' => $request->favorite_food,
            'movie_recommendation' => $request->movie_recommendation,
            'book_recommendation' => $request->book_recommendation,
            'podcast_recommendation' => $request->podcast_recommendation,
            'irreplaceable' => $request->irreplaceable,
            'achievement' => $request->achievement,
            'biggest_dream' => $request->biggest_dream,
            'gift' => $request->gift,
            'gift_link' => $request->gift_link,
            'like_to_receive' => $request->like_to_receive,
            'brings_you_happiness' => $request->brings_you_happiness,
        ])->save();

        $request->merge([
            'custom_fields' => $custom_fields,
        ]);

        $user->save();

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('public/avatars');
            $user->avatar = $avatarPath;
            $user->save();
        }

        //Actualizamos habilidades
        if (! $request->abilities) {
            $user->abilities()->delete();
        } else {
            $currentSkills = $user->abilities->pluck('id')->toArray();
            $skillsToAdd = array_diff($request->abilities, $currentSkills);
            $skillsToRemove = array_diff($currentSkills, $request->abilities);
            $user->abilities()->whereIn('id', $skillsToRemove)->delete();

            foreach ($skillsToAdd as $skillId) {
                $skill = new UserSkill;
                $skill->user_id = $user->id;
                $skill->skill_id = $skillId;
                $skill->save();
            }
        }

        //Actualizamos servicios
        if (! $request->services) {
            $user->services()->delete();
        } else {
            if (! is_null($user->services)) {
                $currentServices = $user->services->pluck('id')->toArray();
                $servicesToAdd = array_diff($request->services, $currentServices);
                $servicesToRemove = array_diff($currentServices, $request->services);
                $user->services()->whereIn('id', $servicesToRemove)->delete();
            } else {
                foreach ($request->services as $serviceId) {
                    // Crear una nueva instancia de Service
                    $service = new UserService;
                    $service->user_id = $user->id;
                    $service->service_id = $serviceId;
                    $service->save();
                }
            }
        }

        //Actualizar campos del CRM
        $contactServices = new ContactServices;
        $contactServices->updateContact($user, $newData, $custom_fields);

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
        $contactServices = new ContactServices;
        $data = $contactServices->getContacts(null, 1);
        $total = $data['total'];
        $iteration = intval(ceil($total / 20));

        for ($i = 0; $i < $iteration; $i++) {
            $data1 = $contactServices->getContacts(null, $i + 1);
            //dd($data1);

            //Create and update users
            foreach ($data1['contacts'] as $contact) {
                $userExist = User::where('contact_id', $contact['id'])->first();

                if (! isset($userExist)) {
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

                    $additional = new Additional();
                    $additional->user_id = $user->id;
                    $additional->save();

                } else {
                    if ($userExist->email == 'braulio@felamedia.com') {
                        $userExist->contact_id = $contact['id'];
                        $userExist->name = $contact['firstNameLowerCase'];
                        $userExist->last_name = $contact['lastNameLowerCase'];
                        $userExist->postal_code = $contact['postalCode'];
                        $userExist->country = $contact['country'];
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
