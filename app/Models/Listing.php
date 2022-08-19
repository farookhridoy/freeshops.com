<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'featured_image',
        'title',
        'slug',
        'description',
        'video_url',
        'phone',
        'email',
        'location',
        'location_lat',
        'location_long',
        'show_map',
        'availablity',
        'status',
    ];

    static public function get_single($id)
    {
        return self::find($id);
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function listing_images() {
        return $this->hasMany('App\Models\ListingImage');
    }
    public function logable()
    {
        return $this->morphMany('App\Models\LogActivity', 'logable');
    }
}
