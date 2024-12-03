<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\UserSocial;
use Illuminate\Support\Facades\Config;
use Creativeorange\Gravatar\Facades\Gravatar;
use App\Models\UserSkill;
use App\Models\UserService;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'skills',
        'phone',
        'website',
        'address',
        'country',
        'state',
        'city',
        'postal_code',
        'ocupation',
        'company_or_venture',
        'contact_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFullNameAttribute()
    {
        if($this->last_name){
            return ucwords($this->name).' '.ucwords($this->last_name);
        } else {
            return ucwords($this->name);
        }
    }

    public function getFullUbicationAttribute()
    {
        $country = $this->country;
        $state = $this->state;
        $city = $this->city;

        //Obtener las ubicaciones
        $countries = Config::get('countries.countries');
        $countryName = $countries[$this->country] ?? 'País no encontrado';
        ($countryName == 'Mexico')? $countryName = 'México': $countryName;

        if($country && $state && $city){
            return $city.' - '.$state.' - '.$countryName;
        } elseif($country && $state) {
            return $state.' - '.$countryName;
        } else {
            return $countryName;
        }
    }

    public function getAvatarAttribute($avatar)
    {
        if($avatar != 'default.png'){
            return $avatar =  asset('storage/' . $avatar);
        } else {
           return Gravatar::fallback($avatar)->get($this->email);
        }
    }

    //Relaciones
    public function socials()
    {
        return $this->hasMany(UserSocial::class,'user_id','id');
    }

    public function services()
    {
        return $this->hasMany(UserService::class,'user_id','id');
    }

    public function abilities()
    {
        return $this->hasMany(UserSkill::class, 'user_id','id');
    }
}
