<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'banner',
        'icon',
        'description',
        'priority',
        'is_featured',
        'status',
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class)->where('status', 1)->orderBy('priority', 'asc');
    }

    public function products()
    {
        return $this->hasMany(Product::class)->where('status', 1);
    }
}
