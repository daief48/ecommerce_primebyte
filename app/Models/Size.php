<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Optional: define relationship to products
 public function products()
{
    return $this->belongsToMany(Product::class, 'product_size');
}

}
