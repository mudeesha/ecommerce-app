<?php

namespace App\Services\Customer;

use App\Handlers\ProductHandler;
use App\Models\Product;
use Exception;

class ProductService
{

    public function checkAvailability(int $productId, int $quantity): bool
    {
        // Fetch the product from the database
        $product = Product::find($productId);

        // Check if the product exists
        if (!$product) {
            throw new Exception("Product not found.");
        }

        // Check if the stock quantity is greater than or equal to the required quantity
        if ($product->stock_quantity >= $quantity) {
            return true; // Available
        }

        return false; // Not enough stock
    }





}
