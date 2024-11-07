<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Products\ProductAddRequest;
use App\Http\Requests\Admin\Products\ProductFetchRequest;
use App\Http\Requests\Admin\Products\ProductShowRequest;
use App\Http\Requests\Admin\Products\ProductUpdateRequest;
use App\Http\Requests\Admin\Products\ProductDeleteRequest;
use App\Services\Admin\ProductService;
use Illuminate\Http\JsonResponse;
use Exception;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function returnView() {
        return view('admin.product');
    }

    public function index(ProductFetchRequest $request): JsonResponse
    {
        try {
            $products = $this->productService->fetchProducts($request->validated());
            return response()->json($products);
        } catch (Exception $e) {
            \Log::error('Error fetching products: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching products.'], 500);
        }
    }

    public function store(ProductAddRequest $request): JsonResponse
    {
        try {
            $this->productService->addProduct($request->validated());
            return response()->json(['message' => 'Product added successfully'], 201);
        } catch (Exception $e) {
            \Log::error('Error adding product: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add product'], 500);
        }
    }

    public function show(ProductShowRequest $request, $id): JsonResponse
    {
        try {
            $product = $this->productService->getProductById($id);
            return response()->json($product);
        } catch (Exception $e) {
            \Log::error('Error fetching product: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching the product.'], 500);
        }
    }

    public function update(ProductUpdateRequest $request, $id): JsonResponse
    {
        try {
            $this->productService->updateProduct($request->validated(), $id);
            return response()->json(['message' => 'Product updated successfully']);
        } catch (Exception $e) {
            \Log::error('Error updating product: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update product'], 500);
        }
    }

    public function destroy(ProductDeleteRequest $request, $id): JsonResponse
    {
        try {
            $this->productService->deleteProduct($id);
            return response()->json(['message' => 'Product deleted successfully']);
        } catch (Exception $e) {
            \Log::error('Error deleting product: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
