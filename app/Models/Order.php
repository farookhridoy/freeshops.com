<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'transaction_id',
        'listing_id',
        'amount',
        'status',
    ];

    public function transaction() {
        return $this->belongsTo('App\Models\Transaction');
    }

    public function listing() {
        return $this->belongsTo('App\Models\Listing');
    }

    public function logable()
    {
        return $this->morphMany('App\Models\LogActivity', 'logable');
    }
}
