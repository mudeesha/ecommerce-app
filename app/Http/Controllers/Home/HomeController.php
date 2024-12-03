<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Services\Home\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\ProductFetchRequest;
use App\Http\Requests\Home\ProductShowRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function home() {
        return view('home.index');
    }

    public function admin() {
        return view('admin.index');
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

    public function showProduct(ProductShowRequest $request, $id): JsonResponse
    {
        try {
            $product = $this->productService->getProductById($id);
            return response()->json($product);
        } catch (Exception $e) {
            \Log::error('Error fetching product: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching the product.'], 500);
        }
    }
}
