<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_post_id',
        'name',
    ];

    public function blog_post() {
        return $this->belongsTo("App\Models\BlogPost");
    }
}
