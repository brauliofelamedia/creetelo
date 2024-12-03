<?php

namespace App\Http\Controllers;

use App\Mail\SendContactMail;
use App\Models\Lead;
use App\Services\ContactServices;
use Illuminate\Http\Request;
use Creativeorange\Gravatar\Facades\Gravatar;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $page = $request->query('page');

        $contactServices = new ContactServices();

        if($name){
            $data = $contactServices->getContacts($name,$page);
        } else {
            $data = $contactServices->getContacts(null,$page);
        }

        //Inyectamos mas valores de la base
        foreach($data['contacts'] as &$contact){
            
            $user = User::where('contact_id',$contact['id'])->first();
            if(!$user){
                $newUser = $this->addNewUser($contact);
                $contact['avatar'] = $newUser->avatar;
            } else {
                $contact['avatar'] = $user->avatar;
                $contact['socials'] = $user->socials()->pluck('title','url')->toArray();
            }
        }

        $jsonString = json_encode($data);
        $data = json_decode($jsonString, true);

        return view('front.home', compact('data','name','page'));
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

        return $user;
    }

    public function contact_detail($id)
    {
        $contactServices = new ContactServices();

        //Información del candidato
        $user = User::where('contact_id',$id)->first();

        //Otros candidatos
        $otherUsers = User::where('contact_id', '!=', $id)->inRandomOrder()->limit(6)->get();
        
        return view('front.contact.detail', compact('user','otherUsers'));
    }

    public function send_email(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'phone' => 'nullable|string|max:20',
            'comments' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
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
        Mail::to()->send(new SendContactMail($lead));

        return redirect()->back()->with('success', 'Se ha enviado tu solicitud');
    }
}
