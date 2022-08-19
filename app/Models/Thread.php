<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'image',
    ];

    public function participants() {
        return $this->hasMany('App\Models\Participant');
    }

    public function messages() {
        return $this->hasMany('App\Models\Message');
    }
}
