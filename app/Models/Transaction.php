<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method',
        'payment_id',
        'narration',
        'amount',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function orders() {
        return $this->hasMany('App\Models\Order');
    }
}
