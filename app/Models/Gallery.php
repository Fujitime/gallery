<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth; // Import Auth untuk mengakses informasi pengguna saat ini

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image_path', 'category_id', 'user_id']; // Tambahkan 'user_id' ke fillable

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

    // Fungsi untuk menyimpan ID pengguna saat ini ke dalam kolom user_id
    public static function boot()
    {
        parent::boot();

        static::creating(function ($gallery) {
            $gallery->user_id = Auth::id(); // Assign the current user's ID when creating a new gallery
        });
    }
}
