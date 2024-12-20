<?php

namespace App\Handlers;

use App\Models\Product;
use App\Models\AdminLog;
use App\Services\Admin\AdminLogService;
use Illuminate\Support\Facades\Log;

use Exception;

class ProductHandler
{

    public function index(array $params)
    {
        $search = $params['search'] ?? null;

        try {
            return Product::when($search, function ($query) use ($search) {
                return $query->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('description', 'LIKE', '%' . $search . '%');
            })->paginate(7);
        } catch (Exception $e) {
            \Log::error('Error fetching products: ' . $e->getMessage());
            throw new Exception('Error fetching products: ' . $e->getMessage());
        }
    }

    public function store(array $data)
    {
            try {
                $product = new Product();
                $product->name = $data['name'];
                $product->description = $data['description'] ?? null;
                $product->category_id = $data['category_id'];
                $product->price = $data['price'];
                $product->discount_price = $data['discount_price'] ?? null;
                $product->stock_quantity = $data['stock_quantity'] ?? 0;
                $product->is_active = $data['is_active'] ?? true;
                $product->main_image_url = $data['main_image_url'] ?? null;
                $product->rating = $data['rating'] ?? 0.0;
                $product->num_reviews = $data['num_reviews'] ?? 0;
                $product->meta_title = $data['meta_title'] ?? null;
                $product->meta_description = $data['meta_description'] ?? null;
                // $product->created_by = auth()->id();
                $product->save();

                $adminLogService = new AdminLogService;
                $adminLogService->logAction(auth()->id(), 'create', 'products', $product->id, 'Created a new product');

            } catch (Exception $e) {
                \Log::error('Error adding product: ' . $e->getMessage());
                throw new Exception('Error adding product: ' . $e->getMessage());
            }
    }

    public function fetchProductById($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                throw new Exception('Product not found');
            }

            return $product;
        } catch (Exception $e) {
            throw new Exception('Error fetching product: ' . $e->getMessage());
        }
    }

    public function update(array $data, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $originalData = $product->getOriginal();

            $product->fill($data);
            $product->save();

            $adminLogService = new AdminLogService;
            $adminLogService->logAction(auth()->id(), 'update', 'products', $product->id, 'Updated a product', $originalData, $data);

        } catch (Exception $e) {
            throw new Exception('Error updating product: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);

            if ($product) {
                $product->delete();

                $this->adminLogService->logAction(auth()->id(), 'delete', 'products', $product->id, 'Deleted a product');
            } else {
                throw new Exception('Product not found.');
            }
        } catch (Exception $e) {
            throw new Exception('Error deleting product: ' . $e->getMessage());
        }
    }

    public function updateProductStockAfterPayment($orderData)
    {
        try {
            foreach ($orderData as $item) {
                $product = Product::find($item['id']);
                if ($product) {
                    \Log::debug('product:: ' . $product);
                    // Ensure stock is sufficient before updating
                    if ($product->stock_quantity >= $item['quantity']) {
                        $product->stock_quantity -= $item['quantity'];
                        $product->save();
                    } else {
                        throw new Exception("Insufficient stock for product ID {$item['id']} ({$product->name})");
                    }
                } else {
                    throw new Exception("Product ID {$item['id']} not found.");
                }
            }

            Log::info('Stock quantities updated successfully.');
            return true;
        } catch (\Exception $e) {
            Log::error('Error updating stock quantities: ' . $e->getMessage());
        }
    }


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
