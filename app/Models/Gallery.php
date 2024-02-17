<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image_path', 'category_id', 'user_id', 'album_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class)->withTimestamps();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($gallery) {
            $gallery->user_id = Auth::id();
        });
    }
}
