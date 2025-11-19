<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'sub_category_id',
        'brand_id',
        'size_id', // Add this
        'price',
        'compare_price',
        'sku',
        'track_qty',
        'qty',
        'is_featured',
        'description',
        'short_description',
        'shipping_returns',
        'related_products',
        'barcode',
    ];

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productRatings()
    {
        return $this->hasMany(ProductRating::class)->where('status', 1);
    }

    // Add this relationship
public function sizes()
{
    return $this->belongsToMany(Size::class, 'product_size');
}

}
