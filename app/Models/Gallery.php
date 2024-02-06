<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title', 'description', 'image_path', 'category_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
