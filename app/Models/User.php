<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Creativeorange\Gravatar\Facades\Gravatar;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, HasRoles, Notifiable, SoftDeletes;

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
        'instragram',
        'linkedin',
        'avatar',
        'state',
        'password_assign_expires_at',
        'is_email',
        'password_assign_token',
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
        return $this->hasRole(['super_admin', 'admin', 'user']);
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

        if (!$country) {
            return null;
        }

        // Query country name from database using DB facade
        $countryName = DB::table('countries')
            ->where('id', $country)
            ->value('name');

        $stateName = DB::table('states')
            ->where('id', $state)
            ->value('name');

        $cityName = DB::table('cities')
            ->where('id', $city)
            ->value('name');
            
        $countryName = $countryName ?? 'País no encontrado';
        $countryName = ($countryName == 'Mexico') ? 'México' : $countryName;

        if ($country && $city) {
            return $countryName.' - '.$stateName.' - '.$cityName;
        }

        return $countryName;
    }

    public function getAvatarAttribute($avatar)
    {
        $avatar_default = asset('images/default.png');
        if ($avatar != 'default.png') {
            $avatar = asset('storage/'.$avatar);
        } else {
            $avatar = $avatar_default;
        }

        return $avatar;
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

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skills', 'user_id', 'skill_id');
    }

    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'user_interests', 'user_id', 'interests_id');
    }

    public function additional()
    {
        return $this->hasOne(Additional::class, 'user_id', 'id');
    }
}
