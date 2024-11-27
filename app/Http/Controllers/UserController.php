<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Services\ContactServices;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $countries = Config::get('countries.countries');
        return view('front.user.index',compact('user','countries'));
    }

    public function save(Request $request)
    {
        dd($request->all());
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

                if(!$userExist){
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
                    $userExist->assignRole('user');
                }
            }
        }

        
        
    }
}
