<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
    ];

    public function values()
    {
        return $this->hasMany(ProductAttributeValue::class, 'attribute_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
