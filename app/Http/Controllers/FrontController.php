<?php

namespace App\Http\Controllers;
use App\Services\ContactServices;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactServices = new ContactServices();
        $contacts = $contactServices->getContacts();
        $contacts = $contacts['contacts'];
        return view('front.home', compact('contacts'));
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
        $contact = $contactServices->getContact($id);
        $contact = $contact['contact'];
        return view('front.contact.detail', compact('contact'));
    }
}
