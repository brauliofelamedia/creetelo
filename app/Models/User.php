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
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, HasRoles, Notifiable, SoftDeletes, LogsActivity;

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
        'status',
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

     public function getActivitylogOptions(): LogOptions
     {
        return LogOptions::defaults()->logOnly($this->fillable);
     }

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
        $countryName = Country::where('iso2', $this->country)->value('name');
        $countryName = $countryName ?? 'País no encontrado';

        if ($country && $city) {
            return $countryName.' - '.$this->state.' - '.$this->city;
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

    public function getCompleteProfileAttribute(){
        //42 campos

        $fields = [
            'name','last_name', 'email', 'about_me', 'whatsapp', 'website', 'address', 
            'country', 'state', 'city', 'postal_code', 'ocupation', 
            'company_or_venture'
        ];

        $additional_fields = [
            'how_vain', 'business_about', 'corporate_job', 'mission', 'ideal_audience',
            'dont_work_with', 'values', 'tone', 'looking_for_in_creelo', 'birthplace',
            'sign', 'hobbies', 'favorite_drink', 'has_children', 'is_married',
            'favorite_trip', 'next_trip', 'favorite_dessert', 'favorite_food',
            'movie_recommendation', 'book_recommendation', 'podcast_recommendation',
            'irreplaceable', 'achievement', 'biggest_dream', 'gift', 'gift_link',
            'like_to_receive', 'brings_you_happiness'
        ];

        $filled_count = 0;
        $total_fields = count($fields) + count($additional_fields);

        foreach ($fields as $field) {
            if (!empty($this->$field)) {
            $filled_count++;
            }
        }

        if ($this->additional) {
            foreach ($additional_fields as $field) {
            if (!empty($this->additional->$field)) {
                $filled_count++;
            }
            }
        }

        $percentage = ($filled_count / $total_fields) * 100;

        if ($percentage >= 55) {
            return 'complete';
        } elseif ($percentage >= 15) {
            return 'in_process';
        } else {
            return 'incomplete';
        }
    }

    public function getCountryAttribute($value)
    {
        return $value ?? 'US';
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

    public function interest()
    {
        return $this->hasMany(UserInterest::class, 'user_id', 'id');
    }

    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'user_interests', 'user_id', 'interests_id');
    }

    public function additional()
    {
        return $this->hasOne(Additional::class, 'user_id', 'id');
    }

    public static function getTotalCompleteProfiles()
    {
        $users = self::where('status', 1)->get();
        return $users->filter(function($user) {
            return $user->complete_profile === 'complete';
        })->count();
    }

    public static function getTotalIncompleteProfiles()
    {
        $users = self::where('status', 1)->get();
        return $users->filter(function($user) {
            return $user->complete_profile === 'incomplete';
        })->count();
    }

    public static function getTotalProcessProfiles()
    {
        $users = self::where('status', 1)->get();
        return $users->filter(function($user) {
            return $user->complete_profile === 'in_process';
        })->count();
    }
}
