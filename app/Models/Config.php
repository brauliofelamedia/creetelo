<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Config extends Model
{
    protected $encryptable = ['password'];

    protected $fillable = [
        'logo',
        'color_primary',
        'color_secundary',
        'client_id',
        'client_secret_id',
        'code',
        'company_id',
        'location_id',
        'refresh_token',
        'access_token',
        'base_url'
    ];

    /*public function setClientIdAttribute($value)
    {
        $this->attributes['client_id'] = Crypt::encrypt($value);
    }

    public function setClientSecretIdAttribute($value)
    {
        $this->attributes['client_secret_id'] = Crypt::encrypt($value);
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = Crypt::encrypt($value);
    }

    public function setLocationIdAttribute($value)
    {
        $this->attributes['location_id'] = Crypt::encrypt($value);
    }

    public function setRefreshTokenAttribute($value)
    {
        $this->attributes['refresh_token'] = Crypt::encrypt($value);
    }

    public function setAccessTokenAttribute($value)
    {
        $this->attributes['access_token'] = Crypt::encrypt($value);
    }*/
}
