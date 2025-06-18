<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id', 'name', 'price', 'unit', 'img_url'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
