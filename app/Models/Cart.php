<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'listing_id',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function listing() {
        return $this->belongsTo('App\Models\Listing');
    }
    public function logable()
    {
        return $this->morphMany('App\Models\LogActivity', 'logable');
    }
}
