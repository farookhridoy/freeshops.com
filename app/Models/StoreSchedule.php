<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'day',
        'is_closed',
        'is_24',
        'opening_time',
        'closing_time',
    ];

    public function store() {
        return $this->belongsTo('App\Models\Store');
    }
}
