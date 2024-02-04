<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title', 'description', 'image_path', 'category_id'];
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
