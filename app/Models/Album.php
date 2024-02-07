<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];
    use HasFactory;
// Album.php
public function galleries()
{
    return $this->belongsToMany(Gallery::class);
}

        public function user()
        {
            return $this->belongsTo(User::class);
        }

}
