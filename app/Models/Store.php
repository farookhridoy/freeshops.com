<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'logo',
        'banner',
        'name',
        'slug',
        'tagline',
        'email',
        'phone',
        'website',
        'location',
        'location_lat',
        'location_long',
        'description',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'youtube',
        'status',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function store_schedules() {
        return $this->hasMany('App\Models\StoreSchedule');
    }
}
