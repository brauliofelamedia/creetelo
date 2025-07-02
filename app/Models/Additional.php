<?php

namespace App\Models;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    use LogsActivity;

    protected $fillable = [
        'how_vain',
        'skills',
        'business_about',
        'corporate_job',
        'mission',
        'ideal_audience',
        'dont_work_with',
        'values',
        'tone',
        'looking_for_in_creelo',
        'birthplace',
        'sign',
        'hobbies',
        'favorite_drink',
        'has_children',
        'is_married',
        'favorite_trip',
        'next_trip',
        'favorite_dessert',
        'favorite_food',
        'movie_recommendation',
        'book_recommendation',
        'podcast_recommendation',
        'irreplaceable',
        'achievement',
        'biggest_dream',
        'gift',
        'gift_link',
        'like_to_receive',
        'brings_you_happiness',
        'user_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
    }
}
