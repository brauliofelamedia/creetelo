<?php

namespace App\Http\Controllers;
use App\Services\ContactServices;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->name;

        if($name){
            $contactServices = new ContactServices();
            $data = $contactServices->searchContact($name);
        } else {
            $contactServices = new ContactServices();
            $data = $contactServices->getContacts();
        }

        return view('front.home', compact('data','name'));
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
}
