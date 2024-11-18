<?php

namespace App\Handlers;

use App\Models\Cart;

use Exception;

class CartHandler
{

    public function index(array $params)
    {
        // $search = $params['search'] ?? null;

        // try {
        //     return Product::when($search, function ($query) use ($search) {
        //         return $query->where('name', 'LIKE', '%' . $search . '%')
        //                     ->orWhere('description', 'LIKE', '%' . $search . '%');
        //     })->paginate(7);
        // } catch (Exception $e) {
        //     \Log::error('Error fetching products: ' . $e->getMessage());
        //     throw new Exception('Error fetching products: ' . $e->getMessage());
        // }
    }

    public function add(array $data): void
    {
        \Log::alert('p-id: ', $data);
        try {
            Cart::create([
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'user_id' => auth()->id(),
            ]);
        } catch (Exception $e) {
            \Log::error('Error adding product to cart', [
                'user_id' => auth()->id(),
                'data' => $data,
                'error' => $e->getMessage(),
            ]);
            throw new Exception('Error adding product to cart: ' . $e->getMessage());
        }
    }

    public function fetchProductById($id)
    {
        // try {
        //     $product = Product::find($id);

        //     if (!$product) {
        //         throw new Exception('Product not found');
        //     }

        //     return $product;
        // } catch (Exception $e) {
        //     throw new Exception('Error fetching product: ' . $e->getMessage());
        // }
    }

    public function update(array $data, $id)
    {
        // try {
        //     $product = Product::findOrFail($id);
        //     $originalData = $product->getOriginal();

        //     $product->fill($data);
        //     $product->save();

        //     $this->adminLogService->logAction(auth()->id(), 'update', 'products', $product->id, 'Updated a product', $originalData, $data);

        // } catch (Exception $e) {
        //     throw new Exception('Error updating product: ' . $e->getMessage());
        // }
    }

    public function delete($id)
    {
        // try {
        //     $product = Product::find($id);

        //     if ($product) {
        //         $product->delete();

        //         $this->adminLogService->logAction(auth()->id(), 'delete', 'products', $product->id, 'Deleted a product');
        //     } else {
        //         throw new Exception('Product not found.');
        //     }
        // } catch (Exception $e) {
        //     throw new Exception('Error deleting product: ' . $e->getMessage());
        // }
    }
}
