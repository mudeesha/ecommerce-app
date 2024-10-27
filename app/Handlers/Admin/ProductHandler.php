<?php

namespace App\Handlers\Admin;

use App\Models\Product;
use Exception;

class ProductHandler
{
    public function index(array $params)
    {
        $search = $params['search'] ?? null;

        try {
            return Product::when($search, function($query) use ($search) {
                return $query->where('title', 'LIKE', '%' . $search . '%');
            })->paginate(10);
        } catch (Exception $e) {
            throw new Exception('Error fetching products: ' . $e->getMessage());
        }
    }

    public function store(array $data)
    {
        try {
            return Product::create($data);
        } catch (Exception $e) {
            throw new Exception('Error adding product: ' . $e->getMessage());
        }
    }

    public function fetchProductById($id)
    {
        $product = Product::find($id);

        if (!$product) {
            throw new Exception('Product not found');
        }

        return $product;
    }

    public function update(array $data, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            throw new Exception('Product not found');
        }

        $product->update($data);

        return $product;
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            throw new Exception('Product not found');
        }

        $product->delete();
    }
}
