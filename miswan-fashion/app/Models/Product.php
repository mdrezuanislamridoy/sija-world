<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'name',
        'slug',
        'sku',
        'price',
        'previous_price',
        'discount_percent',
        'stock',
        'short_description',
        'description',
        'thumbnail',
        'colors',
        'video_link',
        'is_featured',
        'is_bestseller',
        'is_hot',
        'is_new',
        'status',
        'views',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class)->where('status', 1);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper: calculate discount percentage automatically if not set
    public function getDiscountPercentAttribute($value)
    {
        if ($value > 0) return $value;
        if ($this->previous_price && $this->previous_price > $this->price) {
            return round((($this->previous_price - $this->price) / $this->previous_price) * 100);
        }
        return 0;
    }
}
