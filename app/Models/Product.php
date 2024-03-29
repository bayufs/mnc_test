<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'categories_id', 'id');
    }
}
