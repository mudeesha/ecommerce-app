<?php

namespace App\Handlers\Admin;

use App\Models\Product;
use Exception;

class ProductHandler
{
    public function createProduct(array $data)
    {
        try {
            $product = new Product();
            $product->fill($data);
            $product->save();
        } catch (Exception $e) {
            throw new Exception('Error creating product: ' . $e->getMessage());
        }
    }

    // Other business logic methods for admin products...
}

