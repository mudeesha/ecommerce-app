<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Requests\User\Cart\CartAddRequest;
use App\Http\Requests\User\Cart\CartUpdateRequest;
use App\Http\Requests\User\Cart\CartRemoveRequest;
use App\Services\User\CartService;
use Illuminate\Http\JsonResponse;


class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartDetails = $this->cartService->getCartDetails();
        return view('cart.cart');
    }

    public function fetch()
    {
        $cartDetails = $this->cartService->getCartDetails();
        return response()->json(['status' => true, 'data' => $cartDetails]);
    }

    public function store(CartAddRequest $request): JsonResponse
    {
        try {
            $this->cartService->addCart($request->validated());
            return response()->json(['message' => 'Added into the Cart successfully'], 201);
        } catch (Exception $e) {
            \Log::error('Error adding to Cart: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add to Cart'], 500);
        }
    }

    public function update(CartUpdateRequest $request)
    {
        $response = $this->cartService->updateCartItem($request->validated());
        return response()->json($response);
    }

    public function remove(CartRemoveRequest $request)
    {
        $response = $this->cartService->removeCartItem($request->validated());
        return response()->json($response);
    }
}
