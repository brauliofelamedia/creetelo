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
use Illuminate\Support\Facades\Config;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $skillSelect = $request->skillSelect;
        $citySelect = $request->citySelect;
        $countrySelect = $request->countrySelect;
        $stateSelect = $request->stateSelect;
        $childrenSelect = $request->childrenSelect;
        $signSelect = $request->signSelect;

        $skills = Skill::all();
        $cities = User::select('city')->whereNotNull('city')->where('city', '!=', '')->distinct()->get();
        $states = User::select('state')->whereNotNull('state')->where('state', '!=', '')->distinct()->get();
        $countries = Config::get('countries.countries');

        $query = User::query();

        if ($search && $search != '*') {
            $query->where('name', 'like', '%' . $search . '%');
        }

        //Skills
        if ($skillSelect && $skillSelect != '*') {
            $query->whereHas('skills', function ($q) use ($skillSelect) {
                $q->where('skills.id', $skillSelect);
            });
        }

        if ($countrySelect && $countrySelect != '*') {
            $query->where('country', $countrySelect);
        }

        if ($stateSelect && $stateSelect != '*') {
            $query->where('state', $stateSelect);
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

        return view('front.home', compact('search', 'users', 'skillSelect', 'citySelect', 'stateSelect','signSelect','countrySelect','skills','childrenSelect', 'cities','states','countries'));
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
}
