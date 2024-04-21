<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'cover_image',
        'status',
    ];
    use HasFactory;

    public function galleries()
    {
        return $this->belongsToMany(Gallery::class)->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
        public function coverImage()
    {
        return $this->belongsTo(Gallery::class, 'cover_image');
    }

}
