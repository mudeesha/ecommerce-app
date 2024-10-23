<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Handlers\Admin\ProductHandler;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected $productHandler;

    public function __construct(ProductHandler $productHandler)
    {
        $this->productHandler = $productHandler;
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $this->productHandler->createProduct($request->validated());
        return response()->json(['message' => 'Product created successfully'], 201);
    }

    // Other admin product management methods...
}

