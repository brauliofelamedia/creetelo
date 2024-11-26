<?php

namespace App\Http\Controllers;

use App\Mail\SendContactMail;
use App\Services\ContactServices;
use Illuminate\Http\Request;
use Creativeorange\Gravatar\Facades\Gravatar;
class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        $jsonString = json_encode($data);
        $data = json_decode($jsonString, true);

        return view('front.home', compact('data','name','page'));
    }

    public function about()
    {
        return view('front.about');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function account_create()
    {
        echo 'hola';
    }

    public function paginate($page)
    {

    }

    public function contact_detail($id)
    {
        $contactServices = new ContactServices();

        //Información del candidato
        $contact = $contactServices->getContact($id);
        $contact = $contact['contact'];

        //Otros candidatos
        $contacts = $contactServices->getContacts();
        $otherContacts = collect($contacts['contacts'])->random(6);
        
        return view('front.contact.detail', compact('contact','otherContacts'));
    }

    public function send_email(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'services' => 'required',
            'comments' => 'required',
        ]);

        // Datos del correo
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'services' => $request->services,
            'comments' => $request->comments,
        ];

        // Envío del correo
        Mail::to()->send(new SendContactMail($data));

        return redirect()->back()->with('success', 'Mensaje enviado correctamente.');
    }
}
