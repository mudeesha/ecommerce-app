<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image', 'price', 'category', 'quantity'
    ];

    protected $casts = [
        'price' => 'float',
        'discount_price' => 'float',
        'rating' => 'float',
        'stock_quantity' => 'integer',
        'is_active' => 'boolean',
        'num_reviews' => 'integer',
    ];

    // Define the inverse relationship to the Cart model
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
