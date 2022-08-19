<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_category_id',
        'user_id',
        'featured_image',
        'title',
        'slug',
        'body',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function blog_category() {
        return $this->belongsTo("App\Models\BlogCategory");
    }

    public function user() {
        return $this->belongsTo("App\Models\User");
    }

    public function blog_tags() {
        return $this->hasMany("App\Models\BlogTag");
    }

    public function blog_comments() {
        return $this->hasMany("App\Models\BlogComment");
    }
}
