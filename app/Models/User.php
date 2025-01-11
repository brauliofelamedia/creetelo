<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Creativeorange\Gravatar\Facades\Gravatar;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Traits\HasRoles;
use Filament\Panel;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;
class User extends Authenticatable implements FilamentUser
{

    use HasFactory, HasRoles, Notifiable;

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
        'contact_id',
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

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(['super_admin','admin','user']);
    }

    public function getFullNameAttribute()
    {
        if ($this->last_name) {
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
        ($countryName == 'Mexico') ? $countryName = 'México' : $countryName;

        if ($country && $city) {
            return $countryName.' - '.$city;
        } else {
            return $countryName;
        }
    }

    public function getAvatarAttribute($avatar)
    {
        $avatar_default = asset('images/default.png');
        if($avatar != 'default.png'){
            $avatar = asset('storage/'.$avatar);
        } else {
            $avatar = $avatar_default;
        }

        return Gravatar::fallback($avatar)->get($this->email,['size'=>400]);
    }

    public function getRoleAttribute()
    {
        $role = $this->roles->first();
        return $role->name;
    }

    //Relaciones
    public function socials()
    {
        return $this->hasMany(UserSocial::class, 'user_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(UserService::class, 'user_id', 'id');
    }

    public function abilities()
    {
        return $this->hasMany(UserSkill::class, 'user_id', 'id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id', 'id');
    }

    public function additional()
    {
        return $this->hasOne(Additional::class, 'user_id', 'id');
    }

}
