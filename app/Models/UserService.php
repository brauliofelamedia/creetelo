<?php

namespace App\Models;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
    protected $table = 'user_services';

    protected $fillable = [
        'user_id',
        'service_id',
    ];

    public function service()
    {
        return $this->hasOne(Service::class,'id','service_id');
    }
}
