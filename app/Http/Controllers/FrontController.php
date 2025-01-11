<?php

namespace App\Http\Controllers;

use App\Mail\SendContactMail;
use App\Models\Additional;
use App\Models\Lead;
use App\Services\ContactServices;
use Illuminate\Http\Request;
use Creativeorange\Gravatar\Facades\Gravatar;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $order = $request->order ?? 'desc';

        $users = User::query();

        if ($request->has('search')) {
            $users->where('name', 'like', '%' . $request->search . '%');
            $users->orWhere('last_name', 'like', '%' . $request->search . '%');

            $users->orWhereHas('abilities.skill', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        $users = $users->orderBy('created_at', $order);
        $users = $users->paginate(20);

        return view('front.home', compact('search','users','order'));
    }

    public function addNewUser($contact)
    {
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

        $additional = new Additional();
        $additional->user_id = $user->id;
        $additional->save();

        return $user;
    }

    public function contact_detail($slug)
    {
        $user = User::where('slug',$slug)->with('abilities')->first();
        $otherUsers = User::where('slug', '!=', $slug)->inRandomOrder()->limit(6)->get();
        return view('front.contact.detail', compact('user','otherUsers'));
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

        $lead = new Lead();
        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->phone = $request->phone;
        $lead->comments = $request->comments;
        $lead->user_id = $request->user_id;
        $lead->save();

        // Envío del correo
        if($user->email){
            Mail::to($user->email)->send(new SendContactMail($lead));
        }

        return redirect()->back()->with('success', 'Se ha enviado correctamente tu solicitud');
    }
}
