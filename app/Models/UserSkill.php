<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    protected $table = 'user_skills';

    protected $fillable = [
        'user_id',
        'skill_id',
    ];

    public function skill()
    {
        return $this->hasOne(Skill::class,'id','skill_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skills', 'skill_id', 'user_id');
    }
}
