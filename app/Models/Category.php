<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','created_at', 'updated_at', 'category_id'];
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
