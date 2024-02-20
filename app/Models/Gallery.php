<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Auth;

class Gallery extends Model
{
    protected $fillable = ['title', 'description', 'image_path', 'category_id', 'user_id', 'album_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likesCount()
    {
        return $this->likes()->count();
    }
    public function isLikedBy($user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($gallery) {
            $gallery->user_id = Auth::id();
        });
    }
}
