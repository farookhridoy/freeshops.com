<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SyncsWithFirebase;


class Message extends Model
{
    use HasFactory;
    use SyncsWithFirebase;

    protected $table = "messages";

    protected $fillable = [
        'thread_id',
        'user_id',
        'type',
        'body',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function thread() {
        return $this->belongsTo('App\Models\Thread');
    }
}
