<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'thread_id',
        'user_id',
        'muted',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function thread() {
        return $this->belongsTo('App\Models\Thread');
    }
}
