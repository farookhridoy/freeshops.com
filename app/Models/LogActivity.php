<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function logable()
    {
        return $this->morphTo();
    }

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }
    public function listing()
    {
        return $this->belongsTo('App\Models\Listing');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
    public function favourite()
    {
        return $this->belongsTo('App\Models\Favourite');
    }
}
