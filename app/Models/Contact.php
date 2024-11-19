<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use App\Services\ContactServices;
use Sushi\Sushi;

class Contact extends Model
{
    use Sushi;

    public function getRows()
    {
        //GetContacts
        $contactServices = new ContactServices();
        $contacts = $contactServices->getContacts();
 
        //filtering some attributes
        $contacts = Arr::map($contacts['contacts'], function ($item) {
            return Arr::only($item,
                [
                    'id',
                    'firstName',
                    'lastName',
                    'phone',
                    'type',
                ]
            );
        });
 
        return $contacts;
    }

    protected function sushiShouldCache()
    {
        return false;
    }
}
