<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_post_id',
        'name',
        'email',
        'comment',
        'status'
    ];

    public function blog_post() {
        return $this->belongsTo("App\Models\BlogPost");
    }
}
