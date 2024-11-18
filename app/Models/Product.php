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

    // Define the inverse relationship to the Cart model
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
