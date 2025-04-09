<?php

namespace App\Models;
use App\Models\Interest;
use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model
{
    protected $fillable = ['user_id', 'interests_id'];
    
    public function interest()
    {
        return $this->hasOne(Interest::class, 'id', 'interest_id');
    }
}
